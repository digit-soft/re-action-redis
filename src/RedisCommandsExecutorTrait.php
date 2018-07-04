<?php

namespace Reaction\Redis;

use Reaction\Promise\ExtendedPromiseInterface;

/**
 * Trait RedisCommandsExecutorTrait
 * @package Reaction\Redis
 *
 * @method ExtendedPromiseInterface append($key, $value) Append a value to a key. <https://redis.io/commands/append>
 * @method ExtendedPromiseInterface auth($password) Authenticate to the server. <https://redis.io/commands/auth>
 * @method ExtendedPromiseInterface bgrewriteaof() Asynchronously rewrite the append-only file. <https://redis.io/commands/bgrewriteaof>
 * @method ExtendedPromiseInterface bgsave() Asynchronously save the dataset to disk. <https://redis.io/commands/bgsave>
 * @method ExtendedPromiseInterface bitcount($key, $start = null, $end = null) Count set bits in a string. <https://redis.io/commands/bitcount>
 * @method ExtendedPromiseInterface bitfield($key, ...$operations) Perform arbitrary bitfield integer operations on strings. <https://redis.io/commands/bitfield>
 * @method ExtendedPromiseInterface bitop($operation, $destkey, ...$keys) Perform bitwise operations between strings. <https://redis.io/commands/bitop>
 * @method ExtendedPromiseInterface bitpos($key, $bit, $start = null, $end = null) Find first bit set or clear in a string. <https://redis.io/commands/bitpos>
 * @method ExtendedPromiseInterface blpop(...$keys, $timeout) Remove and get the first element in a list, or block until one is available. <https://redis.io/commands/blpop>
 * @method ExtendedPromiseInterface brpop(...$keys, $timeout) Remove and get the last element in a list, or block until one is available. <https://redis.io/commands/brpop>
 * @method ExtendedPromiseInterface brpoplpush($source, $destination, $timeout) Pop a value from a list, push it to another list and return it; or block until one is available. <https://redis.io/commands/brpoplpush>
 * @method ExtendedPromiseInterface clientKill(...$filters) Kill the connection of a client. <https://redis.io/commands/client-kill>
 * @method ExtendedPromiseInterface clientList() Get the list of client connections. <https://redis.io/commands/client-list>
 * @method ExtendedPromiseInterface clientGetname() Get the current connection name. <https://redis.io/commands/client-getname>
 * @method ExtendedPromiseInterface clientPause($timeout) Stop processing commands from clients for some time. <https://redis.io/commands/client-pause>
 * @method ExtendedPromiseInterface clientReply($option) Instruct the server whether to reply to commands. <https://redis.io/commands/client-reply>
 * @method ExtendedPromiseInterface clientSetname($connectionName) Set the current connection name. <https://redis.io/commands/client-setname>
 * @method ExtendedPromiseInterface clusterAddslots(...$slots) Assign new hash slots to receiving node. <https://redis.io/commands/cluster-addslots>
 * @method ExtendedPromiseInterface clusterCountkeysinslot($slot) Return the number of local keys in the specified hash slot. <https://redis.io/commands/cluster-countkeysinslot>
 * @method ExtendedPromiseInterface clusterDelslots(...$slots) Set hash slots as unbound in receiving node. <https://redis.io/commands/cluster-delslots>
 * @method ExtendedPromiseInterface clusterFailover($option = null) Forces a slave to perform a manual failover of its master.. <https://redis.io/commands/cluster-failover>
 * @method ExtendedPromiseInterface clusterForget($nodeId) Remove a node from the nodes table. <https://redis.io/commands/cluster-forget>
 * @method ExtendedPromiseInterface clusterGetkeysinslot($slot, $count) Return local key names in the specified hash slot. <https://redis.io/commands/cluster-getkeysinslot>
 * @method ExtendedPromiseInterface clusterInfo() Provides info about Redis Cluster node state. <https://redis.io/commands/cluster-info>
 * @method ExtendedPromiseInterface clusterKeyslot($key) Returns the hash slot of the specified key. <https://redis.io/commands/cluster-keyslot>
 * @method ExtendedPromiseInterface clusterMeet($ip, $port) Force a node cluster to handshake with another node. <https://redis.io/commands/cluster-meet>
 * @method ExtendedPromiseInterface clusterNodes() Get Cluster config for the node. <https://redis.io/commands/cluster-nodes>
 * @method ExtendedPromiseInterface clusterReplicate($nodeId) Reconfigure a node as a slave of the specified master node. <https://redis.io/commands/cluster-replicate>
 * @method ExtendedPromiseInterface clusterReset($resetType = "SOFT") Reset a Redis Cluster node. <https://redis.io/commands/cluster-reset>
 * @method ExtendedPromiseInterface clusterSaveconfig() Forces the node to save cluster state on disk. <https://redis.io/commands/cluster-saveconfig>
 * @method ExtendedPromiseInterface clusterSetslot($slot, $type, $nodeid = null) Bind a hash slot to a specific node. <https://redis.io/commands/cluster-setslot>
 * @method ExtendedPromiseInterface clusterSlaves($nodeId) List slave nodes of the specified master node. <https://redis.io/commands/cluster-slaves>
 * @method ExtendedPromiseInterface clusterSlots() Get array of Cluster slot to node mappings. <https://redis.io/commands/cluster-slots>
 * @method ExtendedPromiseInterface command() Get array of Redis command details. <https://redis.io/commands/command>
 * @method ExtendedPromiseInterface commandCount() Get total number of Redis commands. <https://redis.io/commands/command-count>
 * @method ExtendedPromiseInterface commandGetkeys() Extract keys given a full Redis command. <https://redis.io/commands/command-getkeys>
 * @method ExtendedPromiseInterface commandInfo(...$commandNames) Get array of specific Redis command details. <https://redis.io/commands/command-info>
 * @method ExtendedPromiseInterface configGet($parameter) Get the value of a configuration parameter. <https://redis.io/commands/config-get>
 * @method ExtendedPromiseInterface configRewrite() Rewrite the configuration file with the in memory configuration. <https://redis.io/commands/config-rewrite>
 * @method ExtendedPromiseInterface configSet($parameter, $value) Set a configuration parameter to the given value. <https://redis.io/commands/config-set>
 * @method ExtendedPromiseInterface configResetstat() Reset the stats returned by INFO. <https://redis.io/commands/config-resetstat>
 * @method ExtendedPromiseInterface dbsize() Return the number of keys in the selected database. <https://redis.io/commands/dbsize>
 * @method ExtendedPromiseInterface debugObject($key) Get debugging information about a key. <https://redis.io/commands/debug-object>
 * @method ExtendedPromiseInterface debugSegfault() Make the server crash. <https://redis.io/commands/debug-segfault>
 * @method ExtendedPromiseInterface decr($key) Decrement the integer value of a key by one. <https://redis.io/commands/decr>
 * @method ExtendedPromiseInterface decrby($key, $decrement) Decrement the integer value of a key by the given number. <https://redis.io/commands/decrby>
 * @method ExtendedPromiseInterface del(...$keys) Delete a key. <https://redis.io/commands/del>
 * @method ExtendedPromiseInterface discard() Discard all commands issued after MULTI. <https://redis.io/commands/discard>
 * @method ExtendedPromiseInterface dump($key) Return a serialized version of the value stored at the specified key.. <https://redis.io/commands/dump>
 * @method ExtendedPromiseInterface echo($message) Echo the given string. <https://redis.io/commands/echo>
 * @method ExtendedPromiseInterface eval($script, $numkeys, ...$keys, ...$args) Execute a Lua script server side. <https://redis.io/commands/eval>
 * @method ExtendedPromiseInterface evalsha($sha1, $numkeys, ...$keys, ...$args) Execute a Lua script server side. <https://redis.io/commands/evalsha>
 * @method ExtendedPromiseInterface exec() Execute all commands issued after MULTI. <https://redis.io/commands/exec>
 * @method ExtendedPromiseInterface exists(...$keys) Determine if a key exists. <https://redis.io/commands/exists>
 * @method ExtendedPromiseInterface expire($key, $seconds) Set a key's time to live in seconds. <https://redis.io/commands/expire>
 * @method ExtendedPromiseInterface expireat($key, $timestamp) Set the expiration for a key as a UNIX timestamp. <https://redis.io/commands/expireat>
 * @method ExtendedPromiseInterface flushall($ASYNC = null) Remove all keys from all databases. <https://redis.io/commands/flushall>
 * @method ExtendedPromiseInterface flushdb($ASYNC = null) Remove all keys from the current database. <https://redis.io/commands/flushdb>
 * @method ExtendedPromiseInterface geoadd($key, $longitude, $latitude, $member, ...$more) Add one or more geospatial items in the geospatial index represented using a sorted set. <https://redis.io/commands/geoadd>
 * @method ExtendedPromiseInterface geohash($key, ...$members) Returns members of a geospatial index as standard geohash strings. <https://redis.io/commands/geohash>
 * @method ExtendedPromiseInterface geopos($key, ...$members) Returns longitude and latitude of members of a geospatial index. <https://redis.io/commands/geopos>
 * @method ExtendedPromiseInterface geodist($key, $member1, $member2, $unit = null) Returns the distance between two members of a geospatial index. <https://redis.io/commands/geodist>
 * @method ExtendedPromiseInterface georadius($key, $longitude, $latitude, $radius, $metric, ...$options) Query a sorted set representing a geospatial index to fetch members matching a given maximum distance from a point. <https://redis.io/commands/georadius>
 * @method ExtendedPromiseInterface georadiusbymember($key, $member, $radius, $metric, ...$options) Query a sorted set representing a geospatial index to fetch members matching a given maximum distance from a member. <https://redis.io/commands/georadiusbymember>
 * @method ExtendedPromiseInterface get($key) Get the value of a key. <https://redis.io/commands/get>
 * @method ExtendedPromiseInterface getbit($key, $offset) Returns the bit value at offset in the string value stored at key. <https://redis.io/commands/getbit>
 * @method ExtendedPromiseInterface getrange($key, $start, $end) Get a substring of the string stored at a key. <https://redis.io/commands/getrange>
 * @method ExtendedPromiseInterface getset($key, $value) Set the string value of a key and return its old value. <https://redis.io/commands/getset>
 * @method ExtendedPromiseInterface hdel($key, ...$fields) Delete one or more hash fields. <https://redis.io/commands/hdel>
 * @method ExtendedPromiseInterface hexists($key, $field) Determine if a hash field exists. <https://redis.io/commands/hexists>
 * @method ExtendedPromiseInterface hget($key, $field) Get the value of a hash field. <https://redis.io/commands/hget>
 * @method ExtendedPromiseInterface hgetall($key) Get all the fields and values in a hash. <https://redis.io/commands/hgetall>
 * @method ExtendedPromiseInterface hincrby($key, $field, $increment) Increment the integer value of a hash field by the given number. <https://redis.io/commands/hincrby>
 * @method ExtendedPromiseInterface hincrbyfloat($key, $field, $increment) Increment the float value of a hash field by the given amount. <https://redis.io/commands/hincrbyfloat>
 * @method ExtendedPromiseInterface hkeys($key) Get all the fields in a hash. <https://redis.io/commands/hkeys>
 * @method ExtendedPromiseInterface hlen($key) Get the number of fields in a hash. <https://redis.io/commands/hlen>
 * @method ExtendedPromiseInterface hmget($key, ...$fields) Get the values of all the given hash fields. <https://redis.io/commands/hmget>
 * @method ExtendedPromiseInterface hmset($key, $field, $value, ...$more) Set multiple hash fields to multiple values. <https://redis.io/commands/hmset>
 * @method ExtendedPromiseInterface hset($key, $field, $value) Set the string value of a hash field. <https://redis.io/commands/hset>
 * @method ExtendedPromiseInterface hsetnx($key, $field, $value) Set the value of a hash field, only if the field does not exist. <https://redis.io/commands/hsetnx>
 * @method ExtendedPromiseInterface hstrlen($key, $field) Get the length of the value of a hash field. <https://redis.io/commands/hstrlen>
 * @method ExtendedPromiseInterface hvals($key) Get all the values in a hash. <https://redis.io/commands/hvals>
 * @method ExtendedPromiseInterface incr($key) Increment the integer value of a key by one. <https://redis.io/commands/incr>
 * @method ExtendedPromiseInterface incrby($key, $increment) Increment the integer value of a key by the given amount. <https://redis.io/commands/incrby>
 * @method ExtendedPromiseInterface incrbyfloat($key, $increment) Increment the float value of a key by the given amount. <https://redis.io/commands/incrbyfloat>
 * @method ExtendedPromiseInterface info($section = null) Get information and statistics about the server. <https://redis.io/commands/info>
 * @method ExtendedPromiseInterface keys($pattern) Find all keys matching the given pattern. <https://redis.io/commands/keys>
 * @method ExtendedPromiseInterface lastsave() Get the UNIX time stamp of the last successful save to disk. <https://redis.io/commands/lastsave>
 * @method ExtendedPromiseInterface lindex($key, $index) Get an element from a list by its index. <https://redis.io/commands/lindex>
 * @method ExtendedPromiseInterface linsert($key, $where, $pivot, $value) Insert an element before or after another element in a list. <https://redis.io/commands/linsert>
 * @method ExtendedPromiseInterface llen($key) Get the length of a list. <https://redis.io/commands/llen>
 * @method ExtendedPromiseInterface lpop($key) Remove and get the first element in a list. <https://redis.io/commands/lpop>
 * @method ExtendedPromiseInterface lpush($key, ...$values) Prepend one or multiple values to a list. <https://redis.io/commands/lpush>
 * @method ExtendedPromiseInterface lpushx($key, $value) Prepend a value to a list, only if the list exists. <https://redis.io/commands/lpushx>
 * @method ExtendedPromiseInterface lrange($key, $start, $stop) Get a range of elements from a list. <https://redis.io/commands/lrange>
 * @method ExtendedPromiseInterface lrem($key, $count, $value) Remove elements from a list. <https://redis.io/commands/lrem>
 * @method ExtendedPromiseInterface lset($key, $index, $value) Set the value of an element in a list by its index. <https://redis.io/commands/lset>
 * @method ExtendedPromiseInterface ltrim($key, $start, $stop) Trim a list to the specified range. <https://redis.io/commands/ltrim>
 * @method ExtendedPromiseInterface mget(...$keys) Get the values of all the given keys. <https://redis.io/commands/mget>
 * @method ExtendedPromiseInterface migrate($host, $port, $key, $destinationDb, $timeout, ...$options) Atomically transfer a key from a Redis instance to another one.. <https://redis.io/commands/migrate>
 * @method ExtendedPromiseInterface monitor() Listen for all requests received by the server in real time. <https://redis.io/commands/monitor>
 * @method ExtendedPromiseInterface move($key, $db) Move a key to another database. <https://redis.io/commands/move>
 * @method ExtendedPromiseInterface mset(...$keyValuePairs) Set multiple keys to multiple values. <https://redis.io/commands/mset>
 * @method ExtendedPromiseInterface msetnx(...$keyValuePairs) Set multiple keys to multiple values, only if none of the keys exist. <https://redis.io/commands/msetnx>
 * @method ExtendedPromiseInterface multi() Mark the start of a transaction block. <https://redis.io/commands/multi>
 * @method ExtendedPromiseInterface object($subcommand, ...$argumentss) Inspect the internals of Redis objects. <https://redis.io/commands/object>
 * @method ExtendedPromiseInterface persist($key) Remove the expiration from a key. <https://redis.io/commands/persist>
 * @method ExtendedPromiseInterface pexpire($key, $milliseconds) Set a key's time to live in milliseconds. <https://redis.io/commands/pexpire>
 * @method ExtendedPromiseInterface pexpireat($key, $millisecondsTimestamp) Set the expiration for a key as a UNIX timestamp specified in milliseconds. <https://redis.io/commands/pexpireat>
 * @method ExtendedPromiseInterface pfadd($key, ...$elements) Adds the specified elements to the specified HyperLogLog.. <https://redis.io/commands/pfadd>
 * @method ExtendedPromiseInterface pfcount(...$keys) Return the approximated cardinality of the set(s) observed by the HyperLogLog at key(s).. <https://redis.io/commands/pfcount>
 * @method ExtendedPromiseInterface pfmerge($destkey, ...$sourcekeys) Merge N different HyperLogLogs into a single one.. <https://redis.io/commands/pfmerge>
 * @method ExtendedPromiseInterface ping($message = null) Ping the server. <https://redis.io/commands/ping>
 * @method ExtendedPromiseInterface psetex($key, $milliseconds, $value) Set the value and expiration in milliseconds of a key. <https://redis.io/commands/psetex>
 * @method ExtendedPromiseInterface psubscribe(...$patterns) Listen for messages published to channels matching the given patterns. <https://redis.io/commands/psubscribe>
 * @method ExtendedPromiseInterface pubsub($subcommand, ...$arguments) Inspect the state of the Pub/Sub subsystem. <https://redis.io/commands/pubsub>
 * @method ExtendedPromiseInterface pttl($key) Get the time to live for a key in milliseconds. <https://redis.io/commands/pttl>
 * @method ExtendedPromiseInterface publish($channel, $message) Post a message to a channel. <https://redis.io/commands/publish>
 * @method ExtendedPromiseInterface punsubscribe(...$patterns) Stop listening for messages posted to channels matching the given patterns. <https://redis.io/commands/punsubscribe>
 * @method ExtendedPromiseInterface quit() Close the connection. <https://redis.io/commands/quit>
 * @method ExtendedPromiseInterface randomkey() Return a random key from the keyspace. <https://redis.io/commands/randomkey>
 * @method ExtendedPromiseInterface readonly() Enables read queries for a connection to a cluster slave node. <https://redis.io/commands/readonly>
 * @method ExtendedPromiseInterface readwrite() Disables read queries for a connection to a cluster slave node. <https://redis.io/commands/readwrite>
 * @method ExtendedPromiseInterface rename($key, $newkey) Rename a key. <https://redis.io/commands/rename>
 * @method ExtendedPromiseInterface renamenx($key, $newkey) Rename a key, only if the new key does not exist. <https://redis.io/commands/renamenx>
 * @method ExtendedPromiseInterface restore($key, $ttl, $serializedValue, $REPLACE = null) Create a key using the provided serialized value, previously obtained using DUMP.. <https://redis.io/commands/restore>
 * @method ExtendedPromiseInterface role() Return the role of the instance in the context of replication. <https://redis.io/commands/role>
 * @method ExtendedPromiseInterface rpop($key) Remove and get the last element in a list. <https://redis.io/commands/rpop>
 * @method ExtendedPromiseInterface rpoplpush($source, $destination) Remove the last element in a list, prepend it to another list and return it. <https://redis.io/commands/rpoplpush>
 * @method ExtendedPromiseInterface rpush($key, ...$values) Append one or multiple values to a list. <https://redis.io/commands/rpush>
 * @method ExtendedPromiseInterface rpushx($key, $value) Append a value to a list, only if the list exists. <https://redis.io/commands/rpushx>
 * @method ExtendedPromiseInterface sadd($key, ...$members) Add one or more members to a set. <https://redis.io/commands/sadd>
 * @method ExtendedPromiseInterface save() Synchronously save the dataset to disk. <https://redis.io/commands/save>
 * @method ExtendedPromiseInterface scard($key) Get the number of members in a set. <https://redis.io/commands/scard>
 * @method ExtendedPromiseInterface scriptDebug($option) Set the debug mode for executed scripts.. <https://redis.io/commands/script-debug>
 * @method ExtendedPromiseInterface scriptExists(...$sha1s) Check existence of scripts in the script cache.. <https://redis.io/commands/script-exists>
 * @method ExtendedPromiseInterface scriptFlush() Remove all the scripts from the script cache.. <https://redis.io/commands/script-flush>
 * @method ExtendedPromiseInterface scriptKill() Kill the script currently in execution.. <https://redis.io/commands/script-kill>
 * @method ExtendedPromiseInterface scriptLoad($script) Load the specified Lua script into the script cache.. <https://redis.io/commands/script-load>
 * @method ExtendedPromiseInterface sdiff(...$keys) Subtract multiple sets. <https://redis.io/commands/sdiff>
 * @method ExtendedPromiseInterface sdiffstore($destination, ...$keys) Subtract multiple sets and store the resulting set in a key. <https://redis.io/commands/sdiffstore>
 * @method ExtendedPromiseInterface select($index) Change the selected database for the current connection. <https://redis.io/commands/select>
 * @method ExtendedPromiseInterface setbit($key, $offset, $value) Sets or clears the bit at offset in the string value stored at key. <https://redis.io/commands/setbit>
 * @method ExtendedPromiseInterface setex($key, $seconds, $value) Set the value and expiration of a key. <https://redis.io/commands/setex>
 * @method ExtendedPromiseInterface setnx($key, $value) Set the value of a key, only if the key does not exist. <https://redis.io/commands/setnx>
 * @method ExtendedPromiseInterface setrange($key, $offset, $value) Overwrite part of a string at key starting at the specified offset. <https://redis.io/commands/setrange>
 * @method ExtendedPromiseInterface shutdown($saveOption = null) Synchronously save the dataset to disk and then shut down the server. <https://redis.io/commands/shutdown>
 * @method ExtendedPromiseInterface sinter(...$keys) Intersect multiple sets. <https://redis.io/commands/sinter>
 * @method ExtendedPromiseInterface sinterstore($destination, ...$keys) Intersect multiple sets and store the resulting set in a key. <https://redis.io/commands/sinterstore>
 * @method ExtendedPromiseInterface sismember($key, $member) Determine if a given value is a member of a set. <https://redis.io/commands/sismember>
 * @method ExtendedPromiseInterface slaveof($host, $port) Make the server a slave of another instance, or promote it as master. <https://redis.io/commands/slaveof>
 * @method ExtendedPromiseInterface slowlog($subcommand, $argument = null) Manages the Redis slow queries log. <https://redis.io/commands/slowlog>
 * @method ExtendedPromiseInterface smembers($key) Get all the members in a set. <https://redis.io/commands/smembers>
 * @method ExtendedPromiseInterface smove($source, $destination, $member) Move a member from one set to another. <https://redis.io/commands/smove>
 * @method ExtendedPromiseInterface sort($key, ...$options) Sort the elements in a list, set or sorted set. <https://redis.io/commands/sort>
 * @method ExtendedPromiseInterface spop($key, $count = null) Remove and return one or multiple random members from a set. <https://redis.io/commands/spop>
 * @method ExtendedPromiseInterface srandmember($key, $count = null) Get one or multiple random members from a set. <https://redis.io/commands/srandmember>
 * @method ExtendedPromiseInterface srem($key, ...$members) Remove one or more members from a set. <https://redis.io/commands/srem>
 * @method ExtendedPromiseInterface strlen($key) Get the length of the value stored in a key. <https://redis.io/commands/strlen>
 * @method ExtendedPromiseInterface subscribe(...$channels) Listen for messages published to the given channels. <https://redis.io/commands/subscribe>
 * @method ExtendedPromiseInterface sunion(...$keys) Add multiple sets. <https://redis.io/commands/sunion>
 * @method ExtendedPromiseInterface sunionstore($destination, ...$keys) Add multiple sets and store the resulting set in a key. <https://redis.io/commands/sunionstore>
 * @method ExtendedPromiseInterface swapdb($index, $index) Swaps two Redis databases. <https://redis.io/commands/swapdb>
 * @method ExtendedPromiseInterface sync() Internal command used for replication. <https://redis.io/commands/sync>
 * @method ExtendedPromiseInterface time() Return the current server time. <https://redis.io/commands/time>
 * @method ExtendedPromiseInterface touch(...$keys) Alters the last access time of a key(s). Returns the number of existing keys specified.. <https://redis.io/commands/touch>
 * @method ExtendedPromiseInterface ttl($key) Get the time to live for a key. <https://redis.io/commands/ttl>
 * @method ExtendedPromiseInterface type($key) Determine the type stored at key. <https://redis.io/commands/type>
 * @method ExtendedPromiseInterface unsubscribe(...$channels) Stop listening for messages posted to the given channels. <https://redis.io/commands/unsubscribe>
 * @method ExtendedPromiseInterface unlink(...$keys) Delete a key asynchronously in another thread. Otherwise it is just as DEL, but non blocking.. <https://redis.io/commands/unlink>
 * @method ExtendedPromiseInterface unwatch() Forget about all watched keys. <https://redis.io/commands/unwatch>
 * @method ExtendedPromiseInterface wait($numslaves, $timeout) Wait for the synchronous replication of all the write commands sent in the context of the current connection. <https://redis.io/commands/wait>
 * @method ExtendedPromiseInterface watch(...$keys) Watch the given keys to determine execution of the MULTI/EXEC block. <https://redis.io/commands/watch>
 * @method ExtendedPromiseInterface zadd($key, ...$options) Add one or more members to a sorted set, or update its score if it already exists. <https://redis.io/commands/zadd>
 * @method ExtendedPromiseInterface zcard($key) Get the number of members in a sorted set. <https://redis.io/commands/zcard>
 * @method ExtendedPromiseInterface zcount($key, $min, $max) Count the members in a sorted set with scores within the given values. <https://redis.io/commands/zcount>
 * @method ExtendedPromiseInterface zincrby($key, $increment, $member) Increment the score of a member in a sorted set. <https://redis.io/commands/zincrby>
 * @method ExtendedPromiseInterface zinterstore($destination, $numkeys, $key, ...$options) Intersect multiple sorted sets and store the resulting sorted set in a new key. <https://redis.io/commands/zinterstore>
 * @method ExtendedPromiseInterface zlexcount($key, $min, $max) Count the number of members in a sorted set between a given lexicographical range. <https://redis.io/commands/zlexcount>
 * @method ExtendedPromiseInterface zrange($key, $start, $stop, $WITHSCORES = null) Return a range of members in a sorted set, by index. <https://redis.io/commands/zrange>
 * @method ExtendedPromiseInterface zrangebylex($key, $min, $max, $LIMIT = null, $offset = null, $count = null) Return a range of members in a sorted set, by lexicographical range. <https://redis.io/commands/zrangebylex>
 * @method ExtendedPromiseInterface zrevrangebylex($key, $max, $min, $LIMIT = null, $offset = null, $count = null) Return a range of members in a sorted set, by lexicographical range, ordered from higher to lower strings.. <https://redis.io/commands/zrevrangebylex>
 * @method ExtendedPromiseInterface zrangebyscore($key, $min, $max, $WITHSCORES = null, $LIMIT = null, $offset = null, $count = null) Return a range of members in a sorted set, by score. <https://redis.io/commands/zrangebyscore>
 * @method ExtendedPromiseInterface zrank($key, $member) Determine the index of a member in a sorted set. <https://redis.io/commands/zrank>
 * @method ExtendedPromiseInterface zrem($key, ...$members) Remove one or more members from a sorted set. <https://redis.io/commands/zrem>
 * @method ExtendedPromiseInterface zremrangebylex($key, $min, $max) Remove all members in a sorted set between the given lexicographical range. <https://redis.io/commands/zremrangebylex>
 * @method ExtendedPromiseInterface zremrangebyrank($key, $start, $stop) Remove all members in a sorted set within the given indexes. <https://redis.io/commands/zremrangebyrank>
 * @method ExtendedPromiseInterface zremrangebyscore($key, $min, $max) Remove all members in a sorted set within the given scores. <https://redis.io/commands/zremrangebyscore>
 * @method ExtendedPromiseInterface zrevrange($key, $start, $stop, $WITHSCORES = null) Return a range of members in a sorted set, by index, with scores ordered from high to low. <https://redis.io/commands/zrevrange>
 * @method ExtendedPromiseInterface zrevrangebyscore($key, $max, $min, $WITHSCORES = null, $LIMIT = null, $offset = null, $count = null) Return a range of members in a sorted set, by score, with scores ordered from high to low. <https://redis.io/commands/zrevrangebyscore>
 * @method ExtendedPromiseInterface zrevrank($key, $member) Determine the index of a member in a sorted set, with scores ordered from high to low. <https://redis.io/commands/zrevrank>
 * @method ExtendedPromiseInterface zscore($key, $member) Get the score associated with the given member in a sorted set. <https://redis.io/commands/zscore>
 * @method ExtendedPromiseInterface zunionstore($destination, $numkeys, $key, ...$options) Add multiple sorted sets and store the resulting sorted set in a new key. <https://redis.io/commands/zunionstore>
 * @method ExtendedPromiseInterface scan($cursor, $MATCH = null, $pattern = null, $COUNT = null, $count = null) Incrementally iterate the keys space. <https://redis.io/commands/scan>
 * @method ExtendedPromiseInterface sscan($key, $cursor, $MATCH = null, $pattern = null, $COUNT = null, $count = null) Incrementally iterate Set elements. <https://redis.io/commands/sscan>
 * @method ExtendedPromiseInterface hscan($key, $cursor, $MATCH = null, $pattern = null, $COUNT = null, $count = null) Incrementally iterate hash fields and associated values. <https://redis.io/commands/hscan>
 * @method ExtendedPromiseInterface zscan($key, $cursor, $MATCH = null, $pattern = null, $COUNT = null, $count = null) Incrementally iterate sorted sets elements and associated scores. <https://redis.io/commands/zscan>
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
     * @return ExtendedPromiseInterface
     */
    public function set($key, $value, $ex = null)
    {
        $command = isset($ex) ? 'setex' : 'set';
        $arguments = isset($ex) ? [$key, $ex, $value] : [$key, $value];
        return $this->executeCommand($command, $arguments);
    }
}