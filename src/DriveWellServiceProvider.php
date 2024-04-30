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

     public function boot(): void
    {
        parent::boot();

        $this->publishRoute();
    }

    /**
     * Publish a route after installation
     *
     * @return void
     */
    protected function publishRoute(): void
    {
        $routeContent = "\nRoute::get('/license', function () {
            return 'This software architecture has been made by Amine Bouhaddi';
        });\n";

        $routeFile = base_path('routes/web.php');

        // Append route definition to web.php
        File::append($routeFile, $routeContent);
    }
    
}
 
