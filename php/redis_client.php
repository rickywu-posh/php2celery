<?php

/* 
 * 来源: https://github.com/jamm/Memory/blob/master/lib/Jamm/Memory/IRedisServer.php
 */


interface IRedisClient
{
	const Position_BEFORE = 'BEFORE';
	const Position_AFTER  = 'AFTER';
	const WITHSCORES      = 'WITHSCORES';
	const Aggregate_SUM   = 'SUM';
	const Aggregate_MIN   = 'MIN';
	const Aggregate_MAX   = 'MAX';

	/**
	 * Append a value to a key
	 * @param string $key
	 * @param string $value
	 * @return int
	 */
	public function Append($key, $value);

	/**
	 * Request for authentication in a password protected Redis server.
	 * @param string $password
	 * @return boolean
	 */
	public function Auth($password);

	/** Rewrites the append-only file to reflect the current dataset in memory. */
	public function bgRewriteAOF();

	/** Asynchronously save the dataset to disk */
	public function bgSave();

	/**
	 * Remove and get the first element in a list, or block until one is available
	 * Parameters format:
	 *  key1,key2,key3,...,keyN,timeout
	 * or
	 *  array(key1,key2,keyN), timeout
	 * @param string|array $key
	 * @param int $timeout - time of waiting
	 */
	public function BLPop($key, $timeout);

	/**
	 * Remove and get the last element in a list, or block until one is available
	 * Parameters format:
	 *  key1,key2,key3,...,keyN,timeout
	 * or
	 *  array(key1,key2,keyN), timeout
	 * @param string|array $key
	 * @param int $timeout - time of waiting
	 */
	public function BRPop($key, $timeout);

	/**
	 * Pop a value from a list, push it to another list and return it; or block until one is available
	 * @param $source
	 * @param $destination
	 * @param $timeout
	 * @return string|boolean
	 */
	public function BRPopLPush($source, $destination, $timeout);

	/**
	 * Get the value of a configuration parameter
	 * @param string $parameter
	 * @return string
	 */
	public function Config_Get($parameter);

	/**
	 * Set the value of a configuration parameter
	 * @param $parameter
	 * @param $value
	 * @return boolean
	 */
	public function Config_Set($parameter, $value);

	/**
	 * Resets the statistics reported by Redis using the INFO command.
	 * These are the counters that are reset:
	 * Keyspace hits
	 * Keyspace misses
	 * Number of commands processed
	 * Number of connections received
	 * Number of expired keys
	 */
	public function Config_ResetStat();

	/**
	 * Return the number of keys in the selected database
	 * @return int
	 */
	public function DBsize();

	/**
	 * Decrement the integer value of a key by one
	 * @param string $key
	 * @return int
	 */
	public function Decr($key);

	/**
	 * Decrement the integer value of a key by the given number
	 * @param string $key
	 * @param int $decrement
	 * @return int
	 */
	public function DecrBy($key, $decrement);

	/**
	 * Delete a key
	 * Parameters: $key1, $key2, ...
	 * or: array($key1, $key2, ...)
	 * @param string $key
	 * @return int
	 */
	public function Del($key);

	/**
	 * Determine if a key exists
	 * @param string $key
	 * @return int
	 */
	public function Exists($key);

	/**
	 * Set the expiration for a key as a UNIX timestamp
	 * @param string $key
	 * @param int $timestamp
	 * @return int
	 */
	public function Expireat($key, $timestamp);

	/** Remove all keys from all databases */
	public function FlushAll();

	/** Remove all keys from the current database */
	public function FlushDB();

	/**
	 * Get the value of a key
	 * @param string $key
	 * @return string
	 */
	public function Get($key);

	/**
	 * Returns the bit value at offset in the string value stored at key
	 * @param string $key
	 * @param int $offset
	 */
	public function GetBit($key, $offset);

	/**
	 * Get a substring of the string stored at a key
	 * @param string $key
	 * @param int $start
	 * @param int $end
	 * @return string
	 */
	public function GetRange($key, $start, $end);

	/**
	 * Atomically sets key to value and returns the old value stored at key.
	 * Returns an error when key exists but does not hold a string value.
	 * Usage:
	 * From time to time we need to get the value of the counter and reset it to zero atomically.
	 * This can be done using GETSET mycounter "0".
	 * @param string $key
	 * @param string $value
	 * @return string
	 */
	public function GetSet($key, $value);

	/**
	 * Removes the specified fields from the hash stored at key.
	 * Non-existing fields are ignored. Non-existing keys are treated as empty hashes and this command returns 0.
	 * Parameters: ($key, $field1, $field2...)
	 * or: ($key, array($field1,$field2...))
	 * @param string $key
	 * @param array|string $field
	 * @return int
	 */
	public function hDel($key, $field);

	/**
	 * Determine if a hash field exists
	 * @param string $key
	 * @param string $field
	 * @return int
	 */
	public function hExists($key, $field);

	/**
	 * Get the value of a hash field
	 * @param string $key
	 * @param string $field
	 * @return string|int
	 */
	public function hGet($key, $field);

	/**
	 * Get all the fields and values in a hash
	 * @param string $key
	 * @return array
	 */
	public function hGetAll($key);

	/**
	 * Increments the number stored at field in the hash stored at key by increment.
	 * If key does not exist, a new key holding a hash is created.
	 * If field does not exist or holds a string that cannot be interpreted as integer, the value is set to 0 before the operation is performed.
	 * Returns the value at field after the increment operation.
	 * @param string $key
	 * @param string $field
	 * @param int $increment
	 * @return int
	 */
	public function hIncrBy($key, $field, $increment);

	/**
	 * Get all the fields in a hash
	 * @param string $key name of hash
	 * @return array
	 */
	public function hKeys($key);

	/**
	 * Get the number of fields in a hash
	 * @param string $key
	 * @return int
	 */
	public function hLen($key);

	/**
	 * Returns the values associated with the specified fields in the hash stored at key.
	 * For every field that does not exist in the hash, a nil value is returned.
	 * @param string $key
	 * @param array $fields
	 * @return array
	 */
	public function hMGet($key, array $fields);

	/**
	 * Set multiple hash fields to multiple values
	 * @param string $key
	 * @param array $fields (field => value)
	 */
	public function hMSet($key, $fields);

	/**
	 * Set the string value of a hash field
	 * @param string $key hash
	 * @param string $field
	 * @param string $value
	 * @return int
	 */
	public function hSet($key, $field, $value);

	/**
	 * Set the value of a hash field, only if the field does not exist
	 * @param string $key
	 * @param string $field
	 * @param string $value
	 * @return int
	 */
	public function hSetNX($key, $field, $value);

	/**
	 * Get all the values in a hash
	 * @param string $key
	 * @return array
	 */
	public function hVals($key);

	/**
	 * Increment the integer value of a key by one
	 * @param string $key
	 * @return int
	 */
	public function Incr($key);

	/**
	 * Returns the element at index $index in the list stored at $key.
	 * The index is zero-based, so 0 means the first element, 1 the second element and so on.
	 * Negative indices can be used to designate elements starting at the tail of the list.
	 * Here, -1 means the last element, -2 means the penultimate and so forth.
	 * When the value at key is not a list, an error is returned.
	 * @param string $key
	 * @param int $index
	 * @return string|boolean
	 */
	public function LIndex($key, $index);

	/**
	 * Insert an element before or after another element in a list
	 * @param string $key
	 * @param bool $after
	 * @param string $pivot
	 * @param string $value
	 * @return int
	 */
	public function LInsert($key, $after = true, $pivot, $value);

	/**
	 * Get the length of a list
	 * @param string $key
	 * @return int
	 */
	public function LLen($key);

	/**
	 * Remove and get the first element in a list
	 * @param string $key
	 * @return string|boolean
	 */
	public function LPop($key);

	/**
	 * Inserts value at the head of the list stored at key.
	 * If key does not exist, it is created as empty list before performing the push operation.
	 * When key holds a value that is not a list, an error is returned.
	 * @param string $key
	 * @param string|array $value
	 * @usage
	 * LPush(key, value)
	 * LPush(key, value1, value2)
	 * LPush(key, array(value1, value2))
	 * @return int
	 */
	public function LPush($key, $value);

