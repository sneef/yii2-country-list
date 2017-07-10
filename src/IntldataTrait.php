<?php

namespace tigrov\country;

use yii\base\UnknownMethodException;

/**
 * Trait IntldataTrait is a proxy to \tigrov\intldata static classes
 *
 * @method static string[] codes() Returns list of codes
 * @method static bool has(string $code) Returns a boolean indicating whether data has a code
 * @method static array names() Returns list of names
 * @method static string name(string $code) Returns name by code
 */
trait IntldataTrait
{
    public static function __callStatic($name, $arguments)
    {
        $className = static::intldataClassName();

        if (method_exists($className, $name)) {
            return forward_static_call_array([$className, $name], $arguments);
        } else {
            throw new UnknownMethodException('Unknown static method ' . static::class . '::' . $name);
        }
    }

    public static function intldataClassName()
    {
        return '\\tigrov\\intldata\\' . substr(strrchr(self::class, '\\'), 1);
    }
}