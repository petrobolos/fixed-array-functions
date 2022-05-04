<?php

use Petrobolos\FixedArray\FixedArray;

const LEGACY_SKIP_MSG = 'This is a legacy method that does nothing on PHP 8 or above.';

test('count provides the size of the fixed array', function () {
    $count = 5;
    $array = new SplFixedArray($count);

    /** @phpstan-ignore-next-line */
    $this->assertEquals($count, FixedArray::count($array));
});

test('current returns the current array entry', function () {
    if (PHP_VERSION_ID >= 80000) {
        /** @phpstan-ignore-next-line */
        $this->markTestSkipped(LEGACY_SKIP_MSG);
    }

    $test = 'test';
    $array = new SplFixedArray(1);
    $array[0] = 'test';

    /** @phpstan-ignore-next-line */
    $this->assertEquals($test, FixedArray::current($array));
});

test('from array creates a fixed array from a regular array', function () {
    $array = ['test'];
    $count = count($array);
    $convertedArray = FixedArray::fromArray($array);

    /** @phpstan-ignore-next-line */
    $this->assertEquals($count, FixedArray::count($convertedArray));

    /** @phpstan-ignore-next-line */
    $this->assertSame(head($array), FixedArray::first($convertedArray));
});

test('get size returns the size of the array', function () {
    $count = 5;
    $array = new SplFixedArray($count);

    /** @phpstan-ignore-next-line */
    $this->assertEquals($count, FixedArray::getSize($array));
});

test('key returns the current array index', function () {
    if (PHP_VERSION_ID >= 80000) {
        /** @phpstan-ignore-next-line */
        $this->markTestSkipped(LEGACY_SKIP_MSG);
    }

    $array = new SplFixedArray(5);

    /** @phpstan-ignore-next-line */
    $this->assertEquals(0, FixedArray::key($array));
});

test('next advances the internal pointer', function () {
    if (PHP_VERSION_ID >= 80000) {
        /** @phpstan-ignore-next-line */
        $this->markTestSkipped(LEGACY_SKIP_MSG);
    }

    $array = new SplFixedArray(5);
    FixedArray::next($array);

    /** @phpstan-ignore-next-line */
    $this->assertSame(1, FixedArray::key($array));
});

test('offset exists returns whether a given index is occupied', function () {
    $array = new SplFixedArray(5);
    FixedArray::offsetSet(4, 'test', $array);

    /** @phpstan-ignore-next-line */
    $this->assertTrue(FixedArray::offsetExists(4, $array));
});

test('offset get returns whatever is stored in a given index', function () {
    $array = new SplFixedArray(5);
    $test = 'test';
    $index = 3;

    FixedArray::offsetSet($index, $test, $array);

    /** @phpstan-ignore-next-line */
    $this->assertEquals($test, FixedArray::offsetGet($index, $array));

    /** @phpstan-ignore-next-line */
    $this->assertNull(FixedArray::offsetGet(0, $array));
});

test('offset set pushes a given value to a chosen index', function () {
    $array = new SplFixedArray(5);
    $test = 'test';
    $index = 4;

    FixedArray::offsetSet($index, $test, $array);

    /** @phpstan-ignore-next-line */
    $this->assertSame($test, FixedArray::offsetGet($index, $array));
});

test('rewind resets the internal pointer', function () {
    if (PHP_VERSION_ID >= 80000) {
        /** @phpstan-ignore-next-line */
        $this->markTestSkipped(LEGACY_SKIP_MSG);
    }

    $array = new SplFixedArray(5);
    FixedArray::next($array);
    FixedArray::rewind($array);

    /** @phpstan-ignore-next-line */
    $this->assertSame(0, FixedArray::key($array));
});

test('set size increases the size of a fixed array', function () {
    $originalSize = 5;
    $array = new SplFixedArray($originalSize);

    /** @phpstan-ignore-next-line */
    $this->assertEquals($originalSize, FixedArray::getSize($array));

    $newSize = 10;
    FixedArray::setSize($newSize, $array);

    /** @phpstan-ignore-next-line */
    $this->assertEquals($newSize, FixedArray::getSize($array));
});

test('to array converts the fixed array into a standard php array', function () {
    $array = new SplFixedArray(5);
    $test = 'test';
    FixedArray::push('test', $array);

    $convertedArray = FixedArray::toArray($array);

    /** @phpstan-ignore-next-line */
    $this->assertIsArray($convertedArray);

    /** @phpstan-ignore-next-line */
    $this->assertEquals($test, head($convertedArray));
});

test('valid determines if there are any more remaining elements', function () {
    if (PHP_VERSION_ID >= 80000) {
        /** @phpstan-ignore-next-line */
        $this->markTestSkipped(LEGACY_SKIP_MSG);
    }

    $array = new SplFixedArray(1);
    FixedArray::next($array);

    /** @phpstan-ignore-next-line */
    $this->assertFalse(FixedArray::valid($array));
});