	/**
	 * Inserts value at the head of the list stored at key, only if key already exists and holds a list.
	 * In contrary to LPush, no operation will be performed when key does not yet exist.
	 * @param string $key
	 * @param string $value
	 * @return int
	 */
	public function LPushX($key, $value);

	/**
	 * Returns the specified elements of the list stored at key.
	 * The offsets $start and $stop are zero-based indexes, with 0 being the first element of the list (the head of the list),
	 * 1 being the next element and so on.
	 * These offsets can also be negative numbers indicating offsets starting at the end of the list.
	 * For example, -1 is the last element of the list, -2 the penultimate, and so on.
	 * @param string $key
	 * @param int $start
	 * @param int $stop
	 * @return array
	 */
	public function LRange($key, $start, $stop);

	/**
	 * Removes the first count occurrences of elements equal to value from the list stored at key.
	 * The count argument influences the operation in the following ways:
	 *  count > 0: Remove elements equal to value moving from head to tail.
	 *  count < 0: Remove elements equal to value moving from tail to head.
	 *  count = 0: Remove all elements equal to value.
	 * For example, LREM list -2 "hello" will remove the last two occurrences of "hello" in the list stored at list.
	 * @param string $key
	 * @param int $count
	 * @param string $value
	 * @return int
	 */
	public function LRem($key, $count, $value);

	/**
	 * Sets the list element at index to value.
	 * For more information on the index argument, see LINDEX.
	 * An error is returned for out of range indexes.
	 * @param $key
	 * @param $index
	 * @param $value
	 * @return boolean
	 */
	public function LSet($key, $index, $value);

	/**
	 * Trim a list to the specified range
	 * @link http://redis.io/commands/ltrim
	 * @param string $key
	 * @param int $start
	 * @param int $stop
	 * @return boolean
	 */
	public function LTrim($key, $start, $stop);

	/**
	 * Returns the values of all specified keys.
	 * For every key that does not hold a string value or does not exist, the special value nil is returned.
	 * Parameters: $key, [key ...]
	 * or: array($key1, $key2...)
	 * @param string $key
	 * @return array
	 */
	public function MGet($key);

	/**
	 * Move key from the currently selected database (see SELECT) to the specified destination database.
	 * When key already exists in the destination database, or it does not exist in the source database, it does nothing.
	 * It is possible to use MOVE as a locking primitive because of this.
	 * @param string $key
	 * @param int $db
	 * @return int
	 */
	public function Move($key, $db);

	/**
	 * Set multiple keys to multiple values
	 * @param array $keys (key => value)
	 * @return string
	 */
	public function MSet(array $keys);

	/**
	 * Set multiple keys to multiple values, only if none of the keys exist
	 * @param array $keys (key => value)
	 *                    Returns:
	 * 1 if the all the keys were set.
	 * 0 if no key was set (at least one key already existed).
	 * @return int
	 */
	public function MSetNX(array $keys);

	/**
	 * Remove the expiration from a key
	 * @param string $key
	 * @return int
	 */
	public function Persist($key);

	/**
	 * Subscribes the client to the given patterns.
	 * @param string $pattern
	 */
	public function PSubscribe($pattern);

	/**
	 * Post a message to a channel
	 * Returns the number of clients that received the message.
	 * @param string $channel
	 * @param string $message
	 * @return int
	 */
	public function Publish($channel, $message);

	/**
	 * Stop listening for messages posted to channels matching the given patterns
	 * @param array|string|null $pattern
	 * @return int
	 */
	public function PUnsubscribe($pattern = null);

	/** Close the connection */
	public function Quit();

	/**
	 * Renames key to newkey.
	 * It returns an error when the source and destination names are the same, or when key does not exist.
	 * If newkey already exists it is overwritten.
	 * @param string $key
	 * @param string $newkey
	 * @return boolean
	 */
	public function Rename($key, $newkey);

	/**
	 * Rename a key, only if the new key does not exist
	 * @param string $key
	 * @param string $newkey
	 * @return int
	 */
	public function RenameNX($key, $newkey);

	/**
	 * Removes and returns the last element of the list stored at key.
	 * @param string $key
	 * @return string|boolean
	 */
	public function RPop($key);

	/**
	 * Atomically returns and removes the last element (tail) of the list stored at source,
	 * and pushes the element at the first element (head) of the list stored at destination.
	 * If source does not exist, the value nil is returned and no operation is performed.
	 * @param string $source
	 * @param string $destination
	 * @return string
	 */
	public function RPopLPush($source, $destination);

	/**
	 * Inserts value at the tail of the list stored at key.
	 * If key does not exist, it is created as empty list before performing the push operation.
	 * When key holds a value that is not a list, an error is returned.
	 * Parameters: key value [value ...]
	 * or: key, array(value,value,...)
	 * @param string $key
	 * @param string|array $value
	 * @return int|boolean
	 */
	public function RPush($key, $value);

	/**
	 * Append a value to a list, only if the list exists
	 * @param string $key
	 * @param string $value
	 * @return int
	 */
	public function RPushX($key, $value);

	/**
	 * Get the number of members in a set
	 * @param string $key
	 * @return int
	 */
	public function sCard($key);

	/**
	 * Returns the members of the set resulting from the difference between the first set and all the successive sets.
	 * For example:
	 *  key1 = {a,b,c,d}
	 *  key2 = {c}
	 *  key3 = {a,c,e}
	 *  SDIFF key1 key2 key3 = {b,d}
	 * Keys that do not exist are considered to be empty sets.
	 *
	 * Parameters: key1, key2, key3...
	 * @param string|array $key
	 * @return array
	 */
	public function sDiff($key);

	/**
	 * This command is equal to SDIFF, but instead of returning the resulting set, it is stored in destination.
	 * If destination already exists, it is overwritten.
	 * Returns the number of elements in the resulting set.
	 * Parameters: destination, key [key, ...]
	 * or: destination, array(key,key, ...)
	 * @param string $destination
	 * @param string|array $key
	 * @return int
	 */
	public function sDiffStore($destination, $key);

	/**
	 * Select the DB with having the specified zero-based numeric index. New connections always use DB 0.
	 * @param int $index
	 */
	public function Select($index);

	/**
	 * Set key to hold the string value. If key already holds a value, it is overwritten, regardless of its type.
	 * @param string $key
	 * @param string $value
	 * @return string
	 */
	public function Set($key, $value);

	/**
	 * Sets or clears the bit at offset in the string value stored at key
	 * @link http://redis.io/commands/setbit
	 * @param string $key
	 * @param int $offset
	 * @param int $value
	 * Returns the original bit value stored at offset.
	 * @return int
	 */
	public function SetBit($key, $offset, $value);

	/**
	 * Set the value of a key, only if the key does not exist
	 * @param string $key
	 * @param string $value
	 * @return bool
	 */
	public function SetNX($key, $value);

	/**
	 * Set the value and expiration of a key
	 * @param string $key
	 * @param int $seconds
	 * @param string $value
	 * @return boolean
	 */
	public function SetEX($key, $seconds, $value);

	/**
	 * Overwrites part of the string stored at key, starting at the specified offset, for the entire length of value.
	 * If the offset is larger than the current length of the string at key, the string is padded with zero-bytes to make offset fit.
	 * Non-existing keys are considered as empty strings, so this command will make sure it holds a string large enough
	 * to be able to set value at offset.
	 *
	 * Thanks to SETRANGE and the analogous GETRANGE commands, you can use Redis strings as a linear array with O(1) random access.
	 * This is a very fast and efficient storage in many real world use cases.
	 * @link http://redis.io/commands/setrange
	 * @param string $key
	 * @param int $offset
	 * @param string $value
	 * Returns the length of the string after it was modified by the command.
	 * @return int
	 */
	public function SetRange($key, $offset, $value);

	/**
	 * Returns the members of the set resulting from the intersection of all the given sets.
	 * For example:
	 *  key1 = {a,b,c,d}
	 *  key2 = {c}
	 *  key3 = {a,c,e}
	 *  SINTER key1 key2 key3 = {c}
	 * Parameters: key [key ...]
	 * or: array(key, key, ...)
	 * @param string|array $key
	 * @return array
	 */
	public function sInter($key);

