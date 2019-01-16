<?php
namespace Framework\Http\Middleware;

use Framework\Exceptions\RouteNotFoundException;
use Framework\Pipeline\Handler;

class RouteNotFoundHandler extends Handler
{
    public function handle()
    {
        $exception = app()->make(RouteNotFoundException::class, ['route not found']);
        throw $exception;
    }
}