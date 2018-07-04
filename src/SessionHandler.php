<?php

namespace Reaction\Redis;

use Reaction\DI\Instance;
use Reaction\Exceptions\SessionException;
use Reaction\Promise\ExtendedPromiseInterface;
use Reaction\Web\Sessions\SessionHandlerAbstract;
use Reaction\Web\Sessions\SessionHandlerInterface;

/**
 * Class SessionHandler
 * @package Reaction\Redis
 */
class SessionHandler extends SessionHandlerAbstract implements SessionHandlerInterface
{
    /**
     * @var Client|string
     */
    public $redis = 'redis';
    /**
     * @var bool Overwrite this parameter, we will use Redis EXPIRE on write
     */
    public $useExternalGc = true;
    /**
     * @var string Key prefix for storage
     */
    public $keyPrefix = 'sess_';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        $this->redis = Instance::ensure($this->redis, Client::class);
    }

    /**
     * Read session data and returns serialized|encoded data
     * @param string $id
     * @return ExtendedPromiseInterface  with session data
     */
    public function read($id)
    {
        $key = $this->getSessionKey($id);
        return $this->redis->get($key)
            ->then(function($result) {
                return $this->unserializeData($result);
            })->otherwise(function($error = null) use ($id) {
                return $this->archive->get($id)->then(
                    function($data) use ($id, $error) {
                        if (is_array($data)) {
                            return $this->write($id, $data);
                        } else {
                            return \Reaction\Promise\reject($error);
                        }
                    }
                );
            })->then(
                null,
                function($error = null) use ($id) {
                    $message = sprintf('Failed to read session data for "%s"', $id);
                    throw new SessionException($message, 0, $error);
                }
            );
    }

    /**
     * Write session data to storage
     * @param string $id
     * @param array  $data
     * @return ExtendedPromiseInterface  with session data
     */
    public function write($id, $data)
    {
        $key = $this->getSessionKey($id);
        $dataStr = $this->serializeData($data);
        return $this->redis->set($key, $dataStr, $this->gcLifetime)
            ->then(function() use ($id) {
                return $this->read($id);
            }, function($error = null) use ($id) {
                $message = sprintf('Failed to write session data for "%s"', $id);
                throw new SessionException($message, 0, $error);
            });
    }

    /**
     * Destroy a session
     * @param string $id The session ID being destroyed.
     * @param bool   $archiveRemove Remove data from archive or no
     * @return ExtendedPromiseInterface  with bool when finished
     */
    public function destroy($id, $archiveRemove = false)
    {
        $key = $this->getSessionKey($id);
        return $this->redis->del($key)
            ->then(function() use ($id) { return $id; })
            ->always(function() use ($id, $archiveRemove) {
                return $archiveRemove ? $this->archive->remove($id) : true;
            });
    }

    /**
     * Cleanup old sessions. Timer callback.
     * Sessions that have not updated for the last '$this->gcLifetime' seconds will be archived.
     * Sessions in archive with age bigger than '$this->sessionLifetime' seconds will be removed.
     * @see $gcLifetime
     * @see $gcArchiveLifetime
     * @return void
     */
    public function gc()
    {
    }

    /**
     * Update timestamp of a session
     * @param string $id The session id
     * @param string $data
     * The encoded session data. This data is the
     * result of the PHP internally encoding
     * the $_SESSION superglobal to a serialized
     * string and passing it as this parameter.
     * @return ExtendedPromiseInterface  with bool when finished
     */
    public function updateTimestamp($id, $data)
    {
        $key = $this->getSessionKey($id);
        return $this->redis->expire($key, $this->gcLifetime)
            ->then(function() { return true; });
    }

    /**
     * Get cache session key
     * @param string $sessionId
     * @return string
     */
    protected function getSessionKey($sessionId) {
        return $this->keyPrefix . trim($sessionId);
    }
}