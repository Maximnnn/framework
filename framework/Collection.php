<?php
namespace Framework;


class Collection extends \ArrayObject
{
    public function __get($name)
    {
        if (isset($this[$name]))
            return $this[$name];
        return null;
    }

    public function __set($name, $value)
    {
        $this[$name] = $value;
    }



}