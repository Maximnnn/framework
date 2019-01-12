<?php
namespace Framework\Http;

class Route
{
    protected $path;
    protected $closure;

    public function __construct($path, $closure)
    {
        $this->path = $path;
        $this->closure = $closure;
    }

    public function path() {
        return $this->path;
    }
    public function closure() {
        return $this->closure;
    }
}