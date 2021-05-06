<?php

namespace Aries\Oss\Facades;

use Illuminate\Support\Facades\Facade;

class EasyOss extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'easyOss';
    }
}