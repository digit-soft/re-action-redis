<?php

namespace Reaction\Redis;

use Reaction\Cache\ExpiringCache;
use Reaction\Cache\ExpiringCacheInterface;
use Reaction\DI\Instance;
use Reaction\Exceptions\Exception;
use function Reaction\Promise\all;
use function Reaction\Promise\reject;
use function Reaction\Promise\resolve;
use Zumba\JsonSerializer\Exception\JsonSerializerException;

/**
 * Class Cache.
 * Redis based cache component.
 * @package Reaction\Redis
 */
class Cache extends ExpiringCache implements ExpiringCacheInterface
{
    /**
     * @var Client|string Redis client component
     */
    public $redis = 'redis';
    /**
     * @var string Redis key where tags is stored
     */
    public $tagsRedisKey = '_cache_tags';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        $this->redis = Instance::ensure($this->redis, Client::class);
    }

    /**
     * @inheritdoc
     */
    public function get($key, $default = null)
    {
        return $this->redis->get($key)
            ->then(function($recordStr) {
                $record = $this->unserializeData($recordStr);
                return $this->unpackRecord($record);
            })->otherwise(function() use ($default) {
                return $default;
            });
    }

    /**
     * @inheritdoc
     */
    public function set($key, $value, $ttl = null, $tags = [])
    {
        $valueStr = $this->serializeData($value);
        return $this->redis
            ->set($key, $valueStr, $ttl)
            ->then(function() use ($key, $tags) {
                return $this->addTagsEntry($key, $tags);
            })
            ->then(function() { return true; });
    }

    /**
     * @inheritdoc
     */
    public function delete($key)
    {
        return $this->redis->del($key)
            ->then(function() use ($key) {
                return $this->removeTagsEntry($key);
            })
            ->then(function() { return true; });
    }

    /**
     * @inheritdoc
     */
    public function exists($key)
    {
        return $this->redis->exists($key)
            ->then(function($response) use ($key) {
                $cnt = (int)$response;
                return !empty($cnt) ? true : reject(new Exception(sprintf('Cache for key "%s" not exists', $key)));
            });
    }

    /**
     * @inheritdoc
     */
    public function deleteByTag($tag)
    {
        return $this->getKeysByTag($tag)
            ->then(function($keys) {
                if (empty($keys)) {
                    return true;
                }
                return $this->deleteMultiple($keys);
            })->then(function() use ($tag) {
                return $this->redis->hdel($this->tagsRedisKey, $tag);
            })->then(function() { return true; });
    }

    /**
     * @inheritdoc
     */
    public function deleteMultiple($keys)
    {
        return $this->redis->del(...$keys)
            ->then(function() { return true; });
    }

    /**
     * Add tags entry(ies) for key
     * @param string   $key
     * @param string[] $tags
     * @return \Reaction\Promise\ExtendedPromiseInterface
     */
    protected function addTagsEntry($key, $tags)
    {
        $promises = [];
        foreach ($tags as $tag) {
            $promises[] = $this->getKeysByTag($tag)
                ->then(function($keys) use ($key, $tag) {
                    if (!in_array($key, $keys)) {
                        $keys[] = $key;
                        $keysStr = $this->serializeData($keys);
                        return $this->redis->hset($this->tagsRedisKey, $tag, $keysStr);
                    }
                    return true;
                });
        }
        return all($promises)->then(function() { return true; });
    }

    /**
     * Remove key from tags (selected or all)
     * @param string     $key
     * @param array|null $tags
     * @return \Reaction\Promise\ExtendedPromiseInterface
     */
    protected function removeTagsEntry($key, $tags = null)
    {
        $tagsPromise = isset($tags)
            ? $this->redis->hmget($this->tagsRedisKey, ...$tags)
                ->then(function($tagsKeys) use ($tags) {
                    $combined = array_combine($tags, $tagsKeys);
                    foreach ($combined as $tag => $value) {
                        if (!isset($value)) {
                            unset($combined[$tag]);
                        }
                    }
                    return $combined;
                })
            : $this->redis->hgetall($this->tagsRedisKey)
                ->then(function($tagsKeys) {
                    $_tags = $_keys = [];
                    foreach ($tagsKeys as $index => $value) {
                        if ($index % 2 === 0) {
                            $_tags[] = $value;
                        } else {
                            $_keys[] = $value;
                        }
                    }
                    return array_combine($_tags, $_keys);
                });
        return $tagsPromise->then(function($tagsKeys) use ($key) {
            foreach ($tagsKeys as $tag => $keysStr) {
                try {
                    $keys = $this->unserializeData($keysStr);
                } catch (JsonSerializerException $e) {
                    $keys = [];
                }
                $tagsKeys[$tag] = $keys;
                $keyPos = array_search($key, $keys);
                if ($keyPos !== false) {
                    unset($tagsKeys[$tag][$keyPos]);
                } elseif(!empty($keys)) {
                    unset($tagsKeys[$tag]);
                }
            }
            return $tagsKeys;
        })->then(function($tagsToUpdate) {
            return $this->updateTagsEntries($tagsToUpdate);
        });
    }

    /**
     * Update tags bulk
     * @param array $tagEntries
     * @return \Reaction\Promise\ExtendedPromiseInterface
     */
    protected function updateTagsEntries($tagEntries = [])
    {
        if (empty($tagEntries)) {
            return resolve(true);
        }
        $promises = [];
        foreach ($tagEntries as $tag => $value) {
            if (empty($value)) {
                $promises[] = $this->redis->hdel($this->tagsRedisKey, $tag);
            } else {
                $valueStr = $this->serializeData($value);
                $promises[] = $this->redis->hset($this->tagsRedisKey, $tag, $valueStr);
            }
        }
        return all($promises)->then(function() { return true; });
    }

    /**
     * Get keys array assigned to tag
     * @param string $tag
     * @return \Reaction\Promise\ExtendedPromiseInterface
     */
    protected function getKeysByTag($tag)
    {
        return $this->redis->hget($this->tagsRedisKey, $tag)
            ->then(function($result) {
                return !empty($result) ? $this->unserializeData($result) : [];
            })->otherwise(function() {
                return [];
            });
    }
}