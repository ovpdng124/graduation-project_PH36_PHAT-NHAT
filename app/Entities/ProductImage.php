<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $guarded = [];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function product_attribute()
    {
        return $this->belongsTo(ProductAttributes::class);
    }
}
