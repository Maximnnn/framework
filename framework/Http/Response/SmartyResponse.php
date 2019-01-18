<?php

namespace Framework\Http\Response;


use Framework\Exceptions\RouteNotFoundException;
use Framework\Smarty;

class SmartyResponse extends Response
{
    /**@var $smarty Smarty*/
    protected $smarty;
    protected $template;

    public function __construct(string $template = '', array $data = [])
    {
        $this->smarty = app()->make(Smarty::class);
        $this->template = $template . '.tpl';
        $this->data = $data;
    }

    public function setTemplate($template)
    {
        $this->template = $template;
        return $this;
    }

    /**
     * @return string
     * @throws RouteNotFoundException
     */
    public function getBody(): string
    {
        try {
            $this->smarty->assign($this->data);
            $this->smarty->caching = $this->cache;
            return $this->smarty->fetch($this->template) . $this->body;
        } catch (\Exception $exception) {
            throw new RouteNotFoundException('template not exist: ' . $this->template);
        }
    }
}