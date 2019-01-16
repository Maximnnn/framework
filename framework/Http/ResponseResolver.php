<?php

namespace Framework\Http;

use Framework\Http\Interfaces\ResponseInterface;

class ResponseResolver
{
    public function send(ResponseInterface $response) {
        $this
            ->sendHeaders($response->getHeaders())
            ->sendCookies($response->getCookies())
            ->sendBody($response->getBody());
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