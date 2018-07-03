<?php

namespace Reaction\Redis;

use Clue\Redis\Protocol\Model\ErrorReply;
use Clue\Redis\Protocol\Model\ModelInterface;
use Clue\Redis\Protocol\Model\MultiBulkReply;
use Clue\Redis\Protocol\Parser\ParserException;
use Clue\Redis\Protocol\Parser\ParserInterface;
use Clue\Redis\Protocol\Serializer\SerializerInterface;
use React\Socket\ConnectionInterface;
use React\Socket\ConnectorInterface;
use React\Stream\DuplexStreamInterface;
use Reaction\Base\Component;
use Reaction\ClientsPool\PoolClientInterface;
use Reaction\ClientsPool\PoolClientTrait;
use Reaction\Promise\Deferred;
use Reaction\Promise\ExtendedPromiseInterface;
use function Reaction\Promise\resolve;

/**
 * Class ClientConnection
 * @package Reaction\Redis
 * @property string[] $urlParsed
 */
class ClientConnection extends Component implements PoolClientInterface, RedisCommandsInterface
{
    use PoolClientTrait;
    use RedisCommandsExecutorTrait;

    const CONNECTION_STATE_NONE = 0;
    const CONNECTION_STATE_CONNECTED = 1;
    const CONNECTION_STATE_CLOSING = 2;

    /**
     * @var string|null Redis connection URL
     */
    public $url;
    /**
     * @var ConnectorInterface
     */
    public $connector;
    /**
     * @var ParserInterface
     */
    public $responseParser;
    /**
     * @var SerializerInterface
     */
    public $serializer;
    /**
     * @var int
     */
    public $state = self::CONNECTION_STATE_NONE;

    /**
     * @var string[] Parsed URL parts array
     */
    protected $_urlParts;
    /**
     * @var DuplexStreamInterface
     */
    protected $_stream;
    /**
     * @var Deferred[]
     */
    protected $queue = [];
    /**
     * @var bool Whenever client connection is closing
     */
    protected $ending = false;
    /**
     * @var bool Whenever client connection is closed
     */
    protected $closed = false;

    protected $subscribed = 0;
    protected $pSubscribed = 0;

    /**
     * Get parsed URL parts
     * @return string[]
     */
    public function getUrlParsed()
    {
        if (!isset($this->_urlParts)) {
            $this->_urlParts = Client::parseUrl($this->url);
        }
        return $this->_urlParts;
    }

    /**
     * Set parsed URL parts
     * @param string[] $urlParts
     */
    public function setUrlParsed($urlParts)
    {
        $this->_urlParts = $urlParts;
    }

    /**
     * Close connection after queue ends
     */
    public function end()
    {
        $this->ending = true;
        $this->setState(static::CONNECTION_STATE_CLOSING);
        if (empty($this->queue)) {
            $this->close();
        }
    }

    /**
     * Close connection and reject all queue entries
     */
    public function close()
    {
        if ($this->closed) {
            return;
        }
        $this->closed = true;
        $this->emit('close');
        $this->_stream->close();
        // Reject all remaining requests in the queue
        while($this->queue) {
            $request = array_shift($this->queue);
            $request->reject(new \RuntimeException('Connection closing'));
        }
        unset($this->_stream);
    }

    /**
     * Execute command
     * @param string $command
     * @param array  $arguments
     * @return ExtendedPromiseInterface
     */
    public function executeCommand($command, $arguments)
    {
        $request = new Deferred();
        $promise = $request->promise();

        $command = strtoupper($command);

        // special (p)(un)subscribe commands only accept a single parameter and have custom response logic applied
        static $pubsAndSubs = array('subscribe', 'unsubscribe', 'psubscribe', 'punsubscribe');

        $this->changeQueueCountInc();

        if ($this->ending) {
            $request->reject(new \RuntimeException('Connection closed'));
        } elseif (count($arguments) !== 1 && in_array($command, $pubsAndSubs)) {
            $request->reject(new \InvalidArgumentException('PubSub commands limited to single argument'));
        } elseif ($command === 'monitor') {
            $request->reject(new \BadMethodCallException('MONITOR command explicitly not supported'));
        } else {
            $requestMessage = $this->serializer->getRequestMessage($command, $arguments);
            $isSubOrOub = in_array($command, $pubsAndSubs);
            $promise = $this->getStream()
                ->then(function(DuplexStreamInterface $stream) use ($requestMessage, $request, $promise, $isSubOrOub) {
                    $stream->write($requestMessage);
                    $this->queue []= $request;
                    if ($isSubOrOub) {
                        $subscribed =& $this->subscribed;
                        $pSubscribed =& $this->pSubscribed;

                        $promise->then(function ($array) use (&$subscribed, &$pSubscribed) {
                            $first = array_shift($array);

                            // (p)(un)subscribe messages are to be forwarded
                            $this->emit($first, $array);

                            // remember number of (p)subscribe topics
                            if ($first === 'subscribe' || $first === 'unsubscribe') {
                                $subscribed = $array[1];
                            } else {
                                $pSubscribed = $array[1];
                            }
                        });
                    }
                    return $promise;
                });
        }

        $promise = $promise->always(function() {
            $this->changeQueueCountDec();
        });

        return $promise;
    }

