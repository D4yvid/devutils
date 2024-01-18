<?php

namespace devutils;

use Closure;

/**
 * Class Stream
 *
 * Represents a stream of elements providing functional-style operations on arrays.
 *
 * @package devutils
 */
class Stream
{
	/**
	 * @var array The underlying array.
	 */
	private $array;

	/**
	 * Stream constructor.
	 *
	 * @param array &$array The array to be used for stream operations.
	 */
	private function __construct(array &$array)
	{
		$this->array = &$array;
	}

	/**
	 * Performs an action for each element of this stream.
	 *
	 * @param Closure $callback The action to be performed for each element.
	 * @return Stream This stream for chaining operations.
	 */
	public function forEach(Closure $callback): self
	{
		foreach ($this->array as $k => $v) {
			$callback($v, $k);
		}

		return $this;
	}

	/**
	 * Filters elements of this stream based on a given condition.
	 *
	 * @param Closure $condition The condition to filter elements.
	 * @return Stream This stream for chaining operations.
	 */
	public function filter(Closure $condition): self
	{
		foreach ($this->array as $k => $v) {
			if ($condition($v, $k)) {
				continue;
			}

			unset($this->array[$k]);
		}

		return $this;
	}

	/**
	 * Transforms each element of this stream using a given function.
	 *
	 * @param Closure $transform The function to transform elements.
	 * @return Stream This stream for chaining operations.
	 */
	public function map(Closure $transform): self
	{
		foreach ($this->array as $k => $v) {
			$newValue = $transform($v, $k);

			$this->array[$k] = $newValue;
		}

		return $this;
	}

	/**
	 * Transforms keys of this stream using a given function.
	 *
	 * @param Closure $transform The function to transform keys.
	 * @return Stream This stream for chaining operations.
	 */
	public function mapKeys(Closure $transform): self
	{
		foreach ($this->array as $k => $v) {
			$newKey = $transform($v, $k);

			unset($this->array[$k]);

			$this->array[$newKey] = $v;
		}

		return $this;
	}

	/**
	 * Limits the number of elements in this stream.
	 *
	 * @param int $elements The maximum number of elements.
	 * @return Stream This stream for chaining operations.
	 */
	public function limit(int $elements): self
	{
		array_splice($this->array, $elements);

		return $this;
	}

	/**
	 * Skips a specified number of elements from the beginning of this stream.
	 *
	 * @param int $elements The number of elements to skip.
	 * @return Stream This stream for chaining operations.
	 */
	public function skip(int $elements): self
	{
		array_splice($this->array, 0, $elements);

		return $this;
	}

	/**
	 * Converts this stream to a stream of values.
	 *
	 * @return Stream This stream for chaining operations.
	 */
	public function values(): self
	{
		$this->array = array_values($this->array);

		return $this;
	}

	/**
	 * Converts this stream to a stream of keys.
	 *
	 * @return Stream This stream for chaining operations.
	 */
	public function keys(): self
	{
		$this->array = array_keys($this->array);

		return $this;
	}

	/**
	 * Returns an Optional containing the first element of this stream, if present.
	 *
	 * @return Optional An Optional containing the first element of this stream, or an empty Optional if the stream is empty.
	 */
	public function first(): Optional
	{
		if ($this->size() != 0) {
			$firstKey = array_keys($this->array)[0];

			return Optional::of($this->array[$firstKey]);
		}

		return Optional::emptyValue();
	}

	/**
	 * Returns an Optional containing the last element of this stream, if present.
	 *
	 * @return Optional An Optional containing the last element of this stream, or an empty Optional if the stream is empty.
	 */
	public function last(): Optional
	{
		if ($this->size() != 0) {
			$keys = array_keys($this->array);
			$lastKey = array_pop($keys);

			return Optional::of($this->array[$lastKey]);
		}

		return Optional::emptyValue();
	}

	/**
	 * Collects the elements of this stream into an array using a provided collector function.
	 *
	 * @param Closure $collector The collector function to use for collecting elements.
	 * @return array The result of collecting elements using the provided collector function.
	 */
	public function collect(Closure $collector): array
	{
		return $collector($this->array);
	}

	/**
	 * Returns the number of elements in this stream.
	 *
	 * @return int The number of elements in this stream.
	 */
	public function size(): int
	{
		return sizeof($this->array);
	}

	/**
	 * Creates a Stream instance from the given array.
	 *
	 * @param array $array The array to use for stream operations.
	 * @return Stream A Stream instance initialized with the provided array.
	 */
	public static function of(array $array)
	{
		return new Stream($array);
	}

	/**
	 * Creates a Stream instance from the given reference to an array.
	 *
	 * @param array &$array The reference to the array to use for stream operations.
	 * @return Stream A Stream instance initialized with the provided array reference.
	 */
	public static function ofRef(array &$array)
	{
		return new Stream($array);
	}
}