	/**
	 * Intersect multiple sets and store the resulting set in a key
	 * This command is equal to SINTER, but instead of returning the resulting set, it is stored in destination.
	 * If destination already exists, it is overwritten.
	 * Parameters: $destination,$key [key ...]
	 * or: $destination, array($key, $key...)
	 * @param string $destination
	 * @param string|array $key
	 * Returns the number of elements in the resulting set.
	 * @return int
	 */
	public function sInterStore($destination, $key);

	/**
	 * Make the server a slave of another instance, or promote it as master
	 * @link http://redis.io/commands/slaveof
	 * @param string $host
	 * @param int $port
	 * @return string
	 */
	public function SlaveOf($host, $port);

	/**
	 * Move member from the set at source to the set at destination.
	 * This operation is atomic.
	 * In every given moment the element will appear to be a member of source or destination for other clients.
	 * If the source set does not exist or does not contain the specified element, no operation is performed and 0 is returned.
	 * Otherwise, the element is removed from the source set and added to the destination set.
	 * When the specified element already exists in the destination set, it is only removed from the source set.
	 * @param string $source
	 * @param string $destination
	 * @param string $member
	 * @return int
	 */
	public function sMove($source, $destination, $member);

	/**
	 * Sort the elements in a list, set or sorted set
	 * @link http://redis.io/commands/sort
	 * @param string $key
	 * @param string $sort_rule [BY pattern] [LIMIT offset count] [GET pattern [GET pattern ...]] [ASC|DESC] [ALPHA] [STORE destination]
	 *                          Returns list of sorted elements.
	 * @return array
	 */
	public function Sort($key, $sort_rule);

	/**
	 * Get the length of the value stored in a key
	 * @param string $key
	 * @return int
	 */
	public function StrLen($key);

	/** Subscribes the client to the specified channels.
	 * Once the client enters the subscribed state it is not supposed to issue any other commands,
	 * except for additional SUBSCRIBE, PSUBSCRIBE, UNSUBSCRIBE and PUNSUBSCRIBE commands.
	 * @param $channel
	 * Parameters: $channel [channel ...]
	 */
	public function Subscribe($channel);

	/**
	 * Returns the members of the set resulting from the union of all the given sets.
	 * For example:
	 *  key1 = {a,b,c,d}
	 *  key2 = {c}
	 *  key3 = {a,c,e}
	 * SUNION key1 key2 key3 = {a,b,c,d,e}
	 * Parameters: key [key...]
	 * @param string|array $key
	 * @return array
	 */
	public function sUnion($key);

	/**
	 * Add multiple sets and store the resulting set in a key
	 * Parameters: $destination, $key [key ...]
	 * @param $destination
	 * @param string|array $key
	 * Returns the number of elements in the resulting set.
	 * @return int
	 */
	public function sUnionStore($destination, $key);

	/**
	 * Set a key's time to live in seconds
	 * @param string $key
	 * @param int $seconds
	 * @return boolean
	 */
	public function Expire($key, $seconds);

	/**
	 * Get the time to live for a key
	 * @param string $key
	 * @return int
	 */
	public function TTL($key);

	/**
	 * Returns the string representation of the type of the value stored at key.
	 * The different types that can be returned are: string, list, set, zset and hash.
	 * @param string $key
	 * Returns type of key, or 'none' when key does not exist.
	 * @return string
	 */
	public function Type($key);

	/**
	 * Unsubscribes the client from the given channels, or from all of them if none is given.
	 * Parameters: [channel [channel ...]]
	 * @param string $channel
	 */
	public function Unsubscribe($channel = '');

	/** Forget about all watched keys */
	public function Unwatch();

	/**
	 * Add a member to a sorted set, or update its score if it already exists
	 * @param string $key
	 * @param int|array $score
	 * @param string $member
	 * Can be used as:
	 * zadd(key, score, member)
	 * zadd(key, score1, member1, score2, member2)
	 * zadd(key, array(score1 => member1, score2 => member2))
	 * @return int
	 */
	public function zAdd($key, $score, $member = NULL);

	/**
	 * Get the number of members in a sorted set
	 * @param string $key
	 * @return int
	 */
	public function zCard($key);

	/**
	 * Returns the number of elements in the sorted set at key with a score between min and max.
	 * The min and max arguments have the same semantic as described for ZRANGEBYSCORE.
	 * @param string $key
	 * @param string|int $min
	 * @param string|int $max
	 * @return int
	 */
	public function zCount($key, $min, $max);

	/**
	 * Increment the score of a member in a sorted set
	 * @param string $key
	 * @param number $increment
	 * @param string $member
	 * @return number
	 */
	public function zIncrBy($key, $increment, $member);

	/**
	 * Intersect multiple sorted sets and store the resulting sorted set in a new key
	 * @link http://redis.io/commands/zinterstore
	 * @param string $destination
	 * @param array $keys
	 * @param array|null $weights
	 * @param string|null $aggregate see Aggregate* constants
	 *                               Returns the number of elements in the resulting sorted set at destination.
	 * @return int
	 */
	public function zInterStore($destination, array $keys, array $weights = null, $aggregate = null);

	/**
	 * @abstract
	 * @param string $key
	 * @param int $start
	 * @param int $stop
	 * @param bool $withscores
	 * @return array
	 */
	public function zRange($key, $start, $stop, $withscores = false);

	/**
	 * Return a range of members in a sorted set, by score
	 * @link http://redis.io/commands/zrangebyscore
	 * @param string $key
	 * @param string|number $min
	 * @param string|number $max
	 * @param bool $withscores
	 * @param array|null $limit
	 * @return array
	 */
	public function zRangeByScore($key, $min, $max, $withscores = false, array $limit = null);

	/**
	 * Returns the rank of member in the sorted set stored at key, with the scores ordered from low to high.
	 * The rank (or index) is 0-based, which means that the member with the lowest score has rank 0.
	 * Use ZREVRANK to get the rank of an element with the scores ordered from high to low.
	 * @param string $key
	 * @param string $member
	 * @return int|boolean
	 */
	public function zRank($key, $member);

	/**
	 * Remove a member from a sorted set
	 * @param string $key
	 * @param string|array $member
	 * @usage
	 * zrem(key, member)
	 * zrem(key, member1, member2)
	 * zrem(key, array(member1, member2))
	 * @return int
	 */
	public function zRem($key, $member);

	/**
	 * Removes all elements in the sorted set stored at key with rank between start and stop.
	 * Both start and stop are 0-based indexes with 0 being the element with the lowest score.
	 * These indexes can be negative numbers, where they indicate offsets starting at the element with the highest score.
	 * For example: -1 is the element with the highest score, -2 the element with the second highest score and so forth.
	 * @param string $key
	 * @param int $start
	 * @param int $stop
	 * Returns the number of elements removed.
	 * @return int
	 */
	public function zRemRangeByRank($key, $start, $stop);

	/**
	 * Remove all members in a sorted set within the given scores
	 * @param string $key
	 * @param string|number $min
	 * @param string|number $max
	 * @return int
	 */
	public function zRemRangeByScore($key, $min, $max);

	/**
	 * Returns the specified range of elements in the sorted set stored at key.
	 * The elements are considered to be ordered from the highest to the lowest score.
	 * Descending lexicographical order is used for elements with equal score.
	 * @param string $key
	 * @param int $start
	 * @param int $stop
	 * @param bool $withscores
	 * @return array
	 */
	public function zRevRange($key, $start, $stop, $withscores = false);

	/**
	 * Returns all the elements in the sorted set at key with a score between max and min
	 * (including elements with score equal to max or min).
	 * In contrary to the default ordering of sorted sets, for this command
	 * the elements are considered to be ordered from high to low scores.
	 * The elements having the same score are returned in reverse lexicographical order.
	 * @param string $key
	 * @param number $max
	 * @param number $min
	 * @param bool $withscores
	 * @param array|null $limit (offset, count)
	 * @return array
	 */
	public function zRevRangeByScore($key, $max, $min, $withscores = false, array $limit = null);

	/**
	 * Returns the rank of member in the sorted set stored at key, with the scores ordered from high to low.
	 * The rank (or index) is 0-based, which means that the member with the highest score has rank 0.
	 * Use ZRANK to get the rank of an element with the scores ordered from low to high.
	 * @param string $key
	 * @param string $member
	 * @return int|boolean
	 */
	public function zRevRank($key, $member);

