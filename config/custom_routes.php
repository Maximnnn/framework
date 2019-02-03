<?php
/**@var $routes \Framework\Http\Routes\Router*/

use Framework\Http\Routes\Route;

$routes = app()->make(\Framework\Http\Routes\Router::class);

$routes->get((new Route('/framework/public/test', 'ExampleController@test'))->middleware('auth'));
