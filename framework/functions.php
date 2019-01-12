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

function app() {
     return \Framework\Container::instance();
}