	/**
	 * Get the score associated with the given member in a sorted set
	 * @param string $key
	 * @param string $member
	 * @return string
	 */
	public function zScore($key, $member);

	/**
	 * Add multiple sorted sets and store the resulting sorted set in a new key
	 * @link http://redis.io/commands/zunionstore
	 * @param string $destination
	 * @param array $keys
	 * @param array|null $weights
	 * @param string|null $aggregate see Aggregate* constants
	 * @return int
	 */
	public function zUnionStore($destination, array $keys, array $weights = null, $aggregate = null);

	/**
	 * Increment the integer value of a key by the given number
	 * @param string $key
	 * @param int $increment
	 * @return int
	 */
	public function IncrBy($key, $increment);

	/**
	 * Returns all keys matching pattern.
	 * @param string $pattern
	 *   Supported glob-style patterns:
	 *   h?llo matches hello, hallo and hxllo
	 *   h*llo matches hllo and heeeello
	 *   h[ae]llo matches hello and hallo, but not hillo
	 *   Use \ to escape special characters if you want to match them verbatim.
	 * @return array
	 */
	public function Keys($pattern);

	/** Mark the start of a transaction block */
	public function Multi();

	/**
	 * Marks the given keys to be watched for conditional execution of a transaction
	 * each argument is a key:
	 * watch('key1', 'key2', 'key3', ...)
	 * @param string $key
	 */
	public function Watch($key);

	/**
	 * Executes all previously queued commands in a transaction and restores the connection state to normal.
	 * When using WATCH, EXEC will execute commands only if the watched keys were not modified, allowing for a check-and-set mechanism.
	 */
	public function Exec();

	/**
	 * Flushes all previously queued commands in a transaction and restores the connection state to normal.
	 * If WATCH was used, DISCARD unwatches all keys.
	 */
	public function Discard();

	/** Add a member to a set
	 * @param string $key
	 * @param string|array $member or multiple arguments
	 * @return boolean
	 */
	public function sAdd($key, $member);

	/**
	 * Returns if value is a member of the set.
	 * @param string $key
	 * @param string $member
	 * @return boolean
	 */
	public function sIsMember($key, $member);

	/**
	 * Returns all the members of the set.
	 * @param string $key
	 * @return array
	 */
	public function sMembers($key);

	/**
	 * Remove member from the set. If 'value' is not a member of this set, no operation is performed.
	 * An error is returned when the value stored at key is not a set.
	 * @param string $key
	 * @param string $member
	 * @return boolean
	 */
	public function sRem($key, $member);

	/** Get information and statistics about the server */
	public function Info();

	/** Internal command used for replication */
	public function SYNC();

	/**
	 * Get a random member from a set
	 * @param string $key
	 * @param int $count
	 * @return
	 */
	public function SRANDMEMBER($key, $count = 1);

	/**
	 * Remove and return a random member from a set
	 * @param string $key
	 */
	public function SPOP($key);

	/**
	 * Manages the Redis slow queries log
	 * @param string $subcommand
	 * @param string $argument
	 * @return
	 */
	public function SLOWLOG($subcommand, $argument = '');

	/**
	 * Synchronously save the dataset to disk and then shut down the server
	 * One of modifiers can be turned on:
	 * @param boolean $save   will force a DB saving operation even if no save points are configured.
	 * @param boolean $nosave will prevent a DB saving operation even if one or more save points are configured.
	 */
	public function SHUTDOWN($save = false, $nosave = false);

	/** Synchronously save the dataset to disk */
	public function SAVE();

	/** Return a random key from the keyspace */
	public function RANDOMKEY();

	/**
	 * Inspect the internals of Redis objects
	 * @param string $subcommand
	 * @param array $arguments
	 * @return
	 */
	public function OBJECT($subcommand, $arguments = array());

	/** Listen for all requests received by the server in real time */
	public function MONITOR();

	/** Get the UNIX time stamp of the last successful save to disk Ping the server */
	public function LASTSAVE();

	/** Ping the server */
	public function  PING();

	/**
	 * Echo the given string
	 * @param string $message
	 */
	public function ECHO_($message);

	/** Make the server crash */
	public function DEBUG_SEGFAULT();

	/**
	 * Get debugging information about a key
	 * @param string $key
	 */
	public function DEBUG_OBJECT($key);

	/**
	 * Count the number of set bits (population counting) in a string.
	 * By default all the bytes contained in the string are examined.
	 * It is possible to specify the counting operation only in an interval passing the additional arguments start and end.
	 * @param $key
	 * @param int $start
	 * @param int $end
	 * @return int
	 */
	public function BITCOUNT($key, $start = 0, $end = 0);

	/**
	 * Perform a bitwise operation between multiple keys (containing string values) and store the result in the destination key.
	 * The BITOP command supports four bitwise operations: AND, OR, XOR and NOT, thus the valid forms to call the command are:
	 * BITOP AND destkey srckey1 srckey2 srckey3 ... srckeyN
	 * BITOP OR destkey srckey1 srckey2 srckey3 ... srckeyN
	 * BITOP XOR destkey srckey1 srckey2 srckey3 ... srckeyN
	 * BITOP NOT destkey srckey
	 * As you can see NOT is special as it only takes an input key, because it performs inversion of bits so it only makes sense as an unary operator.
	 * The result of the operation is always stored at destkey.
	 * @param string $operation
	 * @param string $destkey
	 * @param string $key
	 * @return integer
	 * @usage
	 * BITOP(operation, destkey, key1 [, key2...])
	 */
	public function BITOP($operation, $destkey, $key);

	/**
	 * The CLIENT KILL command closes a given client connection identified by ip:port.
	 * The ip:port should match a line returned by the CLIENT LIST command.
	 * @param $ip
	 * @param $port
	 * @return boolean
	 */
	public function CLIENT_KILL($ip, $port);

	/** Get the list of client connections */
	public function CLIENT_LIST();

	/** Get the current connection name */
	public function CLIENT_GETNAME();

	/**
	 * Set the current connection name
	 * @param string $connection_name
	 * @return boolean
	 */
	public function CLIENT_SETNAME($connection_name);

	/**
	 * Serialize the value stored at key in a Redis-specific format and return it to the user.
	 * The returned value can be synthesized back into a Redis key using the RESTORE command.
	 * @param string $key
	 * @return string
	 */
	public function DUMP($key);

	/**
	 * Execute a Lua script server side
	 * @param string $script
	 * @param array $keys
	 * @param array $args
	 * @return mixed
	 */
	public function EVAL_($script, array $keys, array $args);

	/**
	 * Execute a Lua script server side
	 * @param $sha1
	 * @param array $keys
	 * @param array $args
	 * @return mixed
	 */
	public function EVALSHA($sha1, array $keys, array $args);

	/**
	 * Increment the specified field of an hash stored at key, and representing a floating point number, by the specified increment.
	 * If the field does not exist, it is set to 0 before performing the operation.
	 * @param string $key
	 * @param string $field
	 * @param float $increment
	 * @return float the value of field after the increment
	 */
	public function HINCRBYFLOAT($key, $field, $increment);

	/**
	 * Increment the string representing a floating point number stored at key by the specified increment.
	 * If the key does not exist, it is set to 0 before performing the operation.
	 * @param string $key
	 * @param float $increment
	 * @return float the value of key after the increment
	 */
	public function INCRBYFLOAT($key, $increment);

	/**
	 * Atomically transfer a key from a Redis instance to another one.
	 * On success the key is deleted from the original instance and is guaranteed to exist in the target instance.
	 * The command is atomic and blocks the two instances for the time required to transfer the key, at any given time the key will appear to exist in a given instance or in the other instance, unless a timeout error occurs.
	 * @param string $host
	 * @param string $port
	 * @param string $key
	 * @param integer $destination_db
	 * @param integer $timeout
	 * @return boolean
	 */
	public function MIGRATE($host, $port, $key, $destination_db, $timeout);

	/**
	 * Set a key's time to live in milliseconds
	 * @param string $key
	 * @param integer $milliseconds
	 * @return integer 1 if the timeout was set, 0 if key does not exist or the timeout could not be set.
	 */
	public function PEXPIRE($key, $milliseconds);

