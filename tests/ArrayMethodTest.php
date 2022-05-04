<?php

use Petrobolos\FixedArray\FixedArray;

test('contains returns true if a given item is contained within the array', function () {
    $item = 'test';
    $array = FixedArray::push($item, FixedArray::create());

    /** @phpstan-ignore-next-line */
    $this->assertTrue(FixedArray::contains($item, $array));

    /** @phpstan-ignore-next-line */
    $this->assertFalse(FixedArray::contains('not in the array', $array));
});

test('create returns a new spl fixed array of a given size', function () {
    $count = 10;
    $array = FixedArray::create($count);

    /** @phpstan-ignore-next-line */
    $this->assertTrue(FixedArray::isFixedArray($array));

    /** @phpstan-ignore-next-line */
    $this->assertEquals($count, FixedArray::count($array));
});

test('first returns the first element of the array', function () {
    $array = new SplFixedArray(2);
    $test = 'test';

    FixedArray::push($test, $array);

    /** @phpstan-ignore-next-line */
    $this->assertEquals($test, FixedArray::first($array));
});


test('from collection creates a fixed array from a collection', function () {
    $collection = collect()->push('item');
    $convertedArray = FixedArray::fromCollection($collection);

    /** @phpstan-ignore-next-line */
    $this->assertEquals($collection->count(), FixedArray::count($convertedArray));

    /** @phpstan-ignore-next-line */
    $this->assertEquals($collection->first(), FixedArray::first($convertedArray));
});

test('is fixed array indicates whether a given variable is an spl fixed array', function () {
    $fixedArray = FixedArray::create();
    $standardArray = [];

    /** @phpstan-ignore-next-line */
    $this->assertTrue(FixedArray::isFixedArray($fixedArray));

    /** @phpstan-ignore-next-line */
    $this->assertFalse(FixedArray::isFixedArray($standardArray));
});
