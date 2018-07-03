<?php

namespace Reaction\Redis;

use React\Promise\ExtendedPromiseInterface;

/**
 * Interface RedisCommandsInterface
 * @package Reaction\Redis
 */
interface RedisCommandsInterface
{
    /**
     * AUTH command
     * @param string $password
     * @return ExtendedPromiseInterface
     */
    public function auth($password);

    /**
     * SELECT db command
     * @param string $db
     * @return ExtendedPromiseInterface
     */
    public function select($db);

    /**
     * SET command
     * @param string   $key Key name
     * @param mixed    $value Value to store
     * @param int|null $ex Expire time in seconds
     * @return ExtendedPromiseInterface
     */
    public function set($key, $value, $ex = null);

    /**
     * GET command
     * @param string $key
     * @return ExtendedPromiseInterface
     */
    public function get($key);

    /**
     * Execute command
     * @param string $command
     * @param array  $arguments
     * @return ExtendedPromiseInterface
     */
    public function executeCommand($command, $arguments);
}