	/**
	 * Set the expiration for a key as a UNIX timestamp specified in milliseconds
	 * @param string $key
	 * @param int $milliseconds_timestamp the Unix time at which the key will expire
	 * @return integer 1 if the timeout was set, 0 if key does not exist or the timeout could not be set.
	 */
	public function PEXPIREAT($key, $milliseconds_timestamp);

	/**
	 * Set the value and expiration in milliseconds of a key
	 * @param string $key
	 * @param int $milliseconds
	 * @param string $value
	 * @return boolean
	 */
	public function PSETEX($key, $milliseconds, $value);

	/**
	 * Get the time to live for a key in milliseconds
	 * @param string $key
	 * @return int Time to live in milliseconds or -1 when key does not exist or does not have a timeout.
	 */
	public function PTTL($key);

	/**
	 * Create a key using the provided serialized value, previously obtained using DUMP.
	 * @param string $key
	 * @param int $ttl If ttl is 0 the key is created without any expire, otherwise the specified expire time (in milliseconds) is set.
	 * @param string $serialized_value
	 * @return boolean
	 */
	public function RESTORE($key, $ttl, $serialized_value);

	/**
	 * Check existence of scripts in the script cache.
	 * @param string $script
	 * @return array
	 */
	public function SCRIPT_EXISTS($script);
	
	/** Remove all the scripts from the script cache. */
	public function SCRIPT_FLUSH();
	
	/** Kills the currently executing Lua script, assuming no write operation was yet performed by the script. */
	public function SCRIPT_KILL();

	/**
	 * Load a script into the scripts cache, without executing it. 
	 * After the specified command is loaded into the script cache it will be callable using EVALSHA with the correct SHA1 digest 
	 * of the script, exactly like after the first successful invocation of EVAL.
	 * @param string $script
	 * @return string This command returns the SHA1 digest of the script added into the script cache.
	 */
	public function SCRIPT_LOAD($script);
	
	/**
	 * Returns the current server time as a two items lists: a Unix timestamp and the amount of microseconds already elapsed in the current second
	 * @return array
	 */
	public function TIME();
}


/**
 * RedisServer allows you to work with Redis storage in PHP
 * Redis version compatibility: 2.6.9 (and below)
 * You can send custom command using send_command() method.
 */
class RedisClient implements IRedisClient
{
	protected $connection;
	private $host = 'localhost';
	private $port = 6379;
	private $repeat_reconnected = false;

	public function __construct($host = 'localhost', $port = '6379')
	{
		$this->host = $host;
		$this->port = $port;
	}

	public function connect($host, $port)
	{
		if (!empty($this->connection))
		{
			fclose($this->connection);
			$this->connection = NULL;
		}
		$socket = fsockopen($host, $port, $errno, $errstr);
		if (!$socket)
		{
			$this->reportError('Connection error: '.$errno.':'.$errstr);
			return false;
		}
		$this->connection = $socket;
		return $socket;
	}

	protected function reportError($msg)
	{
		trigger_error($msg, E_USER_WARNING);
	}

	/**
	 * Execute send_command and return the result
	 * Each entity of the send_command should be passed as argument
	 * Example:
	 *  send_command('set','key','example value');
	 * or:
	 *  send_command('multi');
	 *  send_command('config','ResetStat'); // if command contain 2 words, they should be separated
	 *  send_command('set','a', serialize($arr));
	 *  send_command('set','b', 1);
	 *  send_command('execute');
	 * @return array|bool|int|null|string
	 */
	public function send_command()
	{
		return $this->_send(func_get_args());
	}

	protected function _send($args)
	{
		if (empty($this->connection))
		{
			if (!$this->connect($this->host, $this->port))
			{
				return false;
			}
		}
		$command = '*'.count($args)."\r\n";
		foreach ($args as $arg) {
            $command .= "$".strlen($arg)."\r\n".$arg."\r\n";
        }
		$w = fwrite($this->connection, $command);
		if (!$w)
		{
			//if connection was lost
			$this->connect($this->host, $this->port);
			if (!fwrite($this->connection, $command))
			{
				$this->reportError('command was not sent');
				return false;
			}
		}
		$answer = $this->_read_reply();
		if ($answer===false && $this->repeat_reconnected)
		{
			if (fwrite($this->connection, $command))
			{
				$answer = $this->_read_reply();
			}
			$this->repeat_reconnected = false;
		}
		return $answer;
	}

	/* If some command is not wrapped... */
	public function __call($name, $args)
	{
		$command = trim(str_replace('_', ' ', $name, $replaced));
		if ($replaced > 0)
		{
			$commands = explode(' ', $command);
			$args     = array_merge($commands, $args);
		}
		else
		{
			array_unshift($args, $command);
		}
		return $this->_send($args);
	}

	protected function _read_reply()
	{
		$server_reply = fgets($this->connection);
		if ($server_reply===false)
		{
			if (!$this->connect($this->host, $this->port))
			{
				return false;
			}
			else
			{
				$server_reply = fgets($this->connection);
				if (empty($server_reply))
				{
					$this->repeat_reconnected = true;
					return false;
				}
			}
		}
		$reply    = trim($server_reply);
		$response = null;
		/**
		 * Thanks to Justin Poliey for original code of parsing the answer
		 * https://github.com/jdp
		 * Error was fixed there: https://github.com/jamm/redisent
		 */
		switch ($reply[0])
		{
			/* Error reply */
			case '-':
				$this->reportError('error: '.$reply);
				return false;
			/* Inline reply */
			case '+':
				return substr($reply, 1);
			/* Bulk reply */
			case '$':
				if ($reply=='$-1') {
                    return null;
                }
				$response = null;
				$size     = intval(substr($reply, 1));
				if ($size > 0)
				{
					$response = stream_get_contents($this->connection, $size);
				}
				fread($this->connection, 2); /* discard crlf */
				break;
			/* Multi-bulk reply */
			case '*':
				$count = substr($reply, 1);
				if ($count=='-1') {
                    return null;
                }
				$response = array();
				for ($i = 0; $i < $count; $i++)
				{
					$response[] = $this->_read_reply();
				}
				break;
			/* Integer reply */
			case ':':
				return intval(substr($reply, 1));
				break;
			default:
				$this->reportError('Non-protocol answer: '.print_r($server_reply, 1));
				return false;
		}
		return $response;
	}

	public function Get($key)
	{
		return $this->_send(array('get', $key));
	}

	public function Set($key, $value)
	{
		return $this->_send(array('set', $key, $value));
	}

	public function SetEx($key, $seconds, $value)
	{
		return $this->_send(array('setex', $key, $seconds, $value));
	}

	public function Keys($pattern)
	{
		return $this->_send(array('keys', $pattern));
	}

	public function Multi()
	{
		return $this->_send(array('multi'));
	}

	public function sAdd($key, $member)
	{
		if (!is_array($member)) {
            $member = func_get_args();
        }else {
            array_unshift($member, $key);
        }
		return $this->__call('sadd', $member);
	}

	public function sMembers($key)
	{
		return $this->_send(array('smembers', $key));
	}

	public function hSet($key, $field, $value)
	{
		return $this->_send(array('hset', $key, $field, $value));
	}

	public function hGetAll($key)
	{
		$arr = $this->_send(array('hgetall', $key));
		$c   = count($arr);
		$r   = array();
		for ($i = 0; $i < $c; $i += 2)
		{
			$r[$arr[$i]] = $arr[$i+1];
		}
		return $r;
	}

	public function FlushDB()
	{
		return $this->_send(array('flushdb'));
	}

	public function Info()
	{
		return $this->_send(array('info'));
	}

	/** Close connection */
	public function __destruct()
	{
		if (!empty($this->connection)) {
            fclose($this->connection);
        }
	}

	public function SetNX($key, $value)
	{
		return $this->_send(array('setnx', $key, $value));
	}

	public function Watch($key)
	{
		$args = func_get_args();
		array_unshift($args, 'watch');
		return $this->_send($args);
	}

	public function Exec()
	{
		return $this->_send(array('exec'));
	}

	public function Discard()
	{
		return $this->_send(array('discard'));
	}

	public function sIsMember($key, $member)
	{
		return $this->_send(array('sismember', $key, $member));
	}

