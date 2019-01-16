<?php

namespace Framework;

trait singleInstanceTrait
{
    protected static $instance;

    /**
     * @return static
     */
    public static function instance() {
        if (!static::$instance) {
            static::$instance = new static();
        }
        return static::$instance;
    }

}