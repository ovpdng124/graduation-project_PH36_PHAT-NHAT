<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
        "name",
    ];

    public static $roles = [
        'Admin' => 1,
        'User'  => 2,
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