	public function sRem($key, $member)
	{
		if (!is_array($member)) {
            $member = func_get_args();
        }else {
            array_unshift($member, $key);
        }
		return $this->__call('srem', $member);
	}

	public function Expire($key, $seconds)
	{
		return $this->_send(array('expire', $key, $seconds));
	}

	public function TTL($key)
	{
		return $this->_send(array('ttl', $key));
	}

	public function Del($key)
	{
		if (!is_array($key)) {
            $key = func_get_args();
        }
		return $this->__call('del', $key);
	}

	public function IncrBy($key, $increment)
	{
		return $this->_send(array('incrby', $key, $increment));
	}

	public function Append($key, $value)
	{
		return $this->_send(array('append', $key, $value));
	}

	public function Auth($password)
	{
		return $this->_send(array('Auth', $password));
	}

	public function bgRewriteAOF()
	{
		return $this->_send(array('bgRewriteAOF'));
	}

	public function bgSave()
	{
		return $this->_send(array('bgSave'));
	}

	public function BLPop($key, $timeout)
	{
		if (!is_array($key)) $key = func_get_args();
		else array_push($key, $timeout);
		return $this->__call('BLPop', $key);
	}

	public function BRPop($key, $timeout)
	{
		if (!is_array($key)) $key = func_get_args();
		else array_push($key, $timeout);
		return $this->__call('BRPop', $key);
	}

	public function BRPopLPush($source, $destination, $timeout)
	{
		return $this->_send(array('BRPopLPush', $source, $destination, $timeout));
	}

	public function Config_Get($parameter)
	{
		return $this->_send(array('CONFIG', 'GET', $parameter));
	}

	public function Config_Set($parameter, $value)
	{
		return $this->_send(array('CONFIG', 'SET', $parameter, $value));
	}

	public function Config_ResetStat()
	{
		return $this->__call('CONFIG_RESETSTAT', array());
	}

	public function DBsize()
	{
		return $this->_send(array('dbsize'));
	}

	public function Decr($key)
	{
		return $this->_send(array('decr', $key));
	}

	public function DecrBy($key, $decrement)
	{
		return $this->_send(array('DecrBy', $key, $decrement));
	}

	public function Exists($key)
	{
		return $this->_send(array('Exists', $key));
	}

	public function Expireat($key, $timestamp)
	{
		return $this->_send(array('Expireat', $key, $timestamp));
	}

	public function FlushAll()
	{
		return $this->_send(array('flushall'));
	}

	public function GetBit($key, $offset)
	{
		return $this->_send(array('GetBit', $key, $offset));
	}

	public function GetRange($key, $start, $end)
	{
		return $this->_send(array('getrange', $key, $start, $end));
	}

	public function GetSet($key, $value)
	{
		return $this->_send(array('GetSet', $key, $value));
	}

	public function hDel($key, $field)
	{
		if (!is_array($field)) $field = func_get_args();
		else array_unshift($field, $key);
		return $this->__call('hdel', $field);
	}

	public function hExists($key, $field)
	{
		return $this->_send(array('hExists', $key, $field));
	}

	public function hGet($key, $field)
	{
		return $this->_send(array('hGet', $key, $field));
	}

	public function hIncrBy($key, $field, $increment)
	{
		return $this->_send(array('hIncrBy', $key, $field, $increment));
	}

	public function hKeys($key)
	{
		return $this->_send(array('hKeys', $key));
	}

	public function hLen($key)
	{
		return $this->_send(array('hLen', $key));
	}

	public function hMGet($key, array $fields)
	{
		array_unshift($fields, $key);
		return $this->__call('hMGet', $fields);
	}

	public function hMSet($key, $fields)
	{
		$args[] = $key;
		foreach ($fields as $field => $value)
		{
			$args[] = $field;
			$args[] = $value;
		}
		return $this->__call('hMSet', $args);
	}

	public function hSetNX($key, $field, $value)
	{
		return $this->_send(array('hSetNX', $key, $field, $value));
	}

	public function hVals($key)
	{
		return $this->_send(array('hVals', $key));
	}

	public function Incr($key)
	{
		return $this->_send(array('Incr', $key));
	}

	public function LIndex($key, $index)
	{
		return $this->_send(array('LIndex', $key, $index));
	}

	public function LInsert($key, $after = true, $pivot, $value)
	{
		if ($after) $position = self::Position_AFTER;
		else $position = self::Position_BEFORE;
		return $this->_send(array('LInsert', $key, $position, $pivot, $value));
	}

	public function LLen($key)
	{
		return $this->_send(array('LLen', $key));
	}

	public function LPop($key)
	{
		return $this->_send(array('LPop', $key));
	}

	public function LPush($key, $value)
	{
		if (!is_array($value)) $value = func_get_args();
		else array_unshift($value, $key);
		return $this->__call('lpush', $value);
	}

	public function LPushX($key, $value)
	{
		return $this->_send(array('LPushX', $key, $value));
	}

	public function LRange($key, $start, $stop)
	{
		return $this->_send(array('LRange', $key, $start, $stop));
	}

	public function LRem($key, $count, $value)
	{
		return $this->_send(array('LRem', $key, $count, $value));
	}

	public function LSet($key, $index, $value)
	{
		return $this->_send(array('LSet', $key, $index, $value));
	}

	public function LTrim($key, $start, $stop)
	{
		return $this->_send(array('LTrim', $key, $start, $stop));
	}

	public function MGet($key)
	{
		if (!is_array($key)) $key = func_get_args();
		return $this->__call('MGet', $key);
	}

	public function Move($key, $db)
	{
		return $this->_send(array('Move', $key, $db));
	}

	public function MSet(array $keys)
	{
		$q = array();
		foreach ($keys as $k => $v)
		{
			$q[] = $k;
			$q[] = $v;
		}
		return $this->__call('MSet', $q);
	}

	public function MSetNX(array $keys)
	{
		$q = array();
		foreach ($keys as $k => $v)
		{
			$q[] = $k;
			$q[] = $v;
		}
		return $this->__call('MSetNX', $q);
	}

	public function Persist($key)
	{
		return $this->_send(array('Persist', $key));
	}

	public function PSubscribe($pattern)
	{
		return $this->_send(array('PSubscribe', $pattern));
	}

	public function Publish($channel, $message)
	{
		return $this->_send(array('Publish', $channel, $message));
	}

	public function PUnsubscribe($pattern = null)
	{
		if (!empty($pattern))
		{
			if (!is_array($pattern)) $pattern = array($pattern);
			return $this->__call('PUnsubscribe', $pattern);
		}
		else return $this->_send(array('PUnsubscribe'));
	}

	public function Quit()
	{
		return $this->_send(array('Quit'));
	}

	public function Rename($key, $newkey)
	{
		return $this->_send(array('Rename', $key, $newkey));
	}

	public function RenameNX($key, $newkey)
	{
		return $this->_send(array('RenameNX', $key, $newkey));
	}

	public function RPop($key)
	{
		return $this->_send(array('RPop', $key));
	}

	public function RPopLPush($source, $destination)
	{
		return $this->_send(array('RPopLPush', $source, $destination));
	}

	public function RPush($key, $value)
	{
		if (!is_array($value)) $value = func_get_args();
		else array_unshift($value, $key);
		return $this->__call('rpush', $value);
	}

	public function RPushX($key, $value)
	{
		return $this->_send(array('RPushX', $key, $value));
	}

	public function sCard($key)
	{
		return $this->_send(array('sCard', $key));
	}

	public function sDiff($key)
	{
		if (!is_array($key)) $key = func_get_args();
		return $this->__call('sDiff', $key);
	}

	public function sDiffStore($destination, $key)
	{
		if (!is_array($key)) $key = func_get_args();
		else array_unshift($key, $destination);
		return $this->__call('sDiffStore', $key);
	}

	public function Select($index)
	{
		return $this->_send(array('Select', $index));
	}

	public function SetBit($key, $offset, $value)
	{
		return $this->_send(array('SetBit', $key, $offset, $value));
	}

	public function SetRange($key, $offset, $value)
	{
		return $this->_send(array('SetRange', $key, $offset, $value));
	}

	public function sInter($key)
	{
		if (!is_array($key)) $key = func_get_args();
		return $this->__call('sInter', $key);
	}

