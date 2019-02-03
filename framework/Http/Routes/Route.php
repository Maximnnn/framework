<?php
namespace Framework\Http\Routes;

use Framework\Exceptions\BaseException;
use Framework\Http\Interfaces\ResponseInterface;
use Framework\Pipeline\Pipeline;

class Route
{
    protected $path;
    protected $closure;
    protected $middleware = [];
    protected $params = [];

    public function __construct($path, $closure)
    {
        $this->path = $path;
        $this->closure = $closure;
    }

    public function addParams($params) {
        $this->params = $params;
        return $this;
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
    public function middleware($middleware) {
        if (!is_array($middleware))
            $middleware = [$middleware];
        $this->middleware = array_merge($this->middleware, $middleware);
        return $this;
    }

    public function run():ResponseInterface {

        if (is_string($this->closure))
            $this->closure = CONTROLLERS_NAMESPACE . $this->closure;

        $this->middleware[] = $this->closure;

        $pipeline = new Pipeline();

        foreach ($this->middleware as $string) {
            $string = explode('@', $string);
            $class = $string[0];
            $method = $string[1] ?? 'callNext';
            $pipeline->add($class, $method);
        }

        $response = $pipeline->pipe($this->params);

        if ($response instanceof ResponseInterface)
            return $response;

        throw app()->make(BaseException::class, ['unknown route method type']);
    }

}