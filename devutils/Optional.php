<?php

namespace devutils;

use devutils\exception\UnwrapException;

class Optional
{

	/** @var The value stored in the optional if there is one */
	private $value;

	/** @var bool If the optional is empty */
	private $empty;

	private function __construct($value, bool $empty)
	{
		$this->value = $value;
		$this->empty = $empty;
	}

	public function unwrap()
	{
		if ($this->empty())
		{
			throw new UnwrapException("tried to unwrap a empty value");
		}

		return $this->value;
	}

	public function or($value)
	{
		return $this->empty() ? $value : $this->value;
	}

	public function empty(): bool
	{
		return $this->empty;
	}

	public static function emptyValue(): Optional
	{
		return new Optional(null, true);
	}

	public static function of($value): Optional
	{
		return new Optional($value, false);
	}

}
