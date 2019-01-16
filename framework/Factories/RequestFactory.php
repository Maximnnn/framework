<?php
namespace Framework\Factories;

use Framework\Http\Cookies;
use Framework\Http\Files;
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
            new Files($_FILES),
            new Server($_SERVER),
            new Session($_SESSION ?? []),
            new Cookies($_COOKIE)
        );
    }
}