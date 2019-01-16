<?php
namespace Framework\Http\Routes;

class Router
{
    protected $routes = [
        'post' => [],
        'get' => [],
        'delete' => [],
        'put' => [],
        'patch' => [],
        'cli' => []
    ];

    public function get(Route $route){
        $this->routes['get'][$route->getPath()] = $route;
    }

    public function post(Route $route){
        $this->routes['post'][$route->getPath()] = $route;
    }

    public function put(Route $route) {
        $this->routes['put'][$route->getPath()] = $route;
    }

    public function delete(Route $route) {
        $this->routes['delete'][$route->getPath()] = $route;
    }

    public function patch(Route $route) {
        $this->routes['patch'][$route->getPath()] = $route;
    }

    public function cli(Route $route){
        $this->routes['cli'][$route->getPath()] = $route;
    }

    public function find($method, $path) {
        $method = strtolower($method);
        if (isset($this->routes[$method]) and isset($this->routes[$method][$path])) {
            return $this->routes[$method][$path];
        }

        return null;
    }

}