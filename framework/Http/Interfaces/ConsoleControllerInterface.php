<?php

namespace Framework\Http\Interfaces;


interface ConsoleControllerInterface
{
    public function getDescription():string;

    public function handleError($args):ResponseInterface;

}