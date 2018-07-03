<?php

namespace Reaction\Redis;

use Reaction\Promise\ExtendedPromiseInterface as EPI;

/**
 * Trait RedisCommandsExecutorTrait
 * @package Reaction\Redis
 *
 * @method EPI append($key, $value) Append a value to a key. <https://redis.io/commands/append>
 * @method EPI auth($password) Authenticate to the server. <https://redis.io/commands/auth>
 * @method EPI bgrewriteaof() Asynchronously rewrite the append-only file. <https://redis.io/commands/bgrewriteaof>
 * @method EPI bgsave() Asynchronously save the dataset to disk. <https://redis.io/commands/bgsave>
 * @method EPI bitcount($key, $start = null, $end = null) Count set bits in a string. <https://redis.io/commands/bitcount>
 * @method EPI bitfield($key, ...$operations) Perform arbitrary bitfield integer operations on strings. <https://redis.io/commands/bitfield>
 * @method EPI bitop($operation, $destkey, ...$keys) Perform bitwise operations between strings. <https://redis.io/commands/bitop>
 * @method EPI bitpos($key, $bit, $start = null, $end = null) Find first bit set or clear in a string. <https://redis.io/commands/bitpos>
 * @method EPI blpop(...$keys, $timeout) Remove and get the first element in a list, or block until one is available. <https://redis.io/commands/blpop>
 * @method EPI brpop(...$keys, $timeout) Remove and get the last element in a list, or block until one is available. <https://redis.io/commands/brpop>
 * @method EPI brpoplpush($source, $destination, $timeout) Pop a value from a list, push it to another list and return it; or block until one is available. <https://redis.io/commands/brpoplpush>
 * @method EPI clientKill(...$filters) Kill the connection of a client. <https://redis.io/commands/client-kill>
 * @method EPI clientList() Get the list of client connections. <https://redis.io/commands/client-list>
 * @method EPI clientGetname() Get the current connection name. <https://redis.io/commands/client-getname>
 * @method EPI clientPause($timeout) Stop processing commands from clients for some time. <https://redis.io/commands/client-pause>
 * @method EPI clientReply($option) Instruct the server whether to reply to commands. <https://redis.io/commands/client-reply>
 * @method EPI clientSetname($connectionName) Set the current connection name. <https://redis.io/commands/client-setname>
 * @method EPI clusterAddslots(...$slots) Assign new hash slots to receiving node. <https://redis.io/commands/cluster-addslots>
 * @method EPI clusterCountkeysinslot($slot) Return the number of local keys in the specified hash slot. <https://redis.io/commands/cluster-countkeysinslot>
 * @method EPI clusterDelslots(...$slots) Set hash slots as unbound in receiving node. <https://redis.io/commands/cluster-delslots>
 * @method EPI clusterFailover($option = null) Forces a slave to perform a manual failover of its master.. <https://redis.io/commands/cluster-failover>
 * @method EPI clusterForget($nodeId) Remove a node from the nodes table. <https://redis.io/commands/cluster-forget>
 * @method EPI clusterGetkeysinslot($slot, $count) Return local key names in the specified hash slot. <https://redis.io/commands/cluster-getkeysinslot>
 * @method EPI clusterInfo() Provides info about Redis Cluster node state. <https://redis.io/commands/cluster-info>
 * @method EPI clusterKeyslot($key) Returns the hash slot of the specified key. <https://redis.io/commands/cluster-keyslot>
 * @method EPI clusterMeet($ip, $port) Force a node cluster to handshake with another node. <https://redis.io/commands/cluster-meet>
 * @method EPI clusterNodes() Get Cluster config for the node. <https://redis.io/commands/cluster-nodes>
 * @method EPI clusterReplicate($nodeId) Reconfigure a node as a slave of the specified master node. <https://redis.io/commands/cluster-replicate>
 * @method EPI clusterReset($resetType = "SOFT") Reset a Redis Cluster node. <https://redis.io/commands/cluster-reset>
 * @method EPI clusterSaveconfig() Forces the node to save cluster state on disk. <https://redis.io/commands/cluster-saveconfig>
 * @method EPI clusterSetslot($slot, $type, $nodeid = null) Bind a hash slot to a specific node. <https://redis.io/commands/cluster-setslot>
 * @method EPI clusterSlaves($nodeId) List slave nodes of the specified master node. <https://redis.io/commands/cluster-slaves>
 * @method EPI clusterSlots() Get array of Cluster slot to node mappings. <https://redis.io/commands/cluster-slots>
 * @method EPI command() Get array of Redis command details. <https://redis.io/commands/command>
 * @method EPI commandCount() Get total number of Redis commands. <https://redis.io/commands/command-count>
 * @method EPI commandGetkeys() Extract keys given a full Redis command. <https://redis.io/commands/command-getkeys>
 * @method EPI commandInfo(...$commandNames) Get array of specific Redis command details. <https://redis.io/commands/command-info>
 * @method EPI configGet($parameter) Get the value of a configuration parameter. <https://redis.io/commands/config-get>
 * @method EPI configRewrite() Rewrite the configuration file with the in memory configuration. <https://redis.io/commands/config-rewrite>
 * @method EPI configSet($parameter, $value) Set a configuration parameter to the given value. <https://redis.io/commands/config-set>
 * @method EPI configResetstat() Reset the stats returned by INFO. <https://redis.io/commands/config-resetstat>
 * @method EPI dbsize() Return the number of keys in the selected database. <https://redis.io/commands/dbsize>
 * @method EPI debugObject($key) Get debugging information about a key. <https://redis.io/commands/debug-object>
 * @method EPI debugSegfault() Make the server crash. <https://redis.io/commands/debug-segfault>
 * @method EPI decr($key) Decrement the integer value of a key by one. <https://redis.io/commands/decr>
 * @method EPI decrby($key, $decrement) Decrement the integer value of a key by the given number. <https://redis.io/commands/decrby>
 * @method EPI del(...$keys) Delete a key. <https://redis.io/commands/del>
 * @method EPI discard() Discard all commands issued after MULTI. <https://redis.io/commands/discard>
 * @method EPI dump($key) Return a serialized version of the value stored at the specified key.. <https://redis.io/commands/dump>
 * @method EPI echo($message) Echo the given string. <https://redis.io/commands/echo>
 * @method EPI eval($script, $numkeys, ...$keys, ...$args) Execute a Lua script server side. <https://redis.io/commands/eval>
 * @method EPI evalsha($sha1, $numkeys, ...$keys, ...$args) Execute a Lua script server side. <https://redis.io/commands/evalsha>
 * @method EPI exec() Execute all commands issued after MULTI. <https://redis.io/commands/exec>
 * @method EPI exists(...$keys) Determine if a key exists. <https://redis.io/commands/exists>
 * @method EPI expire($key, $seconds) Set a key's time to live in seconds. <https://redis.io/commands/expire>
 * @method EPI expireat($key, $timestamp) Set the expiration for a key as a UNIX timestamp. <https://redis.io/commands/expireat>
 * @method EPI flushall($ASYNC = null) Remove all keys from all databases. <https://redis.io/commands/flushall>
 * @method EPI flushdb($ASYNC = null) Remove all keys from the current database. <https://redis.io/commands/flushdb>
 * @method EPI geoadd($key, $longitude, $latitude, $member, ...$more) Add one or more geospatial items in the geospatial index represented using a sorted set. <https://redis.io/commands/geoadd>
 * @method EPI geohash($key, ...$members) Returns members of a geospatial index as standard geohash strings. <https://redis.io/commands/geohash>
 * @method EPI geopos($key, ...$members) Returns longitude and latitude of members of a geospatial index. <https://redis.io/commands/geopos>
 * @method EPI geodist($key, $member1, $member2, $unit = null) Returns the distance between two members of a geospatial index. <https://redis.io/commands/geodist>
 * @method EPI georadius($key, $longitude, $latitude, $radius, $metric, ...$options) Query a sorted set representing a geospatial index to fetch members matching a given maximum distance from a point. <https://redis.io/commands/georadius>
 * @method EPI georadiusbymember($key, $member, $radius, $metric, ...$options) Query a sorted set representing a geospatial index to fetch members matching a given maximum distance from a member. <https://redis.io/commands/georadiusbymember>
 * @method EPI get($key) Get the value of a key. <https://redis.io/commands/get>
 * @method EPI getbit($key, $offset) Returns the bit value at offset in the string value stored at key. <https://redis.io/commands/getbit>
 * @method EPI getrange($key, $start, $end) Get a substring of the string stored at a key. <https://redis.io/commands/getrange>
 * @method EPI getset($key, $value) Set the string value of a key and return its old value. <https://redis.io/commands/getset>
 * @method EPI hdel($key, ...$fields) Delete one or more hash fields. <https://redis.io/commands/hdel>
 * @method EPI hexists($key, $field) Determine if a hash field exists. <https://redis.io/commands/hexists>
 * @method EPI hget($key, $field) Get the value of a hash field. <https://redis.io/commands/hget>
 * @method EPI hgetall($key) Get all the fields and values in a hash. <https://redis.io/commands/hgetall>
 * @method EPI hincrby($key, $field, $increment) Increment the integer value of a hash field by the given number. <https://redis.io/commands/hincrby>
 * @method EPI hincrbyfloat($key, $field, $increment) Increment the float value of a hash field by the given amount. <https://redis.io/commands/hincrbyfloat>
 * @method EPI hkeys($key) Get all the fields in a hash. <https://redis.io/commands/hkeys>
 * @method EPI hlen($key) Get the number of fields in a hash. <https://redis.io/commands/hlen>
 * @method EPI hmget($key, ...$fields) Get the values of all the given hash fields. <https://redis.io/commands/hmget>
 * @method EPI hmset($key, $field, $value, ...$more) Set multiple hash fields to multiple values. <https://redis.io/commands/hmset>
 * @method EPI hset($key, $field, $value) Set the string value of a hash field. <https://redis.io/commands/hset>
 * @method EPI hsetnx($key, $field, $value) Set the value of a hash field, only if the field does not exist. <https://redis.io/commands/hsetnx>
 * @method EPI hstrlen($key, $field) Get the length of the value of a hash field. <https://redis.io/commands/hstrlen>
 * @method EPI hvals($key) Get all the values in a hash. <https://redis.io/commands/hvals>
 * @method EPI incr($key) Increment the integer value of a key by one. <https://redis.io/commands/incr>
 * @method EPI incrby($key, $increment) Increment the integer value of a key by the given amount. <https://redis.io/commands/incrby>
 * @method EPI incrbyfloat($key, $increment) Increment the float value of a key by the given amount. <https://redis.io/commands/incrbyfloat>
 * @method EPI info($section = null) Get information and statistics about the server. <https://redis.io/commands/info>
 * @method EPI keys($pattern) Find all keys matching the given pattern. <https://redis.io/commands/keys>
 * @method EPI lastsave() Get the UNIX time stamp of the last successful save to disk. <https://redis.io/commands/lastsave>
 * @method EPI lindex($key, $index) Get an element from a list by its index. <https://redis.io/commands/lindex>
 * @method EPI linsert($key, $where, $pivot, $value) Insert an element before or after another element in a list. <https://redis.io/commands/linsert>
 * @method EPI llen($key) Get the length of a list. <https://redis.io/commands/llen>
 * @method EPI lpop($key) Remove and get the first element in a list. <https://redis.io/commands/lpop>
 * @method EPI lpush($key, ...$values) Prepend one or multiple values to a list. <https://redis.io/commands/lpush>
 * @method EPI lpushx($key, $value) Prepend a value to a list, only if the list exists. <https://redis.io/commands/lpushx>
 * @method EPI lrange($key, $start, $stop) Get a range of elements from a list. <https://redis.io/commands/lrange>
 * @method EPI lrem($key, $count, $value) Remove elements from a list. <https://redis.io/commands/lrem>
 * @method EPI lset($key, $index, $value) Set the value of an element in a list by its index. <https://redis.io/commands/lset>
 * @method EPI ltrim($key, $start, $stop) Trim a list to the specified range. <https://redis.io/commands/ltrim>
 * @method EPI mget(...$keys) Get the values of all the given keys. <https://redis.io/commands/mget>
 * @method EPI migrate($host, $port, $key, $destinationDb, $timeout, ...$options) Atomically transfer a key from a Redis instance to another one.. <https://redis.io/commands/migrate>
 * @method EPI monitor() Listen for all requests received by the server in real time. <https://redis.io/commands/monitor>
 * @method EPI move($key, $db) Move a key to another database. <https://redis.io/commands/move>
 * @method EPI mset(...$keyValuePairs) Set multiple keys to multiple values. <https://redis.io/commands/mset>
 * @method EPI msetnx(...$keyValuePairs) Set multiple keys to multiple values, only if none of the keys exist. <https://redis.io/commands/msetnx>
 * @method EPI multi() Mark the start of a transaction block. <https://redis.io/commands/multi>
 * @method EPI object($subcommand, ...$argumentss) Inspect the internals of Redis objects. <https://redis.io/commands/object>
 * @method EPI persist($key) Remove the expiration from a key. <https://redis.io/commands/persist>
 * @method EPI pexpire($key, $milliseconds) Set a key's time to live in milliseconds. <https://redis.io/commands/pexpire>
 * @method EPI pexpireat($key, $millisecondsTimestamp) Set the expiration for a key as a UNIX timestamp specified in milliseconds. <https://redis.io/commands/pexpireat>
 * @method EPI pfadd($key, ...$elements) Adds the specified elements to the specified HyperLogLog.. <https://redis.io/commands/pfadd>
 * @method EPI pfcount(...$keys) Return the approximated cardinality of the set(s) observed by the HyperLogLog at key(s).. <https://redis.io/commands/pfcount>
 * @method EPI pfmerge($destkey, ...$sourcekeys) Merge N different HyperLogLogs into a single one.. <https://redis.io/commands/pfmerge>
 * @method EPI ping($message = null) Ping the server. <https://redis.io/commands/ping>
 * @method EPI psetex($key, $milliseconds, $value) Set the value and expiration in milliseconds of a key. <https://redis.io/commands/psetex>
 * @method EPI psubscribe(...$patterns) Listen for messages published to channels matching the given patterns. <https://redis.io/commands/psubscribe>
 * @method EPI pubsub($subcommand, ...$arguments) Inspect the state of the Pub/Sub subsystem. <https://redis.io/commands/pubsub>
 * @method EPI pttl($key) Get the time to live for a key in milliseconds. <https://redis.io/commands/pttl>
 * @method EPI publish($channel, $message) Post a message to a channel. <https://redis.io/commands/publish>
 * @method EPI punsubscribe(...$patterns) Stop listening for messages posted to channels matching the given patterns. <https://redis.io/commands/punsubscribe>
 * @method EPI quit() Close the connection. <https://redis.io/commands/quit>
 * @method EPI randomkey() Return a random key from the keyspace. <https://redis.io/commands/randomkey>
 * @method EPI readonly() Enables read queries for a connection to a cluster slave node. <https://redis.io/commands/readonly>
 * @method EPI readwrite() Disables read queries for a connection to a cluster slave node. <https://redis.io/commands/readwrite>
 * @method EPI rename($key, $newkey) Rename a key. <https://redis.io/commands/rename>
 * @method EPI renamenx($key, $newkey) Rename a key, only if the new key does not exist. <https://redis.io/commands/renamenx>
 * @method EPI restore($key, $ttl, $serializedValue, $REPLACE = null) Create a key using the provided serialized value, previously obtained using DUMP.. <https://redis.io/commands/restore>
 * @method EPI role() Return the role of the instance in the context of replication. <https://redis.io/commands/role>
 * @method EPI rpop($key) Remove and get the last element in a list. <https://redis.io/commands/rpop>
 * @method EPI rpoplpush($source, $destination) Remove the last element in a list, prepend it to another list and return it. <https://redis.io/commands/rpoplpush>
 * @method EPI rpush($key, ...$values) Append one or multiple values to a list. <https://redis.io/commands/rpush>
 * @method EPI rpushx($key, $value) Append a value to a list, only if the list exists. <https://redis.io/commands/rpushx>
 * @method EPI sadd($key, ...$members) Add one or more members to a set. <https://redis.io/commands/sadd>
 * @method EPI save() Synchronously save the dataset to disk. <https://redis.io/commands/save>
 * @method EPI scard($key) Get the number of members in a set. <https://redis.io/commands/scard>
 * @method EPI scriptDebug($option) Set the debug mode for executed scripts.. <https://redis.io/commands/script-debug>
 * @method EPI scriptExists(...$sha1s) Check existence of scripts in the script cache.. <https://redis.io/commands/script-exists>
 * @method EPI scriptFlush() Remove all the scripts from the script cache.. <https://redis.io/commands/script-flush>
 * @method EPI scriptKill() Kill the script currently in execution.. <https://redis.io/commands/script-kill>
 * @method EPI scriptLoad($script) Load the specified Lua script into the script cache.. <https://redis.io/commands/script-load>
 * @method EPI sdiff(...$keys) Subtract multiple sets. <https://redis.io/commands/sdiff>
 * @method EPI sdiffstore($destination, ...$keys) Subtract multiple sets and store the resulting set in a key. <https://redis.io/commands/sdiffstore>
 * @method EPI select($index) Change the selected database for the current connection. <https://redis.io/commands/select>
 * @method EPI setbit($key, $offset, $value) Sets or clears the bit at offset in the string value stored at key. <https://redis.io/commands/setbit>
 * @method EPI setex($key, $seconds, $value) Set the value and expiration of a key. <https://redis.io/commands/setex>
 * @method EPI setnx($key, $value) Set the value of a key, only if the key does not exist. <https://redis.io/commands/setnx>
 * @method EPI setrange($key, $offset, $value) Overwrite part of a string at key starting at the specified offset. <https://redis.io/commands/setrange>
 * @method EPI shutdown($saveOption = null) Synchronously save the dataset to disk and then shut down the server. <https://redis.io/commands/shutdown>
 * @method EPI sinter(...$keys) Intersect multiple sets. <https://redis.io/commands/sinter>
 * @method EPI sinterstore($destination, ...$keys) Intersect multiple sets and store the resulting set in a key. <https://redis.io/commands/sinterstore>
 * @method EPI sismember($key, $member) Determine if a given value is a member of a set. <https://redis.io/commands/sismember>
 * @method EPI slaveof($host, $port) Make the server a slave of another instance, or promote it as master. <https://redis.io/commands/slaveof>
 * @method EPI slowlog($subcommand, $argument = null) Manages the Redis slow queries log. <https://redis.io/commands/slowlog>
 * @method EPI smembers($key) Get all the members in a set. <https://redis.io/commands/smembers>
 * @method EPI smove($source, $destination, $member) Move a member from one set to another. <https://redis.io/commands/smove>
 * @method EPI sort($key, ...$options) Sort the elements in a list, set or sorted set. <https://redis.io/commands/sort>
 * @method EPI spop($key, $count = null) Remove and return one or multiple random members from a set. <https://redis.io/commands/spop>
 * @method EPI srandmember($key, $count = null) Get one or multiple random members from a set. <https://redis.io/commands/srandmember>
 * @method EPI srem($key, ...$members) Remove one or more members from a set. <https://redis.io/commands/srem>
 * @method EPI strlen($key) Get the length of the value stored in a key. <https://redis.io/commands/strlen>
 * @method EPI subscribe(...$channels) Listen for messages published to the given channels. <https://redis.io/commands/subscribe>
 * @method EPI sunion(...$keys) Add multiple sets. <https://redis.io/commands/sunion>
 * @method EPI sunionstore($destination, ...$keys) Add multiple sets and store the resulting set in a key. <https://redis.io/commands/sunionstore>
 * @method EPI swapdb($index, $index) Swaps two Redis databases. <https://redis.io/commands/swapdb>
 * @method EPI sync() Internal command used for replication. <https://redis.io/commands/sync>
 * @method EPI time() Return the current server time. <https://redis.io/commands/time>
 * @method EPI touch(...$keys) Alters the last access time of a key(s). Returns the number of existing keys specified.. <https://redis.io/commands/touch>
 * @method EPI ttl($key) Get the time to live for a key. <https://redis.io/commands/ttl>
 * @method EPI type($key) Determine the type stored at key. <https://redis.io/commands/type>
 * @method EPI unsubscribe(...$channels) Stop listening for messages posted to the given channels. <https://redis.io/commands/unsubscribe>
 * @method EPI unlink(...$keys) Delete a key asynchronously in another thread. Otherwise it is just as DEL, but non blocking.. <https://redis.io/commands/unlink>
 * @method EPI unwatch() Forget about all watched keys. <https://redis.io/commands/unwatch>
 * @method EPI wait($numslaves, $timeout) Wait for the synchronous replication of all the write commands sent in the context of the current connection. <https://redis.io/commands/wait>
 * @method EPI watch(...$keys) Watch the given keys to determine execution of the MULTI/EXEC block. <https://redis.io/commands/watch>
 * @method EPI zadd($key, ...$options) Add one or more members to a sorted set, or update its score if it already exists. <https://redis.io/commands/zadd>
 * @method EPI zcard($key) Get the number of members in a sorted set. <https://redis.io/commands/zcard>
 * @method EPI zcount($key, $min, $max) Count the members in a sorted set with scores within the given values. <https://redis.io/commands/zcount>
 * @method EPI zincrby($key, $increment, $member) Increment the score of a member in a sorted set. <https://redis.io/commands/zincrby>
 * @method EPI zinterstore($destination, $numkeys, $key, ...$options) Intersect multiple sorted sets and store the resulting sorted set in a new key. <https://redis.io/commands/zinterstore>
 * @method EPI zlexcount($key, $min, $max) Count the number of members in a sorted set between a given lexicographical range. <https://redis.io/commands/zlexcount>
 * @method EPI zrange($key, $start, $stop, $WITHSCORES = null) Return a range of members in a sorted set, by index. <https://redis.io/commands/zrange>
 * @method EPI zrangebylex($key, $min, $max, $LIMIT = null, $offset = null, $count = null) Return a range of members in a sorted set, by lexicographical range. <https://redis.io/commands/zrangebylex>
 * @method EPI zrevrangebylex($key, $max, $min, $LIMIT = null, $offset = null, $count = null) Return a range of members in a sorted set, by lexicographical range, ordered from higher to lower strings.. <https://redis.io/commands/zrevrangebylex>
 * @method EPI zrangebyscore($key, $min, $max, $WITHSCORES = null, $LIMIT = null, $offset = null, $count = null) Return a range of members in a sorted set, by score. <https://redis.io/commands/zrangebyscore>
 * @method EPI zrank($key, $member) Determine the index of a member in a sorted set. <https://redis.io/commands/zrank>
 * @method EPI zrem($key, ...$members) Remove one or more members from a sorted set. <https://redis.io/commands/zrem>
 * @method EPI zremrangebylex($key, $min, $max) Remove all members in a sorted set between the given lexicographical range. <https://redis.io/commands/zremrangebylex>
 * @method EPI zremrangebyrank($key, $start, $stop) Remove all members in a sorted set within the given indexes. <https://redis.io/commands/zremrangebyrank>
 * @method EPI zremrangebyscore($key, $min, $max) Remove all members in a sorted set within the given scores. <https://redis.io/commands/zremrangebyscore>
 * @method EPI zrevrange($key, $start, $stop, $WITHSCORES = null) Return a range of members in a sorted set, by index, with scores ordered from high to low. <https://redis.io/commands/zrevrange>
 * @method EPI zrevrangebyscore($key, $max, $min, $WITHSCORES = null, $LIMIT = null, $offset = null, $count = null) Return a range of members in a sorted set, by score, with scores ordered from high to low. <https://redis.io/commands/zrevrangebyscore>
 * @method EPI zrevrank($key, $member) Determine the index of a member in a sorted set, with scores ordered from high to low. <https://redis.io/commands/zrevrank>
 * @method EPI zscore($key, $member) Get the score associated with the given member in a sorted set. <https://redis.io/commands/zscore>
 * @method EPI zunionstore($destination, $numkeys, $key, ...$options) Add multiple sorted sets and store the resulting sorted set in a new key. <https://redis.io/commands/zunionstore>
 * @method EPI scan($cursor, $MATCH = null, $pattern = null, $COUNT = null, $count = null) Incrementally iterate the keys space. <https://redis.io/commands/scan>
 * @method EPI sscan($key, $cursor, $MATCH = null, $pattern = null, $COUNT = null, $count = null) Incrementally iterate Set elements. <https://redis.io/commands/sscan>
 * @method EPI hscan($key, $cursor, $MATCH = null, $pattern = null, $COUNT = null, $count = null) Incrementally iterate hash fields and associated values. <https://redis.io/commands/hscan>
 * @method EPI zscan($key, $cursor, $MATCH = null, $pattern = null, $COUNT = null, $count = null) Incrementally iterate sorted sets elements and associated scores. <https://redis.io/commands/zscan>
 *
 */
trait RedisCommandsExecutorTrait
{
    /**
     * SET command.
     * Set the string value of a key.
     * @param string   $key Key name
     * @param mixed    $value Value to store
     * @param int|null $ex Expire time in seconds
     * @return EPI
     */
    public function set($key, $value, $ex = null)
    {
        $command = isset($ex) ? 'setex' : 'set';
        $arguments = isset($ex) ? [$key, $ex, $value] : [$key, $value];
        return $this->executeCommand($command, $arguments);
    }
}