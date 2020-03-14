<?php

namespace App\Http\Controllers\Auth;

use App\Entities\User;
use App\Helpers\GlobalHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreatePasswordRequest;
use App\Mail\ResetPasswordMail;
use Illuminate\Http\Request;
use Mail;
use Log;

class ResetPasswordController extends Controller
{
    protected $message;

    public function __construct()
    {
        $this->message = GlobalHelper::getErrorMessages();
    }

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
        $params             = $request->except('_token', 'password_confirmation');
        $params['password'] = bcrypt($params['password']);

        User::find($params['id'])->update($params);

        return redirect(route('notification'))->with($this->message['reset_password_success']);
    }

    public function sendPasswordMail(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!empty($user)) {
            if (is_null($user->verify_at)) {
                return redirect(route('password-forgot-form'))->withErrors('This account is not verified!');
            }

            try {
                Mail::to($user->email)->send(new ResetPasswordMail($user));

                return redirect(route('notification'))->with($this->message['send_mail_success']);
            } catch (Exception $exception) {
                Log::error($exception);

                return redirect(route('notification', ['verify_token' => $user->verify_token]))->with($this->message['send_mail_failed']);
            }
        }

        return redirect(route('password-forgot-form'))->withErrors('This email has not been registered');
    }
}
