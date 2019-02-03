<?php
namespace Framework\Http;

use Framework\Collection;
use Framework\Http\Interfaces\RequestInterface;

class Request implements RequestInterface
{
    protected $get;
    protected $post;
    protected $files;
    protected $server;
    protected $session;
    protected $cookies;

    public function __construct(Get $get,Post $post, Collection $files, Server $server, Session $session, Collection $cookies)
    {
        $this->get = $get;
        $this->post = $post;
        $this->files = $files;
        $this->server = $server;
        $this->session = $session;
        $this->cookies = $cookies;
    }

    public function method(): string
    {
        return strtolower($this->server->method());
    }

    /**
     * @param string|null $key
     * @param null $default
     * @return Get|mixed|null
     */
    public function get(string $key = null, $default = null)
    {
        return $key ? ($this->get->$key ?? $default) : $this->get;
    }

    public function post(string $key = null, $default = null)
    {
        $key ? ($this->post->$key ?? $default) : $this->post;
    }

    public function files()
    {
        return $this->files;
    }

    public function server($key = null, $default = null)
    {
        return $key ? ($this->server->$key ?? $default) : $this->server;
    }

    public function session(string $key = null, $default = null)
    {
        return $key ? ($this->session->$key ?? $default) : $this->session;
    }

    public function wantsJson(): bool
    {
        if (preg_match('/json/', $this->server('HTTP_ACCEPT')))
            return true;
        return false;
    }

    public function put(string $key, $value): RequestInterface
    {
        // TODO: Implement put() method.
    }

    public function path(): string
    {
        return $this->server->getPath();
    }

    public function cookies(string $key = null, $default = null)
    {
        return $key ? ($this->cookies->$key ?? $default) : $this->cookies;
    }
}