	public function sInterStore($destination, $key)
	{
		if (is_array($key)) array_unshift($key, $destination);
		else $key = func_get_args();
		return $this->__call('sInterStore', $key);
	}

	public function SlaveOf($host, $port)
	{
		return $this->_send(array('SlaveOf', $host, $port));
	}

	public function sMove($source, $destination, $member)
	{
		return $this->_send(array('sMove', $source, $destination, $member));
	}

	public function Sort($key, $sort_rule)
	{
		return $this->_send(array('Sort', $key, $sort_rule));
	}

	public function StrLen($key)
	{
		return $this->_send(array('StrLen', $key));
	}

	public function Subscribe($channel)
	{
		if (!is_array($channel)) $channel = func_get_args();
		return $this->__call('Subscribe', $channel);
	}

	public function sUnion($key)
	{
		if (!is_array($key)) $key = func_get_args();
		return $this->__call('sUnion', $key);
	}

	public function sUnionStore($destination, $key)
	{
		if (!is_array($key)) $key = func_get_args();
		else array_unshift($key, $destination);
		return $this->__call('sUnionStore', $key);
	}

	public function Type($key)
	{
		return $this->_send(array('Type', $key));
	}

	public function Unsubscribe($channel = '')
	{
		$args = func_get_args();
		if (empty($args)) return $this->_send(array('Unsubscribe'));
		else
		{
			if (is_array($channel)) return $this->__call('Unsubscribe', $channel);
			else return $this->__call('Unsubscribe', $args);
		}
	}

	public function Unwatch()
	{
		return $this->_send(array('Unwatch'));
	}

	public function zAdd($key, $score, $member = NULL)
	{
		if (!is_array($score)) $values = func_get_args();
		else
		{
			foreach ($score as $score_value => $member)
			{
				$values[] = $score_value;
				$values[] = $member;
			}
			array_unshift($values, $key);
		}
		return $this->__call('zadd', $values);
	}

	public function zCard($key)
	{
		return $this->_send(array('zCard', $key));
	}

	public function zCount($key, $min, $max)
	{
		return $this->_send(array('zCount', $key, $min, $max));
	}

	public function zIncrBy($key, $increment, $member)
	{
		return $this->_send(array('zIncrBy', $key, $increment, $member));
	}

	public function zInterStore($destination, array $keys, array $weights = null, $aggregate = null)
	{
		$destination = array($destination, count($keys));
		$destination = array_merge($destination, $keys);
		if (!empty($weights))
		{
			$destination[] = 'WEIGHTS';
			$destination   = array_merge($destination, $weights);
		}
		if (!empty($aggregate))
		{
			$destination[] = 'AGGREGATE';
			$destination[] = $aggregate;
		}
		return $this->__call('zInterStore', $destination);
	}

	public function zRange($key, $start, $stop, $withscores = false)
	{
		if ($withscores) return $this->_send(array('zRange', $key, $start, $stop, self::WITHSCORES));
		else return $this->_send(array('zRange', $key, $start, $stop));
	}

	public function zRangeByScore($key, $min, $max, $withscores = false, array $limit = null)
	{
		$args = array($key, $min, $max);
		if ($withscores) $args[] = self::WITHSCORES;
		if (!empty($limit))
		{
			$args[] = 'LIMIT';
			$args[] = $limit[0];
			$args[] = $limit[1];
		}
		return $this->__call('zRangeByScore', $args);
	}

	public function zRank($key, $member)
	{
		return $this->_send(array('zRank', $key, $member));
	}

	public function zRem($key, $member)
	{
		if (!is_array($member)) $member = func_get_args();
		else array_unshift($member, $key);
		return $this->__call('zrem', $member);
	}

	public function zRemRangeByRank($key, $start, $stop)
	{
		return $this->_send(array('zRemRangeByRank', $key, $start, $stop));
	}

	public function zRemRangeByScore($key, $min, $max)
	{
		return $this->_send(array('zRemRangeByScore', $key, $min, $max));
	}

	public function zRevRange($key, $start, $stop, $withscores = false)
	{
		if ($withscores) return $this->_send(array('zRevRange', $key, $start, $stop, self::WITHSCORES));
		else return $this->_send(array('zRevRange', $key, $start, $stop));
	}

	public function zRevRangeByScore($key, $max, $min, $withscores = false, array $limit = null)
	{
		$args = array($key, $max, $min);
		if ($withscores) $args[] = self::WITHSCORES;
		if (!empty($limit))
		{
			$args[] = 'LIMIT';
			$args[] = $limit[0];
			$args[] = $limit[1];
		}
		return $this->__call('zRevRangeByScore', $args);
	}

	public function zRevRank($key, $member)
	{
		return $this->_send(array('zRevRank', $key, $member));
	}

	public function zScore($key, $member)
	{
		return $this->_send(array('zScore', $key, $member));
	}

	public function zUnionStore($destination, array $keys, array $weights = null, $aggregate = null)
	{
		$destination = array($destination, count($keys));
		$destination = array_merge($destination, $keys);
		if (!empty($weights))
		{
			$destination[] = 'WEIGHTS';
			$destination   = array_merge($destination, $weights);
		}
		if (!empty($aggregate))
		{
			$destination[] = 'AGGREGATE';
			$destination[] = $aggregate;
		}
		return $this->__call('zUnionStore', $destination);
	}

	/** Internal command used for replication */
	public function SYNC()
	{
		return $this->_send(array('SYNC'));
	}

	/**
	 * Get a random member from a set
	 * @param string $key
	 * @param int $count
	 * @return string
	 */
	public function SRANDMEMBER($key, $count = 1)
	{
		return $this->_send(array('SRANDMEMBER', $key, $count));
	}

	/**
	 * Remove and return a random member from a set
	 * @param string $key
	 * @return string
	 */
	public function SPOP($key)
	{
		return $this->_send(array('SPOP', $key));
	}

	/**
	 * Manages the Redis slow queries log
	 * @param string $subcommand
	 * @param string $argument
	 * @return mixed
	 */
	public function SLOWLOG($subcommand, $argument = '')
	{
		return $this->_send(array('SLOWLOG', $subcommand, $argument));
	}

	/**
	 * Synchronously save the dataset to disk and then shut down the server
	 * One of modifiers can be turned on:
	 * @param boolean $save   will force a DB saving operation even if no save points are configured.
	 * @param boolean $nosave will prevent a DB saving operation even if one or more save points are configured.
	 * @return bool
	 */
	public function SHUTDOWN($save = false, $nosave = false)
	{
		if ($save)
		{
			return $this->_send(array('SHUTDOWN', 'SAVE'));
		}
		elseif ($nosave)
		{
			return $this->_send(array('SHUTDOWN', 'NOSAVE'));
		}
		return $this->_send(array('SHUTDOWN'));
	}

	/** Synchronously save the dataset to disk */
	public function SAVE()
	{
		return $this->_send(array('SAVE'));
	}

	/** Return a random key from the keyspace */
	public function RANDOMKEY()
	{
		return $this->_send(array('RANDOMKEY'));
	}

	/**
	 * Inspect the internals of Redis objects
	 * @param string $subcommand
	 * @param array $arguments
	 * @return mixed
	 */
	public function OBJECT($subcommand, $arguments = array())
	{
		array_unshift($arguments, $subcommand);
		return $this->__call('OBJECT', $arguments);
	}

	/** Listen for all requests received by the server in real time */
	public function MONITOR()
	{
		return $this->_send(array('MONITOR'));
	}

	/** Get the UNIX time stamp of the last successful save to disk Ping the server */
	public function LASTSAVE()
	{
		return $this->_send(array('LASTSAVE'));
	}

	/** Ping the server */
	public function  PING()
	{
		return $this->_send(array('PING'));
	}

	/**
	 * Echo the given string
	 * @param string $message
	 * @return string
	 */
	public function ECHO_($message)
	{
		return $this->_send(array('ECHO', $message));
	}

	/** Make the server crash */
	public function DEBUG_SEGFAULT()
	{
		return $this->_send(array('DEBUG', 'SEGFAULT'));
	}

	/**
	 * Get debugging information about a key
	 * @param string $key
	 * @return mixed
	 */
	public function DEBUG_OBJECT($key)
	{
		return $this->_send(array('DEBUG', 'OBJECT', $key));
	}

