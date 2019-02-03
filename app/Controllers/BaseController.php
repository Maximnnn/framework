<?php

namespace App\Controllers;

use Framework\Http\Interfaces\ResponseInterface;
use Framework\Http\Request;
use Framework\Http\Response\JsonResponse;
use Framework\Http\Response\SmartyResponse;
use Framework\Pipeline\Handler;

abstract class BaseController extends Handler
{
    protected $request;
    protected $viewData = [];

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    protected function view($template = '', $data = []): ResponseInterface {
        $this->viewData = array_merge($this->viewData, $data);
        if ($this->request->wantsJson())
            return app()->make(JsonResponse::class)->addData($this->viewData);

        return app()->make(SmartyResponse::class, [
            'template' => $template,
            'data'     => $this->viewData
        ])->noCache();
    }


}