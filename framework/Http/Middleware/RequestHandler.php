<?php
namespace Framework\Http\Routes\Middleware;

class RequestHandler extends \Framework\Pipeline\Handler
{
    public function handle($data = null)
    {
        $request = app()->make(\Framework\Http\Request::class);
        return parent::handle($request);
    }

}