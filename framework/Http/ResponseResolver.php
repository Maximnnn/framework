<?php

namespace Framework\Http;

use Framework\Exceptions\BaseException;
use Framework\Http\Interfaces\ResponseInterface;
use Framework\Http\Response\ErrorResponse;

class ResponseResolver
{
    public function send(ResponseInterface $response) {
        try {
            $this
                ->sendHeaders($response->getHeaders())
                ->sendCookies($response->getCookies())
                ->sendBody($response->getBody());
        } catch (BaseException $exception) {
            $response = $exception->resolve();
            $this->send($response);
        } catch (\Exception $exception) {
            $response = new ErrorResponse($exception->getMessage());
            $this->send($response);
        }
    }

    protected function sendHeaders($headers) {
        return $this;
    }

    protected function sendCookies($cookies) {
        return $this;
    }

    protected function sendBody(string $body) {
        echo $body;
        return $this;
    }

}