<?php

namespace Bouhaddi\DriveWell;

use Bouhaddi\DriveWell\Commands\DriveWellCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

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
 
