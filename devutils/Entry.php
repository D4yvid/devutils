<?php

namespace devutils;

class Entry
{

	/** @var mixed The key for this entry */
	private $key;

	/** @var mixed The value of this entry */
	private $value;

	public function __construct($key, $value)
	{
		$this->key = $key;
		$this->value = $value;
	}

	public function key()
	{
		return $this->key;
	}

	public function value()
	{
		return $this->value;
	}

}
