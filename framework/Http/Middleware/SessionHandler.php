<?php

namespace Framework\Http\Middleware;

use Framework\Pipeline\Handler;

class SessionHandler extends Handler
{
    public function handle() {
        session_start();
        return parent::callNext();
    }
}