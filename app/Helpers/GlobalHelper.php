<?php


namespace App\Helpers;


use App\Entities\Role;
use Auth;

class GlobalHelper
{
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
}
