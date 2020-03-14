<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class ProductAttributes extends Model
{
    protected $guarded = [];

    public function product_images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
