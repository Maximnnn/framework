<?php

function d($arr) {
    echo '<pre>';
    print_r($arr);
    echo '</pre>';
    die;
}

function dj($arr) {
    echo json_encode($arr);
    die;
}

function app():\Framework\Container {
     return \Framework\Container::instance();
}