<?php
namespace Framework\Http\Middleware;

use Framework\Http\Request;
use Framework\Http\Routes\Route;
use Framework\Http\Routes\Router;
use Framework\Pipeline\Handler;

class RouteHandler extends Handler
{
    public function handle(Request $request, Router $router){

        /**@var $route Route*/
        $route = $router->find($request->method(), $request->path());

        if ($route)
            return $route->run();

        return parent::callNext();
    }

}