<?php

namespace Petrobolos\FixedArray\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Petrobolos\FixedArray\FixedArrayFunctions
 */
class FixedArrayFunctions extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'fixed-array-functions';
    }
}
