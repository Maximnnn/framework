<?php
namespace Framework\Exceptions;

use Framework\Http\Interfaces\ResponseInterface;
use Framework\Http\Request;
use Framework\Http\Response\ErrorResponse;
use Framework\Http\Response\JsonResponse;
use Throwable;

class BaseException extends \Exception
{
    public function __construct(string $message = "", int $code = 0, Throwable $previous = null)
    {
        if (PRODUCTION) throw new \Exception('server error');
        parent::__construct($message, $code, $previous);
    }

    public function resolve():ResponseInterface {

        if (app()->make(Request::class)->wantsJson())
            return new JsonResponse(['success' => false, 'message' => $this->getMessage()]);

        return new ErrorResponse($this->getMessage());
    }
}