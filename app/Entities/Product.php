<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];

    public function order()
    {
        return $this->hasOne(Order::class);
    }

    public function cart()
    {
        return $this->hasOne(Cart::class);
    }
}
