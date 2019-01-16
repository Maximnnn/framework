<?php

namespace Framework\Exceptions;

use Framework\Http\Interfaces\ResponseInterface;
use Framework\Http\Response\ConsoleResponse;

class ConsoleException extends BaseException
{
    public function resolve(): ResponseInterface
    {
        return app()->make(ConsoleResponse::class)->addBody($this->getMessage());
    }

}