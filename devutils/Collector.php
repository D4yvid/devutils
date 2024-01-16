<?php

namespace devutils;

final class Collector
{

	public static function toArray() {
		return function (array $array) { return $array; };
	}

	public static function toMap() {
		return function (array $entries) {
			return Map::fromEntries($entries);
		};
	}

}
