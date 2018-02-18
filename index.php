<?php

require_once('define.php');

use \App\Core\Router;

$router = new Router;
$router->get('/', function () {
    echo "<pre>index<pre>";
});


$reflection = new ReflectionClass($router);
$methods = $reflection->getMethods();
var_dump($methods);


