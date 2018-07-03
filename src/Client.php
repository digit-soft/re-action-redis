<?php
//TODO: Remove ComponentAutoloadInterface and init()
namespace Reaction\Redis;

use Clue\Redis\Protocol\Factory as ProtocolFactory;
use React\EventLoop\LoopInterface;
use React\Promise\ExtendedPromiseInterface;
use React\Socket\Connector;
use Reaction\Base\Component;
use Reaction\Base\ComponentAutoloadInterface;
use Reaction\ClientsPool\Pool;
use Reaction\ClientsPool\PoolInterface;
use Reaction\Exceptions\InvalidArgumentException;
use Reaction\Helpers\ArrayHelper;

/**
 * Class Client
 * @package Reaction\Redis
 */
class Client extends Component implements ComponentAutoloadInterface, RedisCommandsInterface
{
    use RedisCommandsExecutorTrait;

    /**
     * @var LoopInterface
     */
    public $loop;
    /**
     * @var string Redis URL
     */
    public $url;
    /**
     * @var array Array of options for Connector
     */
    public $connectorOptions = [];
    /**
     * @var ProtocolFactory|null Protocol to use
     */
    public $protocol;
    /**
     * @var array Pool config
     * @see Pool
     */
    public $poolConfig = [];
    /**
     * @var array Default Pool config
     */
    public $poolConfigDefault = [
        'clientTtl' => null,
        'maxCount' => 30,
        'maxQueueCount' => 10,
    ];

    /** @var PoolInterface|null */
    protected $_pool;

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        /** @var ClientConnection $client */
        //$client = $this->getClient();
        $this->set('test_key', 'test_value', 10)
            ->then(function($resp) {
                \Reaction::warning($resp);
            }, function($error) {
                \Reaction::warning($error);
            });
        /*$client->getStream()
            ->then(function(DuplexStreamInterface $stream) {
                $stream->write('SET test_key test_data EX 3' . "\n");
                \Reaction::error(get_class($stream));
            });*/
        //\Reaction::warning(get_class($client->getStream()));
        //\Reaction::warning(get_class($client));
    }

    /**
     * Execute command
     * @param string $command
     * @param array  $arguments
     * @return ExtendedPromiseInterface
     */
    public function executeCommand($command, $arguments)
    {
        return $this->getClient()->executeCommand($command, $arguments);
    }

    /**
     * Get client from pool
     * @return ClientConnection
     */
    protected function getClient()
    {
        return $this->getPool()->getClient();
    }

    /**
     * Get pool
     * @return null|PoolInterface
     */
    protected function getPool()
    {
        if (!isset($this->_pool)) {
            $config = [
                'loop' => $this->loop,
                'clientConfig' => function() {
                    return $this->getClientConfig();
                }
            ];
            $config = ArrayHelper::merge($this->poolConfigDefault, $this->poolConfig, $config);
            $this->_pool = new Pool($config);
        }
        return $this->_pool;
    }

    /**
     * Get config for ClientConnection
     * @return array
     */
    protected function getClientConfig()
    {
        $protocol = isset($this->protocol) ? $this->protocol : new ProtocolFactory();
        $config = [
            'class' => ClientConnection::class,
            'url' => $this->url,
            'urlParsed' => static::parseUrl($this->url),
            'connector' => new Connector($this->loop, $this->connectorOptions),
            'responseParser' => $protocol->createResponseParser(),
            'serializer' => $protocol->createSerializer(),
        ];
        return $config;
    }

    /**
     * Parse redis URL
     * @param string $target
     * @return array with keys authority, auth and db
     * @throws InvalidArgumentException
     */
    public static function parseUrl($target)
    {
        $ret = [];
        // support `redis+unix://` scheme for Unix domain socket (UDS) paths
        if (preg_match('/^redis\+unix:\/\/([^:]*:[^@]*@)?(.+?)(\?.*)?$/', $target, $match)) {
            $ret['authority'] = 'unix://' . $match[2];
            $target = 'redis://' . (isset($match[1]) ? $match[1] : '') . 'localhost' . (isset($match[3]) ? $match[3] : '');
        }

        if (strpos($target, '://') === false) {
            $target = 'redis://' . $target;
        }

        $parts = parse_url($target);
        if ($parts === false || !isset($parts['scheme'], $parts['host']) || !in_array($parts['scheme'], array('redis', 'rediss'))) {
            throw new InvalidArgumentException('Given URL can not be parsed');
        }

        if (isset($parts['pass'])) {
            $ret['auth'] = rawurldecode($parts['pass']);
        }

        if (isset($parts['path']) && $parts['path'] !== '') {
            // skip first slash
            $ret['db'] = substr($parts['path'], 1);
        }

        if (!isset($ret['authority'])) {
            $ret['authority'] =
                ($parts['scheme'] === 'rediss' ? 'tls://' : '') .
                $parts['host'] . ':' .
                (isset($parts['port']) ? $parts['port'] : 6379);
        }

        if (isset($parts['query'])) {
            $args = array();
            parse_str($parts['query'], $args);

            if (isset($args['password'])) {
                $ret['auth'] = $args['password'];
            }

            if (isset($args['db'])) {
                $ret['db'] = $args['db'];
            }
        }

        return $ret;
    }
}