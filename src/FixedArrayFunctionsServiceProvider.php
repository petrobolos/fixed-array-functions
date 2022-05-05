<?php

namespace Petrobolos\FixedArray;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

/**
 * FixedArrayFunctionsServiceProvider class.
 *
 * @copyright Copyright (C) 2022 Petrobolos Games
 * @license MIT
 * @package Petrobolos\FixedArray
 */
class FixedArrayFunctionsServiceProvider extends PackageServiceProvider
{
    /**
     * Configures the package for usage.
     *
     * @param \Spatie\LaravelPackageTools\Package $package
     * @return void
     */
    public function configurePackage(Package $package): void
    {
        $package->name('fixed-array-functions');
    }
}
