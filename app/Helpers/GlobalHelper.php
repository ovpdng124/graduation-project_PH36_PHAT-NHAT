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
            'send_mail_failed' => ['notification' => 'Send mail failed.', 'messages' => 'Please login to send mail again'],
            'create_success'   => ['notification' => 'Create success.', 'messages' => 'Please check mail to verify account!'],
            'send_mail'        => ['notification' => 'Send mail success', 'messages' => 'Check your email to verify!'],
            'verify_success'   => ['notification' => 'Verify success', 'messages' => 'You can login your account!'],
            'not_verify'       => ['notification' => 'Not verify.', 'messages' => 'This account it not verify!'],
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
