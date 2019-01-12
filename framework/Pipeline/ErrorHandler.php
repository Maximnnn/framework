<?php
namespace Framework\Pipeline;

class ErrorHandler extends Handler
{
    public function handle($data = null)
    {
        throw new \Exception('something gone wrong');
    }

}