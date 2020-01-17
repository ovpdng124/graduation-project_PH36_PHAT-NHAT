<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $guarded = [];

    public static $roles = [
        'Admin' => 1,
        'Guest' => 2,
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
