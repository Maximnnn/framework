<?php

namespace App\Controllers\Console;

use Framework\Http\Interfaces\ConsoleControllerInterface;
use Framework\Http\Interfaces\ResponseInterface;
use Framework\Http\Response\ConsoleResponse;

class ConsoleHelper implements ConsoleControllerInterface
{
    public function getDescription(): string
    {
        return '';
    }

    public function handleError($args): ResponseInterface
    {
        /**@var $response ResponseInterface*/
        $response = app()->make(ConsoleResponse::class);

        $classes = scandir(ROOT_DIR . '/app/Controllers/Console');

        $classes = array_diff($classes, ['.', '..']);

        $classes = array_map(function($class) {
            return substr($class,0, -4);
        }, $classes);

        foreach ($classes as $class) {
            $obj = app()->make(__NAMESPACE__ . '\\' . $class);
            if ($obj and method_exists($obj, 'getDescription'))
                $response->addBody($obj->getDescription());
        }

        return $response;
    }
}