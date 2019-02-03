<?php
namespace Framework;


class Collection extends \ArrayObject
{

    public function __get($name)
    {
        return $this->get($name);
    }

    public function __set($name, $value)
    {
        $this->set($name, $value);
    }

    public function get($key, $default = null) {
        return $this[$key] ?? $default;
    }

    public function set($key, $val) {
        $this[$key] = $val;
        return $this;
    }


}