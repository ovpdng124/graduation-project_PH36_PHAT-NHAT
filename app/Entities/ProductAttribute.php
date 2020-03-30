<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class ProductAttribute extends Model
{
    protected $guarded = [];

    public function product_images()
    {
        return $this->hasMany(ProductImage::class, 'product_attribute_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function order_products()
    {
        return $this->hasMany(OrderProduct::class, 'product_attribute_id');
    }

}
