<?php
namespace Framework\Exceptions;

use Framework\Http\Interfaces\ResponseInterface;
use Framework\Http\Request;
use Framework\Http\Response\ErrorResponse;
use Framework\Http\Response\JsonResponse;

class BaseException extends \Exception
{
    public function resolve():ResponseInterface {

        if (app()->make(Request::class)->wantsJson())
            return new JsonResponse(['success' => false, 'message' => $this->getMessage()]);

        return new ErrorResponse($this->getMessage());
    }
}