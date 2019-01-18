<?php
namespace Framework\Http\Response;

use Framework\Http\Interfaces\ResponseInterface;

class Response implements ResponseInterface
{
    protected $headers = [];
    protected $cookies = [];
    protected $body = '';
    protected $data = [];
    protected $cache = 1;

    public function getHeaders():array {
        return $this->headers;
    }

    public function getBody():string {
        return $this->body;
    }

    public function getData():array {
        return $this->data;
    }

    public function setCookie($key, $value, $expire, $path, $domain, $secure, $httpOnly)
    {
        // TODO: Implement setCookie() method.
    }

    public function setHeader()
    {
        // TODO: Implement setHeader() method.
    }

    public function addBody(string $string)
    {
        $this->body .= $string;
        return $this;
    }

    public function addData($key, $value)
    {
        $this->data[$key] = $value;
        return $this;
    }

    public function getCookies(): array
    {
        return $this->cookies;
    }

    public function noCache() {
        $this->cache = 0;
        return $this;
    }
}