<?php
namespace Framework\Factories;

use Framework\Collection;
use Framework\Http\File;
use Framework\Http\Get;
use Framework\Http\Post;
use Framework\Http\Request;
use Framework\Http\Server;
use Framework\Http\Session;

class RequestFactory
{
    public function fromGlobals(){
        return new Request(
            new Get($_GET),
            new Post($_POST),
            new Collection(array_map(function($file) {return new File($file);}, $_FILES)),
            new Server($_SERVER),
            new Session($_SESSION ?? []),
            new Collection($_COOKIE)
        );
    }
}