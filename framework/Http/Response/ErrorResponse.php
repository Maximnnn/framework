<?php
namespace Framework\Http\Response;

class ErrorResponse extends Response
{
    public function __construct($message = 'server error', $code = 500)
    {
        $this->body = $message;
    }
}