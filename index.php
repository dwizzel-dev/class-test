<?php

require_once('define.php');

use \App\Core\Router;

$router = new Router;
$router->get("/", function(){
    echo "<pre>".__METHOD__."<pre>";
    echo "<pre>index<pre>";
});
$router->{'testing'} = 'test string';

$reflection = new ReflectionClass($router);
$methods = $reflection->getMethods();
var_dump($methods);
$properties = $reflection->getProperties();
var_dump($properties);


