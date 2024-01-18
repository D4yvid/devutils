<?php

namespace devutils;

class Mapper
{

	public static function values() {
		return function ($value) {
			return $value;
		};
	}

	public static function keys() {
		return function ($_, $key) {
			return $key;
		};
	}

	public static function entryKeys() {
		return function ($entry) {
			/** @var Entry $entry */

			return $entry->key();
		};
	}

	public static function entryValues() {
		return function ($entry) {
			/** @var Entry $entry */

			return $entry->value();
		};
	}

	public static function callOnValue(string $functionName, ...$args) {
		return function ($item) use ($functionName, $args) {
			return $item->{$functionName}(...$args);
		};
	}

	public static function callWithValue($function, ...$args) {
		return function ($item) use ($function, $args) {
			return $function($item, ...$args);
		};
	}

	public static function asEntries() {
		return function ($v, $k) {
			return new Entry($k, $v);
		};
	}

	public static function itemKey($key) {
		return function ($v) use ($key) {
			return $v[$key];
		};
	}

}
