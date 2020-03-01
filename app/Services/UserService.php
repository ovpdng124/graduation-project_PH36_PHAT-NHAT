<?php

namespace App\Services;

use App\Entities\User;
use App\Filters\UserFilter;

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

    public function encodeToken($params)
    {
        return base64_encode($params['email']) . '.' . base64_encode(now());
    }
}
