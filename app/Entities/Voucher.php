<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Voucher extends Model
{
    protected $fillable = [
        "code",
        "value",
        "unit",
    ];

    use SoftDeletes;

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
