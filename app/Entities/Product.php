<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    protected $guarded = [];

    use SoftDeletes;

    public function order_products()
    {
        return $this->hasMany(OrderProduct::class);
    }

    public function product_images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
