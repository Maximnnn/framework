<?php
namespace Framework\Http;

class Router
{
    protected $routes = [
        'post' => [],
        'get' => []
    ];
    protected $get = [];
    protected $post = [];

    public function get(Route $route){
        $this->routes['get'][$route->path()] = $route;
    }

    public function post(Route $route){
        $this->routes['post'][$route->path()] = $route;
    }

    public function find($type, $path):Route {
        if ($this->routes[$type] and $this->routes[$type][$path]) {
            return $this->routes[$type][$path];
        }
        return null;
    }

}