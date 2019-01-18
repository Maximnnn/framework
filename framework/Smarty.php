<?php

namespace Framework;

class Smarty extends \Smarty
{
    function __construct()
    {
        parent::__construct();

        $this->setTemplateDir(ROOT_DIR . DIRECTORY_SEPARATOR . 'resources' . DIRECTORY_SEPARATOR . 'templates');
        $this->setCompileDir(ROOT_DIR . DIRECTORY_SEPARATOR . 'resources' . DIRECTORY_SEPARATOR . 'templates' . DIRECTORY_SEPARATOR . 'templates_c');
        $this->setConfigDir(ROOT_DIR . DIRECTORY_SEPARATOR . 'resources' . DIRECTORY_SEPARATOR . 'templates' . DIRECTORY_SEPARATOR . 'configs');
        $this->setCacheDir(ROOT_DIR . DIRECTORY_SEPARATOR . 'resources' . DIRECTORY_SEPARATOR . 'templates' . DIRECTORY_SEPARATOR . 'cache');

        $this->caching = Smarty::CACHING_LIFETIME_CURRENT;
        $this->assign('app_name', 'TMP'); //todo
    }
}