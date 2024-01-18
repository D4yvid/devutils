<?php

namespace devutils;

/**
 * Class Filter
 *
 * Provides a set of static methods to create filter functions for various comparison operations.
 *
 * @package devutils
 */
final class Filter
{
	/**
	 * Creates a filter function that checks if the given value is equal to the item.
	 *
	 * @param mixed $value The value to compare against.
	 * @return \Closure A filter function.
	 */
	public static function equals($value)
	{
		return function ($item) use ($value) {
			return $item == $value;
		};
	}

	/**
	 * Creates a filter function that checks if the item is greater than the given value.
	 *
	 * @param mixed $value The value to compare against.
	 * @return \Closure A filter function.
	 */
	public static function greater($value)
	{
		return function ($item) use ($value) {
			return $item > $value;
		};
	}

	/**
	 * Creates a filter function that checks if the item is less than the given value.
	 *
	 * @param mixed $value The value to compare against.
	 * @return \Closure A filter function.
	 */
	public static function less($value)
	{
		return function ($item) use ($value) {
			return $item < $value;
		};
	}

	/**
	 * Creates a filter function that checks if the item is greater than or equal to the given value.
	 *
	 * @param mixed $value The value to compare against.
	 * @return \Closure A filter function.
	 */
	public static function greaterOrEqual($value)
	{
		return function ($item) use ($value) {
			return $item >= $value;
		};
	}

	/**
	 * Creates a filter function that checks if the item is less than or equal to the given value.
	 *
	 * @param mixed $value The value to compare against.
	 * @return \Closure A filter function.
	 */
	public static function lessOrEqual($value)
	{
		return function ($item) use ($value) {
			return $item <= $value;
		};
	}

	/**
	 * Creates a filter function that checks if the item is different from the given value.
	 *
	 * @param mixed $value The value to compare against.
	 * @return \Closure A filter function.
	 */
	public static function different($value)
	{
		return function ($item) use ($value) {
			return $item != $value;
		};
	}

	/**
	 * Creates a filter function that checks if the item is an array and contains the given value.
	 *
	 * @param mixed $value The value to check for in the array.
	 * @return \Closure A filter function.
	 */
	public static function arrayHasValue($value)
	{
		return function ($item) use ($value) {
			return in_array($value, $item);
		};
	}

	/**
	 * Creates a filter function that checks if the item is an array and has the given key.
	 *
	 * @param mixed $key The key to check for in the array.
	 * @return \Closure A filter function.
	 */
	public static function arrayHasKey($key)
	{
		return function ($item) use ($key) {
			return isset($item[$key]);
		};
	}
}
