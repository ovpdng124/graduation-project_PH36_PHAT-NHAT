<?php


namespace App\Helpers;


use App\Entities\Role;
use Auth;

class GlobalHelper
{
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
