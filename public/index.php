<?php
require_once '../vendor/autoload.php';
require_once '../framework/functions.php';

define('ROOT_DIR', dirname(__DIR__));

$app = app();

$config = [
    'container' => require_once ROOT_DIR . '/config/container.php',
    'middleware' => require_once ROOT_DIR . '/config/middleware.php',
    'routes' => require_once ROOT_DIR . '/config/routes.php'
];

$kernel = $app->make(\Framework\Kernel::class,$config);

$kernel->run();