<?php
namespace Framework\Pipeline;


interface HandlerInterface
{
    public function next($handler, $method = 'handle');
}