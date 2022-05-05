<?php

use Petrobolos\FixedArray\FixedArray;

test('add from merges the contents of a given iterator into a fixed array', function () {
   $array = [1];
   $collection = collect(2);
   $fixedArray = FixedArray::push(3, FixedArray::create());

   $combinedArray = FixedArray::create();
   FixedArray::addFrom($array, $combinedArray);
   FixedArray::addFrom($collection, $combinedArray);
   FixedArray::addFrom($fixedArray, $combinedArray);

    /** @phpstan-ignore-next-line */
   $this->assertTrue(FixedArray::contains(1, $combinedArray));

    /** @phpstan-ignore-next-line */
   $this->assertTrue(FixedArray::contains(2, $combinedArray));

    /** @phpstan-ignore-next-line */
   $this->assertTrue(FixedArray::contains(3, $combinedArray));
});

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

test('last retrieves the last value from an array', function () {
    $array = FixedArray::fromArray([1, 2, 3, 4, 5]);

    /** @phpstan-ignore-next-line */
    $this->assertEquals(5, FixedArray::last($array));
});

test('merge will merge together multiple array-like items into a single fixed array', function () {
    $fixedArray = FixedArray::fromArray([1]);
    $collection = collect(2);
    $array = [3];
    $anotherFixedArray = FixedArray::fromArray([4]);

    $newArray = FixedArray::merge($fixedArray, $collection, $array, $anotherFixedArray);

    /** @phpstan-ignore-next-line */
    $this->assertTrue(FixedArray::contains(1, $newArray));

    /** @phpstan-ignore-next-line */
    $this->assertTrue(FixedArray::contains(2, $newArray));

    /** @phpstan-ignore-next-line */
    $this->assertTrue(FixedArray::contains(3, $newArray));

    /** @phpstan-ignore-next-line */
    $this->assertTrue(FixedArray::contains(4, $newArray));
});

test('nullify blanks each element of a fixed array to a null value', function () {
    $array = FixedArray::fromArray([1, 2, 3, 4, 5]);

    FixedArray::nullify($array);

    foreach ($array as $item) {
        /** @phpstan-ignore-next-line */
        $this->assertNull($item);
    }
});

test('offset null replaces a given value at a given offset with null', function () {
   $array = FixedArray::fromArray([1, 2]);

   FixedArray::offsetNull(1, $array);

    /** @phpstan-ignore-next-line */
   $this->assertEquals(1, FixedArray::first($array));

    /** @phpstan-ignore-next-line */
   $this->assertNull(FixedArray::second($array));
});

test('pop removes the latest value from an array and nullifies it in the process', function () {
   $array = FixedArray::fromArray([1, 2, 3]);

   $value = FixedArray::pop($array);

    /** @phpstan-ignore-next-line */
   $this->assertSame(3, $value);

    /** @phpstan-ignore-next-line */
   $this->assertNull(FixedArray::last($array));
});

test('push sets a value to the first available space on an empty array', function () {
   $array = FixedArray::create();
   $expected = 'test';

   FixedArray::push($expected, $array);

    /** @phpstan-ignore-next-line */
   $this->assertEquals($expected, FixedArray::first($array));
});

test('push will increase the size of an array by one if more space is needed to push an element to it', function () {
   $array = FixedArray::fromArray([1, 2, 3, 4, 5]);

   $expectedSizeAfterResize = 6;
   $expected = 6;

   FixedArray::push($expected, $array);
    /** @phpstan-ignore-next-line */
   $this->assertEquals($expectedSizeAfterResize, FixedArray::count($array));

    /** @phpstan-ignore-next-line */
   $this->assertEquals($expected, FixedArray::last($array));
});

test('push will occupy a null value in the middle of the array if it is the first available element', function () {
   $array = FixedArray::fromArray([1, null, 2, 3, 4, 5, 6]);
   $expected = 'test';

   FixedArray::push($expected, $array);

    /** @phpstan-ignore-next-line */
   $this->assertEquals($expected, FixedArray::second($array));
});

test('to collection produces a collection from a given fixed array', function () {
    $collection = collect([1, 2, 3]);
    $fixedArray = FixedArray::fromCollection($collection);
    $newCollection = FixedArray::toCollection($fixedArray);

    /** @phpstan-ignore-next-line */
    $this->assertEquals($collection, $newCollection);
});
