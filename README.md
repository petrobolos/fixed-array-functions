# Fixed Array Functions

[![Latest Version on Packagist](https://img.shields.io/packagist/v/petrobolos/fixed-array-functions.svg?style=flat-square)](https://packagist.org/packages/petrobolos/fixed-array-functions)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/petrobolos/fixed-array-functions/run-tests?label=tests)](https://github.com/petrobolos/fixed-array-functions/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/petrobolos/fixed-array-functions/Check%20&%20fix%20styling?label=code%20style)](https://github.com/petrobolos/fixed-array-functions/actions?query=workflow%3A"Check+%26+fix+styling"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/petrobolos/fixed-array-functions.svg?style=flat-square)](https://packagist.org/packages/petrobolos/fixed-array-functions)

SplFixedArrays are an implementation of a traditional, bounded array in the PHP standard library. While they require
manual resizing, they're significantly faster than regular arrays or collections when working with large sets of data.

Working with large amounts of game data is increasingly common at Petrobolos, so this library was born to make things
easier and as efficient as possible.

## Full list of working methods:
| Method         | Description                                                                 |                                         Example |
|:---------------|:----------------------------------------------------------------------------|------------------------------------------------:|
| add            | Alias for push.                                                             |                `FixedArray::add('bacon', $arr)` |
| addFrom        | Add an array or collection of items to an array.                            |          `FixedArray::addFrom([1, 2, 3], $arr)` |
| contains       | Checks whether an item exists in a given array.                             |     `FixedArray::contains('needle', $haystack)` |
| count          | Returns the number of items in a given array.                               |                     `FixedArray::count($array)` |
| create         | Creates a new fixed array.                                                  |                        `FixedArray::create(10)` |
| first          | Returns the first element of the array.                                     |                     `FixedArray::first($array)` |
| fromArray      | Creates a new fixed array from a standard array.                            |              `FixedArray::fromArray([1, 2, 3])` |
| fromCollection | Creates a new fixed array from an Illuminate collection.                    | `FixedArray::fromCollection(collect([1, 2, 3])` |
| getSize        | Alias for count.                                                            |                   `FixedArray::getSize($array)` |
| isFixedArray   | Returns whether a given item is a fixed array.                              |     `FixedArray::isFixedArray($potentialArray)` |
| last           | Returns the last element in an array.                                       |                      `FixedArray::last($array)` |
| merge          | Merges given arrays, fixed arrays, or collections into a given fixed array. |   `FixedArray::merge($array, $array2, $array3)` |
| nullify        | Overwrite all elements in an array with `null`.                             |                   `FixedArray::nullify($array)` |
| offsetExists   | Returns whether a given array offset exists.                                |        `FixedArray::offsetExists(3, $haystack)` |
| offsetGet      | Retrieves the value at a given array offset.                                |           `FixedArray::offsetGet(3, $haystack)` |
| offsetNull     | Replaces the value at a given array offset with `null`.                     |          `FixedArray::offsetNull(3, $haystack)` |
| offsetSet      | Replaces the value at a given array offset with a provided value.           |   `FixedArray::offsetSet(3, $value, $haystack)` |
| pop            | Pops the latest value from the array.                                       |                       `FixedArray::pop($array)` |
| push           | Pushes a given value to the first available space on the array.             |              `FixedArray::push($value, $array)` |
| second         | Returns the second value from the array.                                    |                    `FixedArray::second($array)` |
| toArray        | Converts a fixed array into a standard array.                               |                   `FixedArray::toArray($array)` |
| toCollection   | Converts a fixed array into an Illuminate collection.                       |              `FixedArray::toCollection($array)` |

**NB:** Methods `current`, `key`, `next`, `rewind`, and `valid` are legacy alias operations for pointer-based array
methods and simply return `null` currently. They will be implemented in a future version.

## Requirements
Currently, requires PHP 8 or above, but work to backport support for 7.4 is in progress. This package is designed
for Laravel 8 and 9, but might play nicely with older versions, or with Lumen. Let us know.

## Installation

You can install the package via Composer:

```bash
composer require petrobolos/fixed-array-functions
```

## Usage

A fluent interface is planned for a future release - for now, `FixedArray` is available to be imported and used 
anywhere in your code, as its functions are static.

```php
use Petrobolos\FixedArray;

// Create a fixed array using the create method.
$arr = FixedArray::create();

// Easily push or pop items to and from arrays without worrying about indices.
FixedArray::push('apple', $arr);

// Easily and efficiently merge fixed arrays, regular arrays, and even Illuminate collections.
$everything = FixedArray::merge(
    $arr, 
    ['a', 'regular', 'array'], 
    collect(['and', 'an', 'illuminate', 'collection']),
);
```

## Testing

Tests are run using Pest. You can run the suite like so:

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

We welcome pull requests! Please ensure any functionality submitted has adequate test coverage.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
