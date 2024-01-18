## DevUtils - A simple utility library for PHP development

This library adds features that doesn't exist in PHP, or exist but they're not "good" using

##### [Documentation](doc/)

There is some examples:

### Array filtering

#### Normal PHP:
```php
<?php

$array = [1, 2, 3, 4, 5];

$filtered = array_filter($array, function ($item) {
    return $item < 3;
});

var_dump($filtered); // [1, 2]
```

#### DevUtils (without references):
```php
<?php

use devutils\Stream;
use devutils\Filter;
use devutils\Collectors;

$array = [1, 2, 3, 4, 5];

$filtered = Stream::of($array)
    ->filter(Filter::lessThan(3))
    ->collect(Collectors::toArray());

var_dump($filtered); // [1, 2]
```

#### DevUtils (with references):
```php
<?php

use devutils\Stream;
use devutils\Filter;

$array = [1, 2, 3, 4, 5];

Stream::ofRef($array)
    ->filter(Filter::lessThan(3));

// Because it's using the reference for the array, not the array itself, it will modify
// directly in the input
var_dump($array); // [1, 2]
```

### Filtering and mapping items to specific values

#### Normal PHP
```php
<?php

$games = [
    ["id" => mt_rand(), "players" => ["foo", "bar", "baz"]],
    ["id" => mt_rand(), "players" => ["buzz", "qux", "fu"]]
];

$gameOfBar = array_map(function ($item) {
    return $item["id"];
}, array_filter($games, function ($item) {
    return in_array("bar", $item["players"]);
})[0] ?? null;
```

#### DevUtils:
```php
<?php

use devutils\Stream;
use devutils\Filter;

$games = [
    ["id" => mt_rand(), "players" => ["foo", "bar", "baz"]],
    ["id" => mt_rand(), "players" => ["buzz", "qux", "fu"]]
];

$gameOfBar = Stream::of($games)
    ->filter(function ($i) { return in_array("bar", $i["players"]); })
    ->map(Mapper::itemKey("id"))
    ->first()
    ->orElse(null);
```
