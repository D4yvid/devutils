<?php

namespace devutils;

use Closure;

class Stream
{

	/** @var &mixed[] The array what we're working in */
	private $array;
	
	private function __construct(array &$array)
	{
		$this->array = &$array;
	}

	public function forEach(Closure $callback): self
	{
		foreach ($this->array as $k => $v) {
			$callback($v, $k);
		}

		return $this;
	}

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

	public function map(Closure $transform): self
	{
		foreach ($this->array as $k => $v) {
			$newValue = $transform($v, $k);

			$this->array[$k] = $newValue;
		}

		return $this;
	}

	public function mapKeys(Closure $transform): self
	{
		foreach ($this->array as $k => $v) {
			$newKey = $transform($v, $k);

			unset($this->array[$k]);

			$this->array[$newKey] = $v;
		}

		return $this;
	}

	public function limit(int $elements): self
	{
		array_splice($this->array, $elements);

		return $this;
	}

	public function skip(int $elements): self
	{
		array_splice($this->array, 0, $elements);

		return $this;
	}

	public function values(): self
	{
		$this->array = array_values($this->array);

		return $this;
	}

	public function keys(): self
	{
		$this->array = array_keys($this->array);

		return $this;
	}

	public function first(): Optional
	{
		if ($this->size() != 0) {
			$firstKey = array_keys($this->array)[0];

			return Optional::of($this->array[$firstKey]);
		}

		return Optional::emptyValue();
	}

	public function last(): Optional
	{
		if ($this->size() != 0) {
			$keys = array_keys($this->array);
			$lastKey = array_pop($keys);

			return Optional::of($this->array[$lastKey]);
		}

		return Optional::emptyValue();
	}

	public function collect(Closure $collector): array
	{
		return $collector($this->array);
	}

	public function size(): int
	{
		return sizeof($this->array);
	}

	public static function of(array $array)
	{
		return new Stream($array);
	}

	public static function ofRef(array &$array)
	{
		return new Stream($array);
	}
}

