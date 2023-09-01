<?php

namespace Bouhaddi\DriveWell;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Bouhaddi\DriveWell\Commands\DriveWellCommand;

class DriveWellServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('drivewell')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_drivewell_table')
            ->hasCommand(DriveWellCommand::class);
    }
}
