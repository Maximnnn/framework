<?php

$classes = [

];

foreach ($classes as $class => $func) {
    app()->register($class, $func);
}