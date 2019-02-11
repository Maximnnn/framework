<?php

namespace Framework\Http\Middleware;

use Framework\Pipeline\Handler;
use Framework\Storage\Settings;

class SessionHandler extends Handler
{
    public function handle() {
        session_name(app()->make(Settings::class)->setting('app','Application'));
        session_start();
        return parent::callNext();
    }
}