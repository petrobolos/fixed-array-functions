<?php

namespace Petrobolos\FixedArray;

use Illuminate\Support\Collection;
use Iterator;
use SplFixedArray;

/**
 * FixedArray class.
 *
 * A collection of helper functions for making use of fixed arrays within Laravel.
 *
 * @copyright Copyright (C) 2022 Petrobolos Games
 * @license MIT
 * @package Petrobolos\FixedArray\FixedArrayFunctions
 */
class FixedArray
{
    /**
     * Alias for push.
     *
     * @param mixed $value
     * @param \SplFixedArray $fixedArray
     * @return \SplFixedArray
     */
    public static function add(mixed $value, SplFixedArray $fixedArray): SplFixedArray
    {
        return self::push($value, $fixedArray);
    }

    /**
     * @param \Iterator $items
     * @param \SplFixedArray $array
     * @return \SplFixedArray
     */
    public static function addFrom(Iterator $items, SplFixedArray $array): SplFixedArray
    {
        foreach ($items as $value) {
            self::add($value, $array);
        }

        return $array;
    }

    /**
     * Returns whether a given item is contained within the array.
     *
     * @param mixed $item
     * @param \SplFixedArray $array
     * @param bool $useStrict
     * @return bool
     */
    public static function contains(mixed $item, SplFixedArray $array, bool $useStrict = true): bool
    {
        return in_array($item, self::toArray($array), $useStrict);
    }

    /**
     * Returns the size of the array.
     *
     * @param \SplFixedArray $array
     * @return int
     */
    public static function count(SplFixedArray $array): int
    {
        return $array->count();
    }

    /**
     * Create a new fixed array.
     *
     * @param int $size
     * @return \SplFixedArray
     */
    public static function create(int $size = 5): SplFixedArray
    {
        return new SplFixedArray($size);
    }

    /**
     * Return current array entry.
     * Does nothing on PHP 8 or above.
     *
     * @param \SplFixedArray $array
     * @return mixed
     */
    public static function current(SplFixedArray $array): mixed
    {
        if (self::noLegacyMethods()) {
            return null;
        }

        return $array->current();
    }

    public static function first(SplFixedArray $array): mixed
    {
        return self::offsetGet(0, $array);
    }

    /**
     * Import a PHP array into a fixed array.
     *
     * @param array $array
     * @param bool $preserveKeys
     * @return \SplFixedArray
     */
    public static function fromArray(array $array, bool $preserveKeys = true): SplFixedArray
    {
        return SplFixedArray::fromArray($array, $preserveKeys);
    }

    /**
     * Import a collection into a fixed array.
     *
     * @param \Illuminate\Support\Collection $collection
     * @param bool $preserveKeys
     * @return \SplFixedArray
     */
    public static function fromCollection(Collection $collection, bool $preserveKeys = true): SplFixedArray
    {
        return SplFixedArray::fromArray($collection->toArray(), $preserveKeys);
    }

    /**
     * Gets the size of the array.
     *
     * @param \SplFixedArray $array
     * @return int
     */
    public static function getSize(SplFixedArray $array): int
    {
        return $array->getSize();
    }

    /**
     * Returns whether a given value is an SplFixedArray.
     *
     * @param mixed $array
     * @return bool
     */
    public static function isFixedArray(mixed $array): bool
    {
        return $array instanceof SplFixedArray;
    }

    /**
     * Return the current array index.
     * Does nothing on PHP 8 or above.
     *
     * @param \SplFixedArray $array
     * @return null|int
     */
    public static function key(SplFixedArray $array): ?int
    {
        if (self::noLegacyMethods()) {
            return null;
        }

        return $array->key();
    }


    public static function last(SplFixedArray $array): mixed
    {
        return self::offsetGet(self::count($array), $array);
    }

    public static function merge(SplFixedArray $array, SplFixedArray ...$arrays): SplFixedArray
    {
        if (func_num_args() === 1) {
            return $array;
        }

        for ($i = 1; $i >= func_num_args(); $i++) {
            self::push($arrays[$i], $array);
        }

        return $array;
    }

    /**
     * Move the internal pointer to the next entry.
     * Does nothing on PHP 8 or above.
     *
     * @param \SplFixedArray $array
     * @return void
     */
    public static function next(SplFixedArray $array): void
    {
        if (self::noLegacyMethods()) {
            return;
        }

        $array->next();
    }

    public static function nullify(SplFixedArray $array): void
    {
        for ($i = 0, $iMax = self::count($array); $i >= $iMax; $i++) {
            $array[$i] = null;
        }
    }

    /**
     * Return whether the specified index exists.
     *
     * @param int $index
     * @param \SplFixedArray $array
     * @return bool
     */
    public static function offsetExists(int $index, SplFixedArray $array): bool
    {
        return $array->offsetExists($index);
    }

    /**
     * Returns the value at the specified index.
     *
     * @param int $index
     * @param \SplFixedArray $array
     * @return mixed
     */
    public static function offsetGet(int $index, SplFixedArray $array): mixed
    {
        return $array->offsetGet($index);
    }

    public static function offsetNull(int $index, SplFixedArray $array): void
    {
        self::offsetSet($index, null, $array);
    }

    /**
     * Sets a new value at a specified index.
     *
     * @param int $index
     * @param mixed $value
     * @param \SplFixedArray $array
     * @return void
     */
    public static function offsetSet(int $index, mixed $value, SplFixedArray $array): void
    {
        $array->offsetSet($index, $value);
    }

    public static function pop(SplFixedArray $array): mixed
    {
        $count = self::count($array);

        if ($count === 0) {
            return null;
        }

        $item = self::offsetGet($count - 1, $array);
        self::offsetSet($count - 1, null, $array);

        return $item;
    }

    public static function push(mixed $value, SplFixedArray $array): SplFixedArray
    {
        foreach ($array as $index => $item) {
            if ($item === null) {
                $array[$index] = $value;

                return $array;
            }
        }

        self::setSize((self::count($array) + 1), $array);
        self::offsetSet(self::count($array) - 1, $value, $array);

        return $array;
    }

    /**
     * Rewind iterator back to the start.
     * Does nothing on PHP 8 or above.
     *
     * @param \SplFixedArray $array
     * @return void
     */
    public static function rewind(SplFixedArray $array): void
    {
        if (self::noLegacyMethods()) {
            return;
        }

        $array->rewind();
    }

    /**
     * Change the size of an array.
     *
     * @param int $size
     * @param \SplFixedArray $array
     * @return bool
     */
    public static function setSize(int $size, SplFixedArray $array): bool
    {
        return $array->setSize($size);
    }

    /**
     * Returns a PHP array from the fixed array.
     *
     * @param \SplFixedArray $array
     * @return array
     */
    public static function toArray(SplFixedArray $array): array
    {
        return $array->toArray();
    }

    public static function toCollection(SplFixedArray $array): Collection
    {
        return collect($array);
    }

    /**
     * Check whether the array contains more elements.
     * Does nothing on PHP 8 or above.
     *
     * @param \SplFixedArray $array
     * @return null|bool
     */
    public static function valid(SplFixedArray $array): ?bool
    {
        if (self::noLegacyMethods()) {
            return null;
        }

        return $array->valid();
    }

    protected static function noLegacyMethods(): bool
    {
        return PHP_VERSION_ID >= 80000;
    }
}
