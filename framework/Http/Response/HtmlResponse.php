<?php
namespace Framework\Http\Response;

class HtmlResponse extends Response
{
    public function __construct($html = '')
    {
        parent::__construct();
        $this->body = $html;
    }
}