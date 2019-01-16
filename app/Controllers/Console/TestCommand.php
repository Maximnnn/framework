<?php

namespace App\Controllers\Console;


use Framework\Http\Interfaces\ConsoleControllerInterface;
use Framework\Http\Interfaces\ResponseInterface;
use Framework\Http\Response\ConsoleResponse;
use Framework\Http\Response\JsonResponse;

class TestCommand implements ConsoleControllerInterface
{


    public function getDescription(): string
    {
        return 'This is test Console command controller' . PHP_EOL;
    }

    public function handleError($args): ResponseInterface
    {
        return app()->make(JsonResponse::class)->addData('arguments', $args);
    }

    public function action($args) {
        return (new ConsoleResponse())->addBody('you are in TestCommand, method - action, args: ' . json_encode($args));
    }
}