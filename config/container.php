<?php
return [
    'isProd' => function() {
        return true; //TODO return (bool)app()->make(Config::class)->prod
    },
];