    /**
     * Get connected stream
     * @return ExtendedPromiseInterface with DuplexStreamInterface
     */
    public function getStream()
    {
        if (!isset($this->_stream)) {
            return $this->connect()
                ->then(function(DuplexStreamInterface $stream) {
                    $this->setState(static::CONNECTION_STATE_CONNECTED);
                    $this->bindStreamEvents();
                    return $stream;
                });
        }
        return resolve($this->_stream);
    }

    /**
     * Set connection state
     * @param int $state
     */
    public function setState($state)
    {
        $this->state = $state;
        $map = [
            static::CONNECTION_STATE_CONNECTED => static::CLIENT_POOL_STATE_READY,
            static::CONNECTION_STATE_NONE => static::CLIENT_POOL_STATE_NOT_READY,
            static::CONNECTION_STATE_CLOSING => static::CLIENT_POOL_STATE_CLOSING,
        ];
        $poolState = isset($map[$state]) ? $map[$state] : static::CLIENT_POOL_STATE_NOT_READY;
        $this->changeState($poolState);
    }

    /**
     * Handle response message
     * @param ModelInterface $message
     */
    public function handleResponseMessage(ModelInterface $message)
    {
        if (($this->subscribed !== 0 || $this->pSubscribed !== 0) && $message instanceof MultiBulkReply) {
            $array = $message->getValueNative();
            $first = array_shift($array);

            // pub/sub messages are to be forwarded and should not be processed as request responses
            if (in_array($first, array('message', 'pmessage'))) {
                $this->emit($first, $array);
                return;
            }
        }

        if (!$this->queue) {
            throw new \UnderflowException('Unexpected reply received, no matching request found');
        }

        $request = array_shift($this->queue);
        /* @var $request Deferred */

        if ($message instanceof ErrorReply) {
            $request->reject($message);
        } else {
            $request->resolve($message->getValueNative());
        }

        if ($this->ending && !$this->queue) {
            $this->close();
        }
    }

    /**
     * Bind event handlers to the stream
     */
    protected function bindStreamEvents()
    {
        $parser = $this->responseParser;
        $this->_stream->on('data', function($chunk) use ($parser) {
            try {
                $models = $parser->pushIncoming($chunk);
            } catch (ParserException $error) {
                $this->emit('error', array($error));
                $this->close();
                return;
            }

            foreach ($models as $data) {
                try {
                    $this->handleResponseMessage($data);
                } catch (\UnderflowException $error) {
                    $this->emit('error', array($error));
                    $this->close();
                    return;
                }
            }
        });

        $this->_stream->on('close', array($this, 'close'));
    }

    /**
     * Establish connection and return a stream
     * @return ExtendedPromiseInterface
     */
    protected function connect()
    {
        if (isset($this->_stream)) {
            $this->close();
            unset($this->_stream);
        }

        $parts = $this->urlParsed;

        $promise = $this->connector->connect($parts['authority'])->then(function (ConnectionInterface $stream) {
            $this->_stream = $stream;
            return $stream;
        });

        if (isset($parts['auth'])) {
            $promise = $promise->then(function (DuplexStreamInterface $stream) use ($parts) {
                return $this->auth($parts['auth'])->then(
                    function () use ($stream) {
                        return $stream;
                    },
                    function ($error) {
                        $this->close();
                        throw $error;
                    }
                );
            });
        }

        if (isset($parts['db'])) {
            $promise = $promise->then(function (DuplexStreamInterface $stream) use ($parts) {
                return $this->select($parts['db'])->then(
                    function () use ($stream) {
                        return $stream;
                    },
                    function ($error) {
                        $this->close();
                        throw $error;
                    }
                );
            });
        }

        return resolve($promise);
    }
}