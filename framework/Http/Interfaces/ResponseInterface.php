<?php
namespace Framework\Http\Interfaces;

use Framework\Collection;
use Framework\Http\Cookie;
use Framework\Http\Header;

interface ResponseInterface
{
    public function setCookie(Cookie $cookie);

    public function setHeader(Header $header);

    public function addBody(string $string);

    public function addData($key, $value);

    public function getCookies(): Collection;

    public function getHeaders(): Collection;

    public function getBody(): string;

    public function getData(): array;

    public function noCache();
}

