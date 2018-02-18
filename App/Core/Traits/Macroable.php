<?php
/**
 * Created by PhpStorm.
 * User: Dwizzel
 * Date: 18/02/2018
 * Time: 1:52 PM
 */

namespace App\Core\Traits;

use Closure;
use BadMethodCallException;


trait Macroable
{
    protected static $macros = [];

    public static function macro($name, $macro)
    {
        echo "<pre>".__METHOD__."<pre>";
        static::$macros[$name] = $macro;
    }

    public static function hasMacro($name)
    {
        echo "<pre>".__METHOD__."<pre>";
        return isset(static::$macros[$name]);
    }

    public static function __callStatic($method, $parameters)
    {
        echo "<pre>".__METHOD__."<pre>";
        if (! static::hasMacro($method)) {
            throw new BadMethodCallException("Method {$method} does not exist.");
        }

        if (static::$macros[$method] instanceof Closure) {
            return call_user_func_array(Closure::bind(static::$macros[$method], null, __CLASS__), $parameters);
        }

        return call_user_func_array(static::$macros[$method], $parameters);
    }

    public function __call($method, $parameters)
    {
        echo "<pre>".__METHOD__."<pre>";
        if (! static::hasMacro($method)) {
            throw new BadMethodCallException("Method {$method} does not exist.");
        }

        $macro = static::$macros[$method];

        if ($macro instanceof Closure) {
            return call_user_func_array($macro->bindTo($this, __CLASS__), $parameters);
        }

        return call_user_func_array($macro, $parameters);
    }
}
