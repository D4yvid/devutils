<?php	

namespace devutils;

final class Filter
{

	public static function equals($value) {
		return function ($item) use ($value) {
			return $item == $value;
		};
	}

	public static function greater($value) {
		return function ($item) use ($value) {
			return $item > $value;
		};
	}

	public static function less($value) {
		return function ($item) use ($value) {
			return $item < $value;
		};
	}

	public static function greaterOrEqual($value) {
		return function ($item) use ($value) {
			return $item >= $value;
		};
	}

	public static function lessOrEqual($value) {
		return function ($item) use ($value) {
			return $item <= $value;
		};
	}

	public static function different($value) {
		return function ($item) use ($value) {
			return $item != $value;
		};
	}
}