	/**
	 * Count the number of set bits (population counting) in a string.
	 * By default all the bytes contained in the string are examined.
	 * It is possible to specify the counting operation only in an interval passing the additional arguments start and end.
	 * @param string $key
	 * @param int $start
	 * @param int $end
	 * @return int
	 */
	public function BITCOUNT($key, $start = 0, $end = 0)
	{
		if ($start > 0 || $end > 0)
		{
			return $this->_send(array('BITCOUNT', $key, $start, $end));
		}
		return $this->_send(array('BITCOUNT', $key));
	}

	/**
	 * Perform a bitwise operation between multiple keys (containing string values) and store the result in the destination key.
	 * The BITOP command supports four bitwise operations: AND, OR, XOR and NOT, thus the valid forms to call the command are:
	 * BITOP AND destkey srckey1 srckey2 srckey3 ... srckeyN
	 * BITOP OR destkey srckey1 srckey2 srckey3 ... srckeyN
	 * BITOP XOR destkey srckey1 srckey2 srckey3 ... srckeyN
	 * BITOP NOT destkey srckey
	 * As you can see NOT is special as it only takes an input key, because it performs inversion of bits so it only makes sense as an unary operator.
	 * The result of the operation is always stored at destkey.
	 * @param string $operation
	 * @param string $destkey
	 * @param string $key
	 * @return integer
	 * @usage
	 * BITOP(operation, destkey, key1 [, key2...])
	 */
	public function BITOP($operation, $destkey, $key)
	{
		$args = func_get_args();
		array_unshift($args, 'BITOP');
		return $this->_send($args);
	}

	/**
	 * The CLIENT KILL command closes a given client connection identified by ip:port.
	 * The ip:port should match a line returned by the CLIENT LIST command.
	 * @param $ip
	 * @param $port
	 * @return boolean
	 */
	public function CLIENT_KILL($ip, $port)
	{
		return $this->_send(array('CLIENT', 'KILL', $ip.':'.$port));
	}

	/** Get the list of client connections */
	public function CLIENT_LIST()
	{
		return $this->_send(array('CLIENT', 'LIST'));
	}

	/** Get the current connection name */
	public function CLIENT_GETNAME()
	{
		return $this->_send(array('CLIENT', 'GETNAME'));
	}

	/**
	 * Set the current connection name
	 * @param string $connection_name
	 * @return boolean
	 */
	public function CLIENT_SETNAME($connection_name)
	{
		return $this->_send(array('CLIENT', 'SETNAME', $connection_name));
	}

	/**
	 * Serialize the value stored at key in a Redis-specific format and return it to the user.
	 * The returned value can be synthesized back into a Redis key using the RESTORE command.
	 * @param string $key
	 * @return string
	 */
	public function DUMP($key)
	{
		return $this->_send(array('DUMP', $key));
	}

	/**
	 * Execute a Lua script server side
	 * @param string $script
	 * @param array $keys
	 * @param array $args
	 * @return mixed
	 */
	public function EVAL_($script, array $keys, array $args)
	{
		$params = array('EVAL', $script, count($keys));
		$params = array_merge($params, $keys);
		$params = array_merge($params, $args);
		return $this->_send($params);
	}

	/**
	 * Execute a Lua script server side
	 * @param $sha1
	 * @param array $keys
	 * @param array $args
	 * @return mixed
	 */
	public function EVALSHA($sha1, array $keys, array $args)
	{
		$params = array('EVALSHA', $sha1, count($keys));
		$params = array_merge($params, $keys);
		$params = array_merge($params, $args);
		return $this->_send($params);
	}

	/**
	 * Increment the specified field of an hash stored at key, and representing a floating point number, by the specified increment.
	 * If the field does not exist, it is set to 0 before performing the operation.
	 * @param string $key
	 * @param string $field
	 * @param float $increment
	 * @return float the value of field after the increment
	 */
	public function HINCRBYFLOAT($key, $field, $increment)
	{
		return $this->_send(array('HINCRBYFLOAT', $key, $field, $increment));
	}

	/**
	 * Increment the string representing a floating point number stored at key by the specified increment.
	 * If the key does not exist, it is set to 0 before performing the operation.
	 * @param string $key
	 * @param float $increment
	 * @return float the value of key after the increment
	 */
	public function INCRBYFLOAT($key, $increment)
	{
		return $this->_send(array('INCRBYFLOAT', $key, $increment));
	}

	/**
	 * Atomically transfer a key from a Redis instance to another one.
	 * On success the key is deleted from the original instance and is guaranteed to exist in the target instance.
	 * The command is atomic and blocks the two instances for the time required to transfer the key, at any given time the key will appear to exist in a given instance or in the other instance, unless a timeout error occurs.
	 * @param string $host
	 * @param string $port
	 * @param string $key
	 * @param integer $destination_db
	 * @param integer $timeout
	 * @return boolean
	 */
	public function MIGRATE($host, $port, $key, $destination_db, $timeout)
	{
		return $this->_send(array('MIGRATE', $host, $port, $key, $destination_db, $timeout));
	}

	/**
	 * Set a key's time to live in milliseconds
	 * @param string $key
	 * @param integer $milliseconds
	 * @return integer 1 if the timeout was set, 0 if key does not exist or the timeout could not be set.
	 */
	public function PEXPIRE($key, $milliseconds)
	{
		return $this->_send(array('PEXPIRE', $key, $milliseconds));
	}

	/**
	 * Set the expiration for a key as a UNIX timestamp specified in milliseconds
	 * @param string $key
	 * @param int $milliseconds_timestamp the Unix time at which the key will expire
	 * @return integer 1 if the timeout was set, 0 if key does not exist or the timeout could not be set.
	 */
	public function PEXPIREAT($key, $milliseconds_timestamp)
	{
		return $this->_send(array('PEXPIREAT', $key, $milliseconds_timestamp));
	}

	/**
	 * Set the value and expiration in milliseconds of a key
	 * @param string $key
	 * @param int $milliseconds
	 * @param string $value
	 * @return boolean
	 */
	public function PSETEX($key, $milliseconds, $value)
	{
		return $this->_send(array('PSETEX', $key, $milliseconds, $value));
	}

	/**
	 * Get the time to live for a key in milliseconds
	 * @param string $key
	 * @return int Time to live in milliseconds or -1 when key does not exist or does not have a timeout.
	 */
	public function PTTL($key)
	{
		return $this->_send(array('PTTL', $key));
	}

	/**
	 * Create a key using the provided serialized value, previously obtained using DUMP.
	 * @param string $key
	 * @param int $ttl If ttl is 0 the key is created without any expire, otherwise the specified expire time (in milliseconds) is set.
	 * @param string $serialized_value
	 * @return boolean
	 */
	public function RESTORE($key, $ttl, $serialized_value)
	{
		return $this->_send(array('RESTORE', $key, $ttl, $serialized_value));
	}

	/**
	 * Check existence of scripts in the script cache.
	 * @param string $script
	 * @return array
	 */
	public function SCRIPT_EXISTS($script)
	{
		return $this->_send(array('SCRIPT', 'EXISTS', $script));
	}

	/** Remove all the scripts from the script cache. */
	public function SCRIPT_FLUSH()
	{
		return $this->_send(array('SCRIPT', 'FLUSH'));
	}

	/** Kills the currently executing Lua script, assuming no write operation was yet performed by the script. */
	public function SCRIPT_KILL()
	{
		return $this->_send(array('SCRIPT', 'KILL'));
	}

	/**
	 * Load a script into the scripts cache, without executing it.
	 * After the specified command is loaded into the script cache it will be callable using EVALSHA with the correct SHA1 digest
	 * of the script, exactly like after the first successful invocation of EVAL.
	 * @param string $script
	 * @return string This command returns the SHA1 digest of the script added into the script cache.
	 */
	public function SCRIPT_LOAD($script)
	{
		return $this->_send(array('SCRIPT', 'LOAD', $script));
	}

	/**
	 * Returns the current server time as a two items lists: a Unix timestamp and the amount of microseconds already elapsed in the current second
	 * @return array
	 */
	public function TIME()
	{
		return $this->_send(array('TIME'));
	}
}


