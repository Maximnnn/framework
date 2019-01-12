<?php
namespace Framework\Pipeline;

class SessionHandler extends Handler
{
    public function handle($data = null)
    {
        session_start();
        return parent::handle($data);
    }

}