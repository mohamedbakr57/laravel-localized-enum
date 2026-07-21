<?php

namespace Bakr\LocalizedEnum\Tests;

use Bakr\LocalizedEnum\LocalizedEnumServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function getPackageProviders($app)
    {
        return [
            LocalizedEnumServiceProvider::class,
        ];
    }
}
