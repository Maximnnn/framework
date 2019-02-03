<?php
namespace Framework\Http\Response;

use Framework\Collection;
use Framework\Http\Cookie;
use Framework\Http\Header;
use Framework\Http\Interfaces\ResponseInterface;

class Response implements ResponseInterface
{
    /**@var $headers Collection*/
    protected $headers;
    /**@var $cookies Collection*/
    protected $cookies;
    protected $body = '';
    protected $data = [];
    protected $cache = 1;

    public function __construct() {
        $this->headers = app()->make(Collection::class);
        $this->cookies = app()->make(Collection::class);
    }

    public function getHeaders() :Collection {
        return $this->headers;
    }

    public function getBody(): string {
        return $this->body;
    }

    public function getData(): array {
        return $this->data;
    }

    public function setCookie(Cookie $cookie)
    {
        $this->cookies->append($cookie);
        return $this;
    }

    public function setHeader(Header $header)
    {
        $this->headers->append($header);
        return $this;
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

    public function getCookies(): Collection
    {
        return $this->cookies;
    }

    public function noCache() {
        $this->cache = 0;
        return $this;
    }
}