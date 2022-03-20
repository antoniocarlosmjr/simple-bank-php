<?php

namespace App\Enumerators;

use ReflectionClass;

class BaseEnum
{
    public static function getFields(array $except = []): array
    {
        $rf = new ReflectionClass(get_called_class());
        return array_filter($rf->getConstants(), function ($val) use ($except) {
            return in_array($val, $except) === false;
        });
    }

    public static function getFieldsList(array $except = []): string
    {
        return implode(",", static::getFields($except));
    }
}
