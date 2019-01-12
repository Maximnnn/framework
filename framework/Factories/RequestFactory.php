<?php
namespace Framework\Factories;

use Framework\Collection;
use Framework\Http\Request;

class RequestFactory
{
    public function __construct()
    {
    }

    public function fromGlobals() {
        return new Request(
            new Collection($_GET),
            new Collection($_POST),
            new Collection($_FILES),
            new Collection($_SERVER),
            new Collection($_SESSION)
        );
    }

}