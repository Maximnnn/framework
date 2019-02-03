<?php
$singletons = [
    \Framework\Container::class => function() {return \Framework\Container::instance();},

    \Framework\Http\Request::class => function(\Framework\Container $container) {
        return $container->make(Framework\Factories\RequestFactory::class)->fromGlobals();
    },

    \Framework\Http\Session::class => null,

    Framework\Factories\RequestFactory::class => null,

    \Framework\Http\Routes\Router::class => function() {
        $router = new \Framework\Http\Routes\Router();

        $methodArr = require_once ROOT_DIR . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'routes.php';

        foreach ($methodArr as $method => $routesArr) {
            if (method_exists($router, $method)) {
                foreach ($routesArr as $path => $func) {
                    $router->$method(new \Framework\Http\Routes\Route($path, $func));
                }
            }
        }
        return $router;
    },

    \Framework\Http\Response\Response::class => function() {
        $pipeline = new \Framework\Pipeline\Pipeline();

        try {
            return $pipeline
                ->add(\Framework\Http\Middleware\SessionHandler::class)
                ->add(\Framework\Http\Middleware\RouteHandler::class)
                ->add(\Framework\Http\Middleware\RouteNotFoundHandler::class)
                ->pipe();
        } catch (\Framework\Exceptions\BaseException $exception) {
            $response = $exception->resolve();
        } catch (Exception $exception) {
            $response = new \Framework\Http\Response\ErrorResponse($exception->getMessage());
        }

        return $response;
    },

    \Framework\Settings::class => function() {
        return \Framework\Settings::instance(require ROOT_DIR . '/env.php');
    }
];

foreach ($singletons as $class => $func) {
    app()->registerSingleton($class, $func);
}
