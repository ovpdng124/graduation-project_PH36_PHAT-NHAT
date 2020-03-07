<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $guarded = [];

    public static $paths = [
        'Avatar'    => 'images/avatars/',
        'Thumbnail' => 'images/thumbnails',
    ];

    public static $types = [
        'Avatar'    => 1,
        'Thumbnail' => 2,
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function product_attribute()
    {
        return $this->belongsTo(ProductAttributes::class);
    }
}
