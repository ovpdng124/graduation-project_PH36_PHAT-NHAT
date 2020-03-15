<?php

namespace App\Services;

use App\Entities\User;
use App\Helpers\GlobalHelper;
use App\Mail\ResetPasswordMail;
use Mail;

class ResetPasswordService
{
    protected $message;

    public function __construct()
    {
        $this->message = GlobalHelper::getErrorMessages();
    }

    public function sendPasswordMail($email)
    {
        $user = User::where('email', $email)->first();

        if (is_null($user->verify_at)) {
            return [false, $this->message['not_verify']];
        }

        try {
            Mail::to($user->email)->send(new ResetPasswordMail($user));

            return [true, $this->message['send_mail_success']];
        } catch (Exception $exception) {
            Log::error($exception);

            return [false, $this->message['send_mail_failed']];
        }
    }
}
