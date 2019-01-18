<?php
namespace Framework\Http\Interfaces;

interface ResponseInterface
{
    public function setCookie($key, $value, $expire, $path, $domain, $secure, $httpOnly);

    public function setHeader();

    public function addBody(string $string);

    public function addData($key, $value);

    public function getCookies(): array;

    public function getHeaders(): array;

    public function getBody(): string;

    public function getData(): array;

    public function noCache();
}

