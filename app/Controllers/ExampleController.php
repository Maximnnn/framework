<?php
namespace App\Controllers;

use Framework\Http\Request;
use Framework\Http\Response\JsonResponse;

class ExampleController extends BaseController
{
    public function index(Request $request) {
        return new JsonResponse($request->get());
    }

    public function user(Request $request, $id, $profile) {

        return $this->view('home', compact('id', 'profile'));
    }

}