<?php

namespace App\Http\Controllers;

use App\Helpers\GlobalHelper;
use App\Http\Requests\LoginRequest;
use Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        if (Auth::check()) {
            return redirect(route('index'));
        }

        return view('user.auth.login');
    }

    public function login(LoginRequest $request)
    {
        $params = $request->only(['username', 'password']);

        if (Auth::attempt($params)) {
            if (GlobalHelper::checkAdminRole()) {
                return redirect(route('admin.index'));
            }

            if (empty(Auth::user()->only('verify_at')['verify_at'])) {
                Auth::logout();

                return redirect(route('login'))->with('error', 'This account is not verify!');
            }

            return redirect(route('index'));
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
