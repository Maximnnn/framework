<?php
namespace Framework\Pipeline;

use Framework\Http\RequestInterface;

class RequestHandler extends Handler
{
    public function handle($data = null)
    {
        $request = app()->make(RequestInterface::class);
        return parent::handle($request);
    }

}