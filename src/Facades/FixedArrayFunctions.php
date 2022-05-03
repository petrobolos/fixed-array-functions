<?php

namespace Petrobolos\FixedArray\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Petrobolos\FixedArray\FixedArrayFunctions
 */
class FixedArrayFunctions extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'fixed-array-functions';
    }
}
