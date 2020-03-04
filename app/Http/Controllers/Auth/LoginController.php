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
            if (empty(Auth::user()->only('verify_at')['verify_at'])) {
                Auth::logout();

                return $this->showLoginForm();
            }

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
                return redirect(route('verify-notification', Auth::user()->only('verify_token')))->with(['notification' => 'This account it not verify!', 'messages' => '']);
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
