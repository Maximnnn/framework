<?php
namespace Framework\Http;

class Request implements RequestInterface
{
    protected $method;
    protected $get;
    protected $post;
    protected $files;
    protected $server;
    protected $session;
    protected $path;

    public function __construct($get, $post, $files, $server, $session)
    {
        $this->get = $get;
        $this->post = $post;
        $this->files = $files;
        $this->server = $server;
        $this->session = $session;
        $this->path = $server['REQUEST_URI'] ?? '';
        $this->method = $server['REQUEST_METHOD'] ?? null;
    }

    protected function getType(){

    }

    public function method(): string
    {
        return $this->method;
    }

    public function get(string $key = null)
    {
        return $this->get;
    }

    public function post(string $key = null)
    {
        return $this->post;
    }

    public function files()
    {
        return $this->files;
    }

    public function server($key = null)
    {
        return $this->server;
    }

    public function session(string $key = null)
    {
        return $this->session;
    }

    public function wantsJson(): bool
    {
        // TODO: Implement wantsJson() method.
    }

    public function put(string $key, $value): RequestInterface
    {
        // TODO: Implement put() method.
    }

    public function path(): string
    {
        return $this->path;
    }
}