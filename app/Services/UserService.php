<?php

namespace App\Services;

use App\Entities\User;
use App\Filters\UserFilter;
use Auth;
use Hash;

class UserService
{
    protected $userFilter;

    public function __construct()
    {
        $this->userFilter = app(UserFilter::class);
    }

    public function getUsers($limits, $search, $searchKey)
    {
        $query = User::query();

        if (!empty($search) && !empty($searchKey)) {
            $query = $this->userFilter->search($query, $search, $searchKey);
        }

        $query = $query->with('role')->orderByDesc('created_at')->paginate($limits);

        return $query;
    }

    public function store($params)
    {
        $params['password']     = bcrypt($params['password']);
        $params['verify_token'] = $this->encodeToken($params);

        return User::create($params);
    }

    public function encodeToken($params)
    {
        return base64_encode($params['email']) . '.' . base64_encode(now());
    }

    public function updatePasswordProfile($params)
    {
        $checkPassword = false;
        $newPassword   = [
            'password' => bcrypt($params['new_password']),
        ];

        if (!empty($params['current_password'])) {
            if (Hash::check($params['current_password'], Auth::user()->getAuthPassword())) {
                Auth::user()->update($newPassword);

                return $checkPassword = true;
            }
        }

        return $checkPassword;
    }
}
