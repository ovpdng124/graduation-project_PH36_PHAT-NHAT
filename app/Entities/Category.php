<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    protected $fillable = [
        "name",
    ];

    use SoftDeletes;

    public function products()
    {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }
}
