<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\GlobalHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        if (Auth::check()) {
            return redirect(route('profile'));
        }

        return view('user.auth.login');
    }

    public function login(LoginRequest $request)
    {
        $params = $request->except('_token');

        if (Auth::attempt($params)) {
            if (GlobalHelper::checkAdminRole()) {
                return redirect(route('admin.index'));
            }
            return redirect(route('profile'));
        }

        return back()->withErrors('Wrong username or password')->withInput();
    }

    public function logout()
    {
        if (Auth::check()) {
            Auth::logout();

            return redirect(route('index'));
        }

        return abort(401);
    }
}
