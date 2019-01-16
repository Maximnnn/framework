<?php
namespace Framework\Http;

class Server extends RequestData
{
    public function method():string {
        return $this['REQUEST_METHOD'] ?? 'cli';
    }

    public function getPath():string {
        return $this['REQUEST_URI'] ?? '';
    }

}