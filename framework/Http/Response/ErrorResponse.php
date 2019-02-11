<?php
namespace Framework\Http\Response;

class ErrorResponse extends Response
{
    public function __construct($message = 'server error', $code = 500)
    {
        parent::__construct();
        $this->body = $message;
    }

    public function getBody(): string
    {
        if (PRODUCTION)
            return '';

        return parent::getBody();
    }
}