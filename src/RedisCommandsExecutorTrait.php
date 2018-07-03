<?php

namespace Reaction\Redis;

use Reaction\Promise\ExtendedPromiseInterface;

/**
 * Trait RedisCommandsExecutorTrait
 * @package Reaction\Redis
 */
trait RedisCommandsExecutorTrait
{
    /**
     * AUTH command
     * @param string $password
     * @return ExtendedPromiseInterface
     */
    public function auth($password)
    {
        return $this->executeCommand(__FUNCTION__, [$password]);
    }

    /**
     * SELECT db command
     * @param string $db
     * @return ExtendedPromiseInterface
     */
    public function select($db)
    {
        return $this->executeCommand(__FUNCTION__, [$db]);
    }

    /**
     * SET command
     * @param string   $key Key name
     * @param mixed    $value Value to store
     * @param int|null $ex Expire time in seconds
     * @return ExtendedPromiseInterface
     */
    public function set($key, $value, $ex = null)
    {
        $command = isset($ex) ? 'setex' : 'set';
        $arguments = isset($ex) ? [$key, $ex, $value] : [$key, $value];
        return $this->executeCommand($command, $arguments);
    }

    /**
     * GET command
     * @param string $key
     * @return ExtendedPromiseInterface
     */
    public function get($key)
    {
        return $this->executeCommand(__FUNCTION__, [$key]);
    }

    /**
     * EXPIRE command
     * @param string $key
     * @param int    $seconds
     * @return ExtendedPromiseInterface
     */
    public function expire($key, $seconds)
    {
        return $this->executeCommand(__FUNCTION__, [$key, $seconds]);
    }
}