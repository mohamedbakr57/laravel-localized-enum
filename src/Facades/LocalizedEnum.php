<?php

namespace Bakr\LocalizedEnum\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Bakr\LocalizedEnum\LocalizedEnum
 */
class LocalizedEnum extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Bakr\LocalizedEnum\LocalizedEnum::class;
    }
}
