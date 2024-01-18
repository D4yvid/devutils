<?php

namespace devutils;

/**
 * Class Entry
 *
 * Represents a key-value pair entry for use in a Map.
 *
 * @package devutils
 */
class Entry
{
	/**
	 * @var mixed The key of the entry.
	 */
	private $key;

	/**
	 * @var mixed The value associated with the key.
	 */
	private $value;

	/**
	 * Entry constructor.
	 *
	 * @param mixed $key The key of the entry.
	 * @param mixed $value The value associated with the key.
	 */
	public function __construct($key, $value)
	{
		$this->key = $key;
		$this->value = $value;
	}

	/**
	 * Get the key of the entry.
	 *
	 * @return mixed The key of the entry.
	 */
	public function key()
	{
		return $this->key;
	}

	/**
	 * Get the value associated with the key.
	 *
	 * @return mixed The value associated with the key.
	 */
	public function value()
	{
		return $this->value;
	}
}
