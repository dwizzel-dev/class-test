<?php
/**
 * Created by PhpStorm.
 * User: Dwizzel
 * Date: 18/02/2018
 * Time: 1:58 PM
 */

namespace App\Core;

use Closure;
use App\Core\Traits\Macroable;


class Router{

    use Macroable {
        __call as macroCall;
    }

    public function __construct()
    {
    echo "<pre>".__METHOD__."<pre>";
    }

    public function __call($method, $parameters)
    {
        echo "<pre>".__METHOD__."<pre>";
        if (!static::hasMacro($method)) {
            static::macro($method, $parameters[1]);
        }
        return $this->macroCall($method, $parameters);

    }

}