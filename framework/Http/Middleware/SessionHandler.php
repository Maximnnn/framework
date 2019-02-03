<?php

namespace Framework\Http\Middleware;

use Framework\Pipeline\Handler;
use Framework\Settings;

class SessionHandler extends Handler
{
    public function handle() {
        session_name(app()->make(Settings::class)->get('app','Application'));
        session_start();
        return parent::callNext();
    }
}