<?php

namespace Framework;

trait singleInstanceTrait
{
    protected static $instance;

    /**
     * @param $parameters
     * @return mixed
     */
    public static function instance() {
        if (!static::$instance) {
            static::$instance = new static();
        }
        return static::$instance;
    }

}