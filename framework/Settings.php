<?php

namespace Framework;

class Settings extends Collection
{
    protected static $instance;

    public function __construct($input = array(), int $flags = 0, string $iterator_class = "ArrayIterator")
    {
        parent::__construct($input, $flags, $iterator_class);
        if (!self::$instance)
            self::$instance = $this;
    }

    public static function instance($input = []) {
        if (!static::$instance) {
            static::$instance = new self($input);
        }
        return static::$instance;
    }




}