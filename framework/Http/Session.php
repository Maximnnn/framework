<?php

namespace Framework\Http;

use Framework\singleInstanceTrait;

class Session extends \ArrayObject
{
    use singleInstanceTrait;

    protected $session;

    public function __set($name, $value)
    {
        $this->set($name, $value);
    }

    public function __get($name)
    {
        return $this->get($name);
    }

    public function set($key, $value) {
        $this[$key] = $value;
        return $this;
    }

    public function get($key, $default = null) {
        return $this[$key] ?? $default;
    }

    public function __destruct() {
        if (session_status() != PHP_SESSION_NONE) {
            $_SESSION = (array)$this;
            session_regenerate_id();
        }
    }
}