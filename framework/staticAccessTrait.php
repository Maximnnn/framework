<?php

namespace Framework;


use Framework\Exceptions\BaseException;

trait staticAccessTrait
{
    public static function __callStatic($name, $arguments)
    {
        $obj = app()->make(get_called_class());
        if (method_exists($obj, $name)) {
            return $obj->$name(...$arguments);
        }

        throw new BaseException(sprintf('metod %s doesn`t exist in %s', $name, get_called_class()));
    }

}