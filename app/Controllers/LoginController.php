<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class LoginController extends BaseController
{
    public function index()
    {
        return view('pages/login');
    }

    public function login(){
        // TODO - login method - 2021/12/17
    }
}
