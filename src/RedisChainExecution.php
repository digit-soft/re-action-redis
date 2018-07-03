<?php

namespace Reaction\Redis;

use Reaction\Base\BaseObject;
use Reaction\Helpers\Inflector;
use Reaction\Promise\LazyPromise;
use function Reaction\Promise\allInOrder;

/**
 * Class RedisChainExecution
 * @package Reaction\Redis
 *
 * @method self append($key, $value) Append a value to a key. <https://redis.io/commands/append>
 * @method self auth($password) Authenticate to the server. <https://redis.io/commands/auth>
 * @method self bgrewriteaof() Asynchronously rewrite the append-only file. <https://redis.io/commands/bgrewriteaof>
 * @method self bgsave() Asynchronously save the dataset to disk. <https://redis.io/commands/bgsave>
 * @method self bitcount($key, $start = null, $end = null) Count set bits in a string. <https://redis.io/commands/bitcount>
 * @method self bitfield($key, ...$operations) Perform arbitrary bitfield integer operations on strings. <https://redis.io/commands/bitfield>
 * @method self bitop($operation, $destkey, ...$keys) Perform bitwise operations between strings. <https://redis.io/commands/bitop>
 * @method self bitpos($key, $bit, $start = null, $end = null) Find first bit set or clear in a string. <https://redis.io/commands/bitpos>
 * @method self blpop(...$keys, $timeout) Remove and get the first element in a list, or block until one is available. <https://redis.io/commands/blpop>
 * @method self brpop(...$keys, $timeout) Remove and get the last element in a list, or block until one is available. <https://redis.io/commands/brpop>
 * @method self brpoplpush($source, $destination, $timeout) Pop a value from a list, push it to another list and return it; or block until one is available. <https://redis.io/commands/brpoplpush>
 * @method self clientKill(...$filters) Kill the connection of a client. <https://redis.io/commands/client-kill>
 * @method self clientList() Get the list of client connections. <https://redis.io/commands/client-list>
 * @method self clientGetname() Get the current connection name. <https://redis.io/commands/client-getname>
 * @method self clientPause($timeout) Stop processing commands from clients for some time. <https://redis.io/commands/client-pause>
 * @method self clientReply($option) Instruct the server whether to reply to commands. <https://redis.io/commands/client-reply>
 * @method self clientSetname($connectionName) Set the current connection name. <https://redis.io/commands/client-setname>
 * @method self clusterAddslots(...$slots) Assign new hash slots to receiving node. <https://redis.io/commands/cluster-addslots>
 * @method self clusterCountkeysinslot($slot) Return the number of local keys in the specified hash slot. <https://redis.io/commands/cluster-countkeysinslot>
 * @method self clusterDelslots(...$slots) Set hash slots as unbound in receiving node. <https://redis.io/commands/cluster-delslots>
 * @method self clusterFailover($option = null) Forces a slave to perform a manual failover of its master.. <https://redis.io/commands/cluster-failover>
 * @method self clusterForget($nodeId) Remove a node from the nodes table. <https://redis.io/commands/cluster-forget>
 * @method self clusterGetkeysinslot($slot, $count) Return local key names in the specified hash slot. <https://redis.io/commands/cluster-getkeysinslot>
 * @method self clusterInfo() Provides info about Redis Cluster node state. <https://redis.io/commands/cluster-info>
 * @method self clusterKeyslot($key) Returns the hash slot of the specified key. <https://redis.io/commands/cluster-keyslot>
 * @method self clusterMeet($ip, $port) Force a node cluster to handshake with another node. <https://redis.io/commands/cluster-meet>
 * @method self clusterNodes() Get Cluster config for the node. <https://redis.io/commands/cluster-nodes>
 * @method self clusterReplicate($nodeId) Reconfigure a node as a slave of the specified master node. <https://redis.io/commands/cluster-replicate>
 * @method self clusterReset($resetType = "SOFT") Reset a Redis Cluster node. <https://redis.io/commands/cluster-reset>
 * @method self clusterSaveconfig() Forces the node to save cluster state on disk. <https://redis.io/commands/cluster-saveconfig>
 * @method self clusterSetslot($slot, $type, $nodeid = null) Bind a hash slot to a specific node. <https://redis.io/commands/cluster-setslot>
 * @method self clusterSlaves($nodeId) List slave nodes of the specified master node. <https://redis.io/commands/cluster-slaves>
 * @method self clusterSlots() Get array of Cluster slot to node mappings. <https://redis.io/commands/cluster-slots>
 * @method self command() Get array of Redis command details. <https://redis.io/commands/command>
 * @method self commandCount() Get total number of Redis commands. <https://redis.io/commands/command-count>
 * @method self commandGetkeys() Extract keys given a full Redis command. <https://redis.io/commands/command-getkeys>
 * @method self commandInfo(...$commandNames) Get array of specific Redis command details. <https://redis.io/commands/command-info>
 * @method self configGet($parameter) Get the value of a configuration parameter. <https://redis.io/commands/config-get>
 * @method self configRewrite() Rewrite the configuration file with the in memory configuration. <https://redis.io/commands/config-rewrite>
 * @method self configSet($parameter, $value) Set a configuration parameter to the given value. <https://redis.io/commands/config-set>
 * @method self configResetstat() Reset the stats returned by INFO. <https://redis.io/commands/config-resetstat>
 * @method self dbsize() Return the number of keys in the selected database. <https://redis.io/commands/dbsize>
 * @method self debugObject($key) Get debugging information about a key. <https://redis.io/commands/debug-object>
 * @method self debugSegfault() Make the server crash. <https://redis.io/commands/debug-segfault>
 * @method self decr($key) Decrement the integer value of a key by one. <https://redis.io/commands/decr>
 * @method self decrby($key, $decrement) Decrement the integer value of a key by the given number. <https://redis.io/commands/decrby>
 * @method self del(...$keys) Delete a key. <https://redis.io/commands/del>
 * @method self discard() Discard all commands issued after MULTI. <https://redis.io/commands/discard>
 * @method self dump($key) Return a serialized version of the value stored at the specified key.. <https://redis.io/commands/dump>
 * @method self echo($message) Echo the given string. <https://redis.io/commands/echo>
 * @method self eval($script, $numkeys, ...$keys, ...$args) Execute a Lua script server side. <https://redis.io/commands/eval>
 * @method self evalsha($sha1, $numkeys, ...$keys, ...$args) Execute a Lua script server side. <https://redis.io/commands/evalsha>
 * @method self exec() Execute all commands issued after MULTI. <https://redis.io/commands/exec>
 * @method self exists(...$keys) Determine if a key exists. <https://redis.io/commands/exists>
 * @method self expire($key, $seconds) Set a key's time to live in seconds. <https://redis.io/commands/expire>
 * @method self expireat($key, $timestamp) Set the expiration for a key as a UNIX timestamp. <https://redis.io/commands/expireat>
 * @method self flushall($ASYNC = null) Remove all keys from all databases. <https://redis.io/commands/flushall>
 * @method self flushdb($ASYNC = null) Remove all keys from the current database. <https://redis.io/commands/flushdb>
 * @method self geoadd($key, $longitude, $latitude, $member, ...$more) Add one or more geospatial items in the geospatial index represented using a sorted set. <https://redis.io/commands/geoadd>
 * @method self geohash($key, ...$members) Returns members of a geospatial index as standard geohash strings. <https://redis.io/commands/geohash>
 * @method self geopos($key, ...$members) Returns longitude and latitude of members of a geospatial index. <https://redis.io/commands/geopos>
 * @method self geodist($key, $member1, $member2, $unit = null) Returns the distance between two members of a geospatial index. <https://redis.io/commands/geodist>
 * @method self georadius($key, $longitude, $latitude, $radius, $metric, ...$options) Query a sorted set representing a geospatial index to fetch members matching a given maximum distance from a point. <https://redis.io/commands/georadius>
 * @method self georadiusbymember($key, $member, $radius, $metric, ...$options) Query a sorted set representing a geospatial index to fetch members matching a given maximum distance from a member. <https://redis.io/commands/georadiusbymember>
 * @method self get($key) Get the value of a key. <https://redis.io/commands/get>
 * @method self getbit($key, $offset) Returns the bit value at offset in the string value stored at key. <https://redis.io/commands/getbit>
 * @method self getrange($key, $start, $end) Get a substring of the string stored at a key. <https://redis.io/commands/getrange>
 * @method self getset($key, $value) Set the string value of a key and return its old value. <https://redis.io/commands/getset>
 * @method self hdel($key, ...$fields) Delete one or more hash fields. <https://redis.io/commands/hdel>
 * @method self hexists($key, $field) Determine if a hash field exists. <https://redis.io/commands/hexists>
 * @method self hget($key, $field) Get the value of a hash field. <https://redis.io/commands/hget>
 * @method self hgetall($key) Get all the fields and values in a hash. <https://redis.io/commands/hgetall>
 * @method self hincrby($key, $field, $increment) Increment the integer value of a hash field by the given number. <https://redis.io/commands/hincrby>
 * @method self hincrbyfloat($key, $field, $increment) Increment the float value of a hash field by the given amount. <https://redis.io/commands/hincrbyfloat>
 * @method self hkeys($key) Get all the fields in a hash. <https://redis.io/commands/hkeys>
 * @method self hlen($key) Get the number of fields in a hash. <https://redis.io/commands/hlen>
 * @method self hmget($key, ...$fields) Get the values of all the given hash fields. <https://redis.io/commands/hmget>
 * @method self hmset($key, $field, $value, ...$more) Set multiple hash fields to multiple values. <https://redis.io/commands/hmset>
 * @method self hset($key, $field, $value) Set the string value of a hash field. <https://redis.io/commands/hset>
 * @method self hsetnx($key, $field, $value) Set the value of a hash field, only if the field does not exist. <https://redis.io/commands/hsetnx>
 * @method self hstrlen($key, $field) Get the length of the value of a hash field. <https://redis.io/commands/hstrlen>
 * @method self hvals($key) Get all the values in a hash. <https://redis.io/commands/hvals>
 * @method self incr($key) Increment the integer value of a key by one. <https://redis.io/commands/incr>
 * @method self incrby($key, $increment) Increment the integer value of a key by the given amount. <https://redis.io/commands/incrby>
 * @method self incrbyfloat($key, $increment) Increment the float value of a key by the given amount. <https://redis.io/commands/incrbyfloat>
 * @method self info($section = null) Get information and statistics about the server. <https://redis.io/commands/info>
 * @method self keys($pattern) Find all keys matching the given pattern. <https://redis.io/commands/keys>
 * @method self lastsave() Get the UNIX time stamp of the last successful save to disk. <https://redis.io/commands/lastsave>
 * @method self lindex($key, $index) Get an element from a list by its index. <https://redis.io/commands/lindex>
 * @method self linsert($key, $where, $pivot, $value) Insert an element before or after another element in a list. <https://redis.io/commands/linsert>
 * @method self llen($key) Get the length of a list. <https://redis.io/commands/llen>
 * @method self lpop($key) Remove and get the first element in a list. <https://redis.io/commands/lpop>
 * @method self lpush($key, ...$values) Prepend one or multiple values to a list. <https://redis.io/commands/lpush>
 * @method self lpushx($key, $value) Prepend a value to a list, only if the list exists. <https://redis.io/commands/lpushx>
 * @method self lrange($key, $start, $stop) Get a range of elements from a list. <https://redis.io/commands/lrange>
 * @method self lrem($key, $count, $value) Remove elements from a list. <https://redis.io/commands/lrem>
 * @method self lset($key, $index, $value) Set the value of an element in a list by its index. <https://redis.io/commands/lset>
 * @method self ltrim($key, $start, $stop) Trim a list to the specified range. <https://redis.io/commands/ltrim>
 * @method self mget(...$keys) Get the values of all the given keys. <https://redis.io/commands/mget>
 * @method self migrate($host, $port, $key, $destinationDb, $timeout, ...$options) Atomically transfer a key from a Redis instance to another one.. <https://redis.io/commands/migrate>
 * @method self monitor() Listen for all requests received by the server in real time. <https://redis.io/commands/monitor>
 * @method self move($key, $db) Move a key to another database. <https://redis.io/commands/move>
 * @method self mset(...$keyValuePairs) Set multiple keys to multiple values. <https://redis.io/commands/mset>
 * @method self msetnx(...$keyValuePairs) Set multiple keys to multiple values, only if none of the keys exist. <https://redis.io/commands/msetnx>
 * @method self multi() Mark the start of a transaction block. <https://redis.io/commands/multi>
 * @method self object($subcommand, ...$argumentss) Inspect the internals of Redis objects. <https://redis.io/commands/object>
 * @method self persist($key) Remove the expiration from a key. <https://redis.io/commands/persist>
 * @method self pexpire($key, $milliseconds) Set a key's time to live in milliseconds. <https://redis.io/commands/pexpire>
 * @method self pexpireat($key, $millisecondsTimestamp) Set the expiration for a key as a UNIX timestamp specified in milliseconds. <https://redis.io/commands/pexpireat>
 * @method self pfadd($key, ...$elements) Adds the specified elements to the specified HyperLogLog.. <https://redis.io/commands/pfadd>
 * @method self pfcount(...$keys) Return the approximated cardinality of the set(s) observed by the HyperLogLog at key(s).. <https://redis.io/commands/pfcount>
 * @method self pfmerge($destkey, ...$sourcekeys) Merge N different HyperLogLogs into a single one.. <https://redis.io/commands/pfmerge>
 * @method self ping($message = null) Ping the server. <https://redis.io/commands/ping>
 * @method self psetex($key, $milliseconds, $value) Set the value and expiration in milliseconds of a key. <https://redis.io/commands/psetex>
 * @method self psubscribe(...$patterns) Listen for messages published to channels matching the given patterns. <https://redis.io/commands/psubscribe>
 * @method self pubsub($subcommand, ...$arguments) Inspect the state of the Pub/Sub subsystem. <https://redis.io/commands/pubsub>
 * @method self pttl($key) Get the time to live for a key in milliseconds. <https://redis.io/commands/pttl>
 * @method self publish($channel, $message) Post a message to a channel. <https://redis.io/commands/publish>
 * @method self punsubscribe(...$patterns) Stop listening for messages posted to channels matching the given patterns. <https://redis.io/commands/punsubscribe>
 * @method self quit() Close the connection. <https://redis.io/commands/quit>
 * @method self randomkey() Return a random key from the keyspace. <https://redis.io/commands/randomkey>
 * @method self readonly() Enables read queries for a connection to a cluster slave node. <https://redis.io/commands/readonly>
 * @method self readwrite() Disables read queries for a connection to a cluster slave node. <https://redis.io/commands/readwrite>
 * @method self rename($key, $newkey) Rename a key. <https://redis.io/commands/rename>
 * @method self renamenx($key, $newkey) Rename a key, only if the new key does not exist. <https://redis.io/commands/renamenx>
 * @method self restore($key, $ttl, $serializedValue, $REPLACE = null) Create a key using the provided serialized value, previously obtained using DUMP.. <https://redis.io/commands/restore>
 * @method self role() Return the role of the instance in the context of replication. <https://redis.io/commands/role>
 * @method self rpop($key) Remove and get the last element in a list. <https://redis.io/commands/rpop>
 * @method self rpoplpush($source, $destination) Remove the last element in a list, prepend it to another list and return it. <https://redis.io/commands/rpoplpush>
 * @method self rpush($key, ...$values) Append one or multiple values to a list. <https://redis.io/commands/rpush>
 * @method self rpushx($key, $value) Append a value to a list, only if the list exists. <https://redis.io/commands/rpushx>
 * @method self sadd($key, ...$members) Add one or more members to a set. <https://redis.io/commands/sadd>
 * @method self save() Synchronously save the dataset to disk. <https://redis.io/commands/save>
 * @method self scard($key) Get the number of members in a set. <https://redis.io/commands/scard>
 * @method self scriptDebug($option) Set the debug mode for executed scripts.. <https://redis.io/commands/script-debug>
 * @method self scriptExists(...$sha1s) Check existence of scripts in the script cache.. <https://redis.io/commands/script-exists>
 * @method self scriptFlush() Remove all the scripts from the script cache.. <https://redis.io/commands/script-flush>
 * @method self scriptKill() Kill the script currently in execution.. <https://redis.io/commands/script-kill>
 * @method self scriptLoad($script) Load the specified Lua script into the script cache.. <https://redis.io/commands/script-load>
 * @method self sdiff(...$keys) Subtract multiple sets. <https://redis.io/commands/sdiff>
 * @method self sdiffstore($destination, ...$keys) Subtract multiple sets and store the resulting set in a key. <https://redis.io/commands/sdiffstore>
 * @method self select($index) Change the selected database for the current connection. <https://redis.io/commands/select>
 * @method self setbit($key, $offset, $value) Sets or clears the bit at offset in the string value stored at key. <https://redis.io/commands/setbit>
 * @method self set($key, $value, $ex = null) Set the string value of a key. <https://redis.io/commands/set>
 * @method self setex($key, $seconds, $value) Set the value and expiration of a key. <https://redis.io/commands/setex>
 * @method self setnx($key, $value) Set the value of a key, only if the key does not exist. <https://redis.io/commands/setnx>
 * @method self setrange($key, $offset, $value) Overwrite part of a string at key starting at the specified offset. <https://redis.io/commands/setrange>
 * @method self shutdown($saveOption = null) Synchronously save the dataset to disk and then shut down the server. <https://redis.io/commands/shutdown>
 * @method self sinter(...$keys) Intersect multiple sets. <https://redis.io/commands/sinter>
 * @method self sinterstore($destination, ...$keys) Intersect multiple sets and store the resulting set in a key. <https://redis.io/commands/sinterstore>
 * @method self sismember($key, $member) Determine if a given value is a member of a set. <https://redis.io/commands/sismember>
 * @method self slaveof($host, $port) Make the server a slave of another instance, or promote it as master. <https://redis.io/commands/slaveof>
 * @method self slowlog($subcommand, $argument = null) Manages the Redis slow queries log. <https://redis.io/commands/slowlog>
 * @method self smembers($key) Get all the members in a set. <https://redis.io/commands/smembers>
 * @method self smove($source, $destination, $member) Move a member from one set to another. <https://redis.io/commands/smove>
 * @method self sort($key, ...$options) Sort the elements in a list, set or sorted set. <https://redis.io/commands/sort>
 * @method self spop($key, $count = null) Remove and return one or multiple random members from a set. <https://redis.io/commands/spop>
 * @method self srandmember($key, $count = null) Get one or multiple random members from a set. <https://redis.io/commands/srandmember>
 * @method self srem($key, ...$members) Remove one or more members from a set. <https://redis.io/commands/srem>
 * @method self strlen($key) Get the length of the value stored in a key. <https://redis.io/commands/strlen>
 * @method self subscribe(...$channels) Listen for messages published to the given channels. <https://redis.io/commands/subscribe>
 * @method self sunion(...$keys) Add multiple sets. <https://redis.io/commands/sunion>
 * @method self sunionstore($destination, ...$keys) Add multiple sets and store the resulting set in a key. <https://redis.io/commands/sunionstore>
 * @method self swapdb($index, $index) Swaps two Redis databases. <https://redis.io/commands/swapdb>
 * @method self sync() Internal command used for replication. <https://redis.io/commands/sync>
 * @method self time() Return the current server time. <https://redis.io/commands/time>
 * @method self touch(...$keys) Alters the last access time of a key(s). Returns the number of existing keys specified.. <https://redis.io/commands/touch>
 * @method self ttl($key) Get the time to live for a key. <https://redis.io/commands/ttl>
 * @method self type($key) Determine the type stored at key. <https://redis.io/commands/type>
 * @method self unsubscribe(...$channels) Stop listening for messages posted to the given channels. <https://redis.io/commands/unsubscribe>
 * @method self unlink(...$keys) Delete a key asynchronously in another thread. Otherwise it is just as DEL, but non blocking.. <https://redis.io/commands/unlink>
 * @method self unwatch() Forget about all watched keys. <https://redis.io/commands/unwatch>
 * @method self wait($numslaves, $timeout) Wait for the synchronous replication of all the write commands sent in the context of the current connection. <https://redis.io/commands/wait>
 * @method self watch(...$keys) Watch the given keys to determine execution of the MULTI/EXEC block. <https://redis.io/commands/watch>
 * @method self zadd($key, ...$options) Add one or more members to a sorted set, or update its score if it already exists. <https://redis.io/commands/zadd>
 * @method self zcard($key) Get the number of members in a sorted set. <https://redis.io/commands/zcard>
 * @method self zcount($key, $min, $max) Count the members in a sorted set with scores within the given values. <https://redis.io/commands/zcount>
 * @method self zincrby($key, $increment, $member) Increment the score of a member in a sorted set. <https://redis.io/commands/zincrby>
 * @method self zinterstore($destination, $numkeys, $key, ...$options) Intersect multiple sorted sets and store the resulting sorted set in a new key. <https://redis.io/commands/zinterstore>
 * @method self zlexcount($key, $min, $max) Count the number of members in a sorted set between a given lexicographical range. <https://redis.io/commands/zlexcount>
 * @method self zrange($key, $start, $stop, $WITHSCORES = null) Return a range of members in a sorted set, by index. <https://redis.io/commands/zrange>
 * @method self zrangebylex($key, $min, $max, $LIMIT = null, $offset = null, $count = null) Return a range of members in a sorted set, by lexicographical range. <https://redis.io/commands/zrangebylex>
 * @method self zrevrangebylex($key, $max, $min, $LIMIT = null, $offset = null, $count = null) Return a range of members in a sorted set, by lexicographical range, ordered from higher to lower strings.. <https://redis.io/commands/zrevrangebylex>
 * @method self zrangebyscore($key, $min, $max, $WITHSCORES = null, $LIMIT = null, $offset = null, $count = null) Return a range of members in a sorted set, by score. <https://redis.io/commands/zrangebyscore>
 * @method self zrank($key, $member) Determine the index of a member in a sorted set. <https://redis.io/commands/zrank>
 * @method self zrem($key, ...$members) Remove one or more members from a sorted set. <https://redis.io/commands/zrem>
 * @method self zremrangebylex($key, $min, $max) Remove all members in a sorted set between the given lexicographical range. <https://redis.io/commands/zremrangebylex>
 * @method self zremrangebyrank($key, $start, $stop) Remove all members in a sorted set within the given indexes. <https://redis.io/commands/zremrangebyrank>
 * @method self zremrangebyscore($key, $min, $max) Remove all members in a sorted set within the given scores. <https://redis.io/commands/zremrangebyscore>
 * @method self zrevrange($key, $start, $stop, $WITHSCORES = null) Return a range of members in a sorted set, by index, with scores ordered from high to low. <https://redis.io/commands/zrevrange>
 * @method self zrevrangebyscore($key, $max, $min, $WITHSCORES = null, $LIMIT = null, $offset = null, $count = null) Return a range of members in a sorted set, by score, with scores ordered from high to low. <https://redis.io/commands/zrevrangebyscore>
 * @method self zrevrank($key, $member) Determine the index of a member in a sorted set, with scores ordered from high to low. <https://redis.io/commands/zrevrank>
 * @method self zscore($key, $member) Get the score associated with the given member in a sorted set. <https://redis.io/commands/zscore>
 * @method self zunionstore($destination, $numkeys, $key, ...$options) Add multiple sorted sets and store the resulting sorted set in a new key. <https://redis.io/commands/zunionstore>
 * @method self scan($cursor, $MATCH = null, $pattern = null, $COUNT = null, $count = null) Incrementally iterate the keys space. <https://redis.io/commands/scan>
 * @method self sscan($key, $cursor, $MATCH = null, $pattern = null, $COUNT = null, $count = null) Incrementally iterate Set elements. <https://redis.io/commands/sscan>
 * @method self hscan($key, $cursor, $MATCH = null, $pattern = null, $COUNT = null, $count = null) Incrementally iterate hash fields and associated values. <https://redis.io/commands/hscan>
 * @method self zscan($key, $cursor, $MATCH = null, $pattern = null, $COUNT = null, $count = null) Incrementally iterate sorted sets elements and associated scores. <https://redis.io/commands/zscan>
 *
 */
class RedisChainExecution extends BaseObject
{
    /**
     * @var ClientConnection Dedicated connection not withing pool
     */
    public $client;
    /**
     * @var LazyPromise[]
     */
    protected $_commands = [];

    /**
     * Execute all commands
     * @return \Reaction\Promise\ExtendedPromiseInterface
     */
    public function execute()
    {
        return allInOrder($this->_commands)
            ->always(function() {
                $this->client->end();
            });
    }

    /**
     * Allows issuing all supported commands via magic methods.
     *
     * ```php
     * $redis->hmset('test_collection', 'key1', 'val1', 'key2', 'val2')
     * ```
     *
     * @param string $name name of the missing method to execute
     * @param array $arguments method call arguments
     * @return RedisChainExecution|mixed
     */
    public function __call($name, $arguments)
    {
        $redisCommand = strtoupper(Inflector::camel2words($name, false));
        if (in_array($redisCommand, Client::$redisCommands)) {
            return $this->addCommandToStack($redisCommand, $arguments);
        } else {
            parent::__call($name, $arguments);
            return $this;
        }
    }

    protected function addCommandToStack($redisCommand, $arguments)
    {
        $this->_commands[] = $this->client->executeCommandLazy($redisCommand, $arguments);
        return $this;
    }
}