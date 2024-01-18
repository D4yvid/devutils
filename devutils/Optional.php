<?php

namespace devutils;

use devutils\exception\UnwrapException;

/**
 * Class Optional
 *
 * Represents an optional value that may or may not be present.
 *
 * @package devutils
 */
class Optional
{
	/**
	 * @var mixed The wrapped value.
	 */
	private $value;

	/**
	 * @var bool Indicates whether the value is empty.
	 */
	private $empty;

	/**
	 * Optional constructor.
	 *
	 * @param mixed $value The wrapped value.
	 * @param bool $empty Indicates whether the value is empty.
	 */
	private function __construct($value, bool $empty)
	{
		$this->value = $value;
		$this->empty = $empty;
	}

	/**
	 * Unwraps and returns the value if present; otherwise, throws an UnwrapException.
	 *
	 * @return mixed The unwrapped value.
	 * @throws UnwrapException If the value is empty.
	 */
	public function unwrap()
	{
		if ($this->empty()) {
			throw new UnwrapException("Tried to unwrap an empty value");
		}

		return $this->value;
	}

	/**
	 * Returns the wrapped value if present; otherwise, returns the provided default value.
	 *
	 * @param mixed $value The default value to return if the Optional is empty.
	 * @return mixed The wrapped value or the default value.
	 */
	public function or($value)
	{
		return $this->empty() ? $value : $this->value;
	}

	/**
	 * Checks if the Optional is empty.
	 *
	 * @return bool True if the Optional is empty; otherwise, false.
	 */
	public function empty(): bool
	{
		return $this->empty;
	}

	/**
	 * Creates an empty Optional instance.
	 *
	 * @return Optional An empty Optional instance.
	 */
	public static function emptyValue(): Optional
	{
		return new Optional(null, true);
	}

	/**
	 * Creates an Optional instance with the provided value.
	 *
	 * @param mixed $value The value to wrap in the Optional.
	 * @return Optional An Optional instance containing the provided value.
	 */
	public static function of($value): Optional
	{
		return new Optional($value, false);
	}
}
