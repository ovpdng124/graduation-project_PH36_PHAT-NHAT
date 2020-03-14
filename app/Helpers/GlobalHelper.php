<?php

namespace App\Helpers;

use App\Entities\Role;
use Auth;
use Carbon\Carbon;

class GlobalHelper
{
    public static $colorDefaults = [
        'White' => "#ffffff",
        'Black' => '#000000',
        'Blue'  => '#000066',
        'Red'   => '#ff0000',
        'Green' => '#33ff33',
    ];

    public static function getErrorMessages()
    {
        return [
            'send_mail_failed'       => ['notification' => 'Send mail failed.', 'messages' => 'Please send email again!'],
            'register_success'       => ['notification' => 'Register success', 'messages' => 'Please check your email to verify account!'],
            'send_mail_success'      => ['notification' => 'Send mail success', 'messages' => 'Please check your email!'],
            'verify_success'         => ['notification' => 'Verified success', 'messages' => 'The account has been verified!'],
            'not_verify'             => ['notification' => 'Not verified.', 'messages' => 'This account is not verified, please check your email to verify your account!'],
            'reset_password_success' => ['notification' => 'Reset password success', 'messages' => 'You can sign in your account with new password'],
        ];
    }

    public static function checkAdminRole()
    {
        $user = Auth::user();

        return $user->role_id === Role::$roles['Admin'];
    }

    public static function snakeCaseToPascalCase($string)
    {
        return str_replace('_', '', ucwords($string, '_'));
    }

    public static function checkExpiredDate($dateTime, $timeLimit)
    {
        return now()->diffInDays(Carbon::parse($dateTime)) > $timeLimit;
    }
}
