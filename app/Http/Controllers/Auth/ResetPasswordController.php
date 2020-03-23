<?php

namespace App\Http\Controllers\Auth;

use App\Entities\User;
use App\Helpers\GlobalHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\ResetPasswordRequest;
use App\Http\Requests\ForgotPasswordRequest;
use Illuminate\Http\Request;
use App\Services\ResetPasswordService;

class ResetPasswordController extends Controller
{
    /**
     * @var ResetPasswordService
     */
    protected $resetPasswordService;
    protected $messages;

    public function __construct()
    {
        $this->resetPasswordService = app(ResetPasswordService::class);
        $this->messages             = GlobalHelper::$messages;
    }

    public function passwordResetForm(Request $request)
    {
        $email  = $request->get('email');
        $userId = User::where('email', $email)->first()->id;

        return view('user.auth.reset_password', compact('userId'));
    }

    public function passwordForgot()
    {
        return view('user.auth.forgot_password');
    }

    public function passwordReset(ResetPasswordRequest $request)
    {
        $params             = $request->except('_token', 'password_confirmation');
        $params['password'] = bcrypt($params['password']);

        User::find($params['id'])->update($params);

        return redirect(route('notification'))->with($this->messages['reset_password_success']);
    }

    public function sendPasswordMail(ForgotPasswordRequest $request)
    {
        $email = $request->get('email');

        list($status, $messages) = $this->resetPasswordService->sendPasswordMail($email);

        if (!$status) {
            return redirect(route('notification'))->with($messages);
        }

        return redirect(route('notification'))->with($messages);
    }
}
