<?php
return [
    'get' => [
        '/framework/public/home' => function(){return new \Framework\Http\Response\HtmlResponse('home');}
    ],
    'post' => [

    ],
    'cli' => [
        '' => '\App\Controllers\Console\ConsoleRouter@index'
    ]
];