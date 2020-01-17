<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index()
    {
        return view('index.index');
    }

}
