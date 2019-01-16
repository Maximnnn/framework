<?php
namespace Framework\Http\Interfaces;

interface RequestInterface
{
    public function method():string;
    public function get(string $key = null);
    public function post(string $key = null);
    public function cookies(string $key = null);
    public function files();
    public function server($key = null);
    public function session(string $key = null);
    public function wantsJson():bool;
    public function put(string $key, $value):RequestInterface;
    public function path():string;
}