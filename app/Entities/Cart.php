<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class)->withTrashed();
    }

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
