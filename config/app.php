<?php

define('ROOT_DIR', dirname(__DIR__));
define('CONTROLLERS_NAMESPACE', '\\App\\Controllers\\');

require_once ROOT_DIR . '/vendor/autoload.php';

require_once ROOT_DIR . '/framework/functions.php';

require_once ROOT_DIR . '/config/classes_register.php';
require_once ROOT_DIR . '/config/singletons_register.php';

define('PRODUCTION', app()->make(\Framework\Storage\Settings::class)->setting('prod'));

require_once ROOT_DIR . '/config/custom_routes.php';

