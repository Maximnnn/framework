<?php
namespace Framework\Http\Routes;

use Framework\Exceptions\BaseException;

class Route
{
    protected $path;
    protected $closure;
    protected $middleware = [];

    public function __construct($path, $closure)
    {
        $this->path = $path;
        $this->closure = $closure;
    }

    public function getPath() {
        return $this->path;
    }
    public function getClosure(){
        return $this->closure;
    }
    public function getMiddleware(){
        return $this->middleware;
    }
    public function middleware(array $middleware) {
        $this->middleware = $middleware;
        return $this;
    }

    public function run() {

        if (is_string($this->closure)) {

            $controller = explode('@', $this->closure);
            $class = $controller[0];
            $method = $controller[1];

            $params = new \ReflectionMethod($class, $method);

            return app()->make($class)->$method($params);
        } else if (is_callable($this->closure)) {

            $ref = new \ReflectionFunction($this->closure);
            $params = app()->resolveParameters($ref->getParameters());

            return ($this->closure)(...$params);
        }

        throw app()->make(BaseException::class, ['unknown route method type']);
    }
}