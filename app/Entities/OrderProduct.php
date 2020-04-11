<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    protected $table   = 'order_product';
    protected $guarded = [];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function product_attributes()
    {
        return $this->belongsToMany(ProductAttribute::class, 'order_product', 'id');
    }
}
