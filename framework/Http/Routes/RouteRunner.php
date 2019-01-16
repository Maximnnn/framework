<?php
namespace Framework\Http\Routes;

use Framework\Http\Interfaces\RequestInterface;
use Framework\Pipeline\Pipeline;

class RouteRunner
{
    public function run(Route $route, RequestInterface $request) {
        $pipeline = new Pipeline();

        foreach ($route->getMiddleware() as $class => $method) {
            $pipeline->add($class, $method);
        }

        try {
            $data = $pipeline->pipe($request);
        } catch (\Exception $exception) {
            return $exception;
        }

        $closure = explode('::', $route->getClosure());

        $obj = app()->make($closure[0]);

        $params = $this->resolveParams($obj, $closure[1]);

        $response = $obj->$closure[1](...$params);

        return $response;
    }

    protected function resolveParams($obj, $method) {
        $params = [];

        $r = new \ReflectionMethod(get_class($obj),$method);

        foreach ($r->getParameters() ?? [] as $parameter) {
            $name = $parameter->getClass()->getName();
            $params[] = app()->make($name);
        };

        return $params;
    }
}