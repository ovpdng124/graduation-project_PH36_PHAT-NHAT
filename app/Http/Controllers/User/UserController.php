<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index()
    {
        return view('user.index.index');
    }

    public function profile(){
        echo "Hello user";
    }

}
