<?php

namespace Petrobolos\FixedArray;

use Petrobolos\FixedArray\Commands\FixedArrayFunctionsCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class FixedArrayFunctionsServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('fixed-array-functions')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_fixed-array-functions_table')
            ->hasCommand(FixedArrayFunctionsCommand::class);
    }
}
