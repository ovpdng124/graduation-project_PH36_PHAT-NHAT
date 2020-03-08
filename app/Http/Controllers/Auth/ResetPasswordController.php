<?php

namespace App\Http\Controllers\Auth;

use App\Entities\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreatePasswordRequest;
use App\Mail\ResetPasswordMail;
use Illuminate\Http\Request;
use Mail;
use Log;

class ResetPasswordController extends Controller
{
    public function passwordResetForm(Request $request)
    {
        $email  = $request->all();
        $userId = User::where('email', $email)->first();

        return view('user.auth.reset_password', compact('userId'));
    }

    public function passwordForgot()
    {
        return view('user.auth.forgot_password');
    }

    public function passwordReset(CreatePasswordRequest $request)
    {
        $params = $request->except('_token', 'password_confirmation');
        $params['password'] = bcrypt($params['password']);
        User::find($params['id'])->update($params);

        return redirect(route('login-form'));
    }

    public function sendPasswordMail(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if (is_null($user->verify_at)) {
            return redirect(route('password-forgot-form'))->withErrors('This account it not verify!');
        }

        try {
            Mail::to($user->email)->send(new ResetPasswordMail($user));

            return redirect(route('login-form'))->withErrors('Please check mail');
        } catch (Exception $exception) {
            Log::error($exception);

            return abort(500);
        }
    }
}
