<?php
require_once '../config/app.php';

/**@var $response \Framework\Http\Interfaces\ResponseInterface*/
$response = app()->make(\Framework\Http\Response\Response::class);

app()->make(\Framework\Http\ResponseResolver::class)->send($response);

