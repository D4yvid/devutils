<?php

namespace devutils;

/**
 * Class Collector
 *
 * Provides a set of static methods to create collectors for stream terminal operations.
 *
 * @package devutils
 */
final class Collector
{
	/**
	 * Collector that transforms the input array into a plain array.
	 *
	 * @return \Closure A collector function that returns the input array.
	 */
	public static function toArray()
	{
		return function (array $array) {
			return $array;
		};
	}

	/**
	 * Collector that transforms the input array into a Map instance.
	 *
	 * @return \Closure A collector function that creates a Map instance from the input array.
	 */
	public static function toMap()
	{
		return function (array $entries) {
			return Map::fromEntries($entries);
		};
	}
}
