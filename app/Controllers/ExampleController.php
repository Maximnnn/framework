<?php
namespace App\Controllers;

use Framework\Http\Request;
use Framework\Http\Response\JsonResponse;


class ExampleController extends BaseController
{
    public function index(Request $request) {
        return new JsonResponse($request->get());
    }

    public function user(Request $request, $profile, $id) {

        return $this->view('home', compact('id', 'profile'));
    }

    public function test() {
        return new JsonResponse([1,2,3]);
    }

}