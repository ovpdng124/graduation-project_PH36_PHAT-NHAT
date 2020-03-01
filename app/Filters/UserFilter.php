<?php

namespace App\Filters;

class UserFilter extends FilterBase
{
    public function searchByFullName($query, $search)
    {
        return $query->where('full_name', 'like', "%$search%");
    }

    public function searchByEmail($query, $search)
    {
        return $query->where('email', 'like', "%$search%");
    }

    public function searchByUserName($query, $search)
    {
        return $query->where('userName', 'like', "%$search%");
    }

    public function searchByPhoneNumber($query, $search)
    {
        return $query->where('phone_number', 'like', "%$search%");
    }

}
