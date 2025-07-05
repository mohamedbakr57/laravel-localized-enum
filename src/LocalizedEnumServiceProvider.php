<?php

namespace Bakr\LocalizedEnum;

use Bakr\LocalizedEnum\Commands\LocalizedEnumCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class LocalizedEnumServiceProvider extends PackageServiceProvider
{
    public function boot(): void
    {
        if (file_exists(__DIR__.'/helpers.php')) {
            require_once __DIR__.'/helpers.php';
        }

    }

    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('localized-enum')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_localized_enum_table')
            ->hasCommand(LocalizedEnumCommand::class);
    }
}
