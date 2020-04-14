<?php

namespace App\Helpers;

use App\Entities\Role;
use Auth;
use Carbon\Carbon;

class GlobalHelper
{
    public static $colorDefaults = [
        'Black'  => '#000000',
        'Blue'   => '#000066',
        'Red'    => '#ff0000',
        'Green'  => '#33ff33',
        'Brown' => "#aa5500",
    ];

    public static $messages = [
        'send_mail_failed'        => ['notification' => 'Send mail failed.', 'messages' => 'Please send email again!'],
        'register_success'        => ['notification' => 'Register success', 'messages' => 'Please check your email to verify account!'],
        'send_mail_success'       => ['notification' => 'Send mail success', 'messages' => 'Please check your email!'],
        'verify_success'          => ['notification' => 'Verified success', 'messages' => 'The account has been verified!'],
        'not_verify'              => ['notification' => 'Not verified.', 'messages' => 'This account is not verified, please check your email to verify your account!'],
        'reset_password_success'  => ['notification' => 'Reset password success', 'messages' => 'You can sign in your account with new password'],
        'change_password_success' => ['success' => 'Changed password successfully!'],
        'create_success'          => ['success' => 'Created successfully!'],
        'update_success'          => ['success' => 'Updated successfully!'],
        'delete_success'          => ['success' => 'Deleted successfully!'],
        'create_failed'           => ['failed' => 'Create failed!'],
        'update_failed'           => ['failed' => 'Update failed!'],
    ];

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
