<?php
namespace Framework\Http\Response;

class HtmlResponse extends Response
{
    public function __construct($html = '')
    {
        $this->body = $html;
    }
}