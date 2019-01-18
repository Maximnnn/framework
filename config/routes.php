<?php
return [
    'get' => [
        '/framework/public/' => 'ExampleController@index',
        '/framework/public/user/:id/profile/:profile' => 'ExampleController@user'
    ],
    'post' => [

    ],
    'cli' => [
        '' => 'Console\ConsoleRouter@index'
    ]
];