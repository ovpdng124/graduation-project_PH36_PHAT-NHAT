<?php

namespace App\Http\Controllers\Auth;

use App\Entities\User;
use App\Http\Controllers\Controller;
use App\Mail\ResetPasswordMail;
use Illuminate\Http\Request;
use Mail;
use Log;

class ResetPasswordController extends Controller
{
    public function passwordResetForm()
    {
        return view('user.auth.reset_password');
    }

    public function passwordReset()
    {
        return view('mail.reset_password');
    }

    public function sendPasswordMail(Request $request)
    {
        $user = User::where('email',$request->email)->first();

        if (is_null($user->verify_at)){

            return redirect(route('password-reset-form'))->withErrors('This account it not verify!');
        }

        try {
            Mail::to($user->email)->send(new ResetPasswordMail($user));

            return view('user.auth.login');
        } catch (Exception $exception) {
            Log::error($exception);
            return abort(500);
        }
    }
}
