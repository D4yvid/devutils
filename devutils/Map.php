<?php

namespace devutils;

class Map
{

	private $entries;

	public function __construct()
	{
		$this->entries = [];
	}

	public function values(): array
	{
		return Stream::of($this->entries)
			->map(Mapper::entryValues())
			->collect(Collector::toArray());
	}

	public function keys(): array 
	{
		return Stream::of($this->entries)
			->map(Mapper::entryKeys())
			->collect(Collector::toArray());
	}

	public function entries(): array
	{
		return $this->entries;
	}

	public function put($key, $value)
	{
		$keyHash = is_integer($key) || is_string($key) ? $key : spl_object_hash($key);

		$this->entries[$keyHash] = new Entry($key, $value);
	}

	public function get($key, $default = null)
	{
		$keyHash = is_integer($key) || is_string($key) ? $key : spl_object_hash($key);
		$entry = $this->entries[$keyHash];

		if ($entry)
			return $entry->value();

		return $default;
	}

	public function stream(): Stream
	{
		return Stream::of($this->entries)
			->map(Mapper::entryValues());
	}

	public static function fromEntries(array $entries)
	{
		$map = new Map();

		foreach ($entries as $k => $v)
			$map->put($k, $v);

		return $map;
	}

}

