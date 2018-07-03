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
     * Magic method
     * @param string $name
     * @param array  $arguments
     * @return mixed
     */
    public function __call($name, $arguments);

    /**
     * Execute a command
     * @param string $command
     * @param array  $arguments
     * @return ExtendedPromiseInterface
     */
    public function executeCommand($command, $arguments);
}