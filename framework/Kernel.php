<?php
namespace Framework;

use Framework\Factories\RequestFactory;
use Framework\Http\Request;
use Framework\Http\RequestInterface;
use Framework\Http\Route;
use Framework\Http\Router;
use Framework\Pipeline\ErrorHandler;
use Framework\Pipeline\Handler;
use Framework\Pipeline\InitHandler;
use Framework\Pipeline\RequestHandler;
use Framework\Pipeline\RouterHandler;
use Framework\Pipeline\SessionHandler;

class Kernel
{
    protected $handler;

    protected $middleware = [
        SessionHandler::class,
        RequestHandler::class,
    ];
    protected $last = [
        RouterHandler::class,
        ErrorHandler::class
    ];

    public function __construct(array $container, array $middleware, array $routes)
    {
        $this->initRouter($routes);

        $this->registerContainer($container);

        $this->handler = $this->registerMiddleware($config['middleware'] ?? []);
    }

    public function run() {

        $response = $this->handler->handle();


        return $response;
        //run
        //emit response

    }

    protected function registerContainer(array $array) {
        app()->register(RequestInterface::class, function(Container $container){
            return $container->make(RequestFactory::class)->fromGlobals();
        });



        foreach ($array as $class => $func) {
            app()->register($class, $func);
        }
    }

    protected function registerMiddleware(array $array):Handler {
        $first = app()->make(InitHandler::class);
        $next = $first;
        foreach (array_merge($this->middleware, $array, $this->last) as $middleware) {
            $next = $next->next(app()->make($middleware));
        }
        return $first;
    }

    protected function initRouter($routes) {
        app()->register(Router::class, function() use ($routes) {
            $router = new Router();

            foreach ($routes as $method) {
                foreach ($method as $path => $closure) {
                    $router->get(new Route($path, $closure));
                }
            }
            return $router;
        });
    }
}