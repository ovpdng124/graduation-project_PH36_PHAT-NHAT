<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductAttribute extends Model
{
    protected $fillable = [
        "sub_name",
        "sub_price",
        "size",
        "color",
        "product_id",
    ];

    use SoftDeletes;

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
