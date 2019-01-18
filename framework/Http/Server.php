<?php
namespace Framework\Http;

class Server extends RequestData
{
    public function method():string {
        return $this['REQUEST_METHOD'] ?? 'cli';
    }

    public function getPath():string {
        return parse_url($this['REQUEST_URI'] ?? '', PHP_URL_PATH);
    }

}