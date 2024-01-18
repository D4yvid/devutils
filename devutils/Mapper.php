<?php

namespace devutils;

/**
 * Class Mapper
 *
 * Provides a set of static methods to create mapping functions for use with streams.
 *
 * @package devutils
 */
class Mapper
{
	/**
	 * Mapping function that returns the input value.
	 *
	 * @return \Closure A mapping function that returns the input value.
	 */
	public static function values()
	{
		return function ($value) {
			return $value;
		};
	}

	/**
	 * Mapping function that returns the input key.
	 *
	 * @return \Closure A mapping function that returns the input key.
	 */
	public static function keys()
	{
		return function ($_, $key) {
			return $key;
		};
	}

	/**
	 * Mapping function that extracts the key from a Map entry.
	 *
	 * @return \Closure A mapping function that extracts the key from a Map entry.
	 */
	public static function entryKeys()
	{
		return function ($entry) {
			/** @var Entry $entry */
			return $entry->key();
		};
	}

	/**
	 * Mapping function that extracts the value from a Map entry.
	 *
	 * @return \Closure A mapping function that extracts the value from a Map entry.
	 */
	public static function entryValues()
	{
		return function ($entry) {
			/** @var Entry $entry */
			return $entry->value();
		};
	}

	/**
	 * Mapping function that calls a specified method on the input item.
	 *
	 * @param string $functionName The name of the method to call.
	 * @param mixed  ...$args      Additional arguments to pass to the method.
	 * @return \Closure A mapping function that calls a specified method on the input item.
	 */
	public static function callOnValue(string $functionName, ...$args)
	{
		return function ($item) use ($functionName, $args) {
			return $item->{$functionName}(...$args);
		};
	}

	/**
	 * Mapping function that calls a specified function with the input item.
	 *
	 * @param callable $function The function to call.
	 * @param mixed    ...$args   Additional arguments to pass to the function.
	 * @return \Closure A mapping function that calls a specified function with the input item.
	 */
	public static function callWithValue($function, ...$args)
	{
		return function ($item) use ($function, $args) {
			return $function($item, ...$args);
		};
	}

	/**
	 * Mapping function that converts a key-value pair into a Map entry.
	 *
	 * @return \Closure A mapping function that converts a key-value pair into a Map entry.
	 */
	public static function asEntries()
	{
		return function ($v, $k) {
			return new Entry($k, $v);
		};
	}

	/**
	 * Mapping function that extracts a specific key from an associative array.
	 *
	 * @param string $key The key to extract from the array.
	 * @return \Closure A mapping function that extracts a specific key from an associative array.
	 */
	public static function itemKey($key)
	{
		return function ($v) use ($key) {
			return $v[$key];
		};
	}
}
