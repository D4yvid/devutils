<?php

namespace devutils;

class Map
{
	/**
	 * @var Entry[] An array to store key-value pairs as Entry objects.
	 */
	private $entries;

	/**
	 * Map constructor.
	 *
	 * Initializes an empty map.
	 */
	public function __construct()
	{
		$this->entries = [];
	}

	/**
	 * Get an array of all values in the map.
	 *
	 * @return array An array containing all the values in the map.
	 */
	public function values(): array
	{
		return Stream::of($this->entries)
			->map(Mapper::entryValues())
			->collect(Collector::toArray());
	}

	/**
	 * Get an array of all keys in the map.
	 *
	 * @return array An array containing all the keys in the map.
	 */
	public function keys(): array
	{
		return Stream::of($this->entries)
			->map(Mapper::entryKeys())
			->collect(Collector::toArray());
	}

	/**
	 * Get an array of all entries in the map.
	 *
	 * @return array An array containing all the entries in the map.
	 */
	public function entries(): array
	{
		return $this->entries;
	}

	/**
	 * Put a key-value pair into the map.
	 *
	 * @param mixed $key The key for the entry.
	 * @param mixed $value The value associated with the key.
	 */
	public function put($key, $value)
	{
		$keyHash = is_integer($key) || is_string($key) ? $key : spl_object_hash($key);
		$this->entries[$keyHash] = new Entry($key, $value);
	}

	/**
	 * Get the value associated with a key in the map.
	 *
	 * @param mixed $key The key to look up in the map.
	 * @param mixed $default (optional) The default value to return if the key is not found. Default is null.
	 * @return mixed|null The value associated with the key, or the default value if the key is not found.
	 */
	public function get($key, $default = null)
	{
		$keyHash = is_integer($key) || is_string($key) ? $key : spl_object_hash($key);
		$entry = $this->entries[$keyHash];

		if ($entry) {
			return $entry->value();
		}

		return $default;
	}

	/**
	 * Get a stream of values from the map.
	 *
	 * @return Stream A stream of values from the map.
	 */
	public function stream(): Stream
	{
		return Stream::of($this->entries)
			->map(Mapper::entryValues());
	}

	/**
	 * Create a Map instance from an array of key-value pairs.
	 *
	 * @param array $entries An associative array of key-value pairs.
	 * @return Map A Map instance containing the provided key-value pairs.
	 */
	public static function fromEntries(array $entries)
	{
		$map = new Map();

		foreach ($entries as $k => $v) {
			$map->put($k, $v);
		}

		return $map;
	}
}
