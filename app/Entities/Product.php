<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Product
 * @package App\Entities
 * @mixin \Eloquent
 */
class Product extends Model
{
    protected $fillable = [
        "name",
        "description",
        "price",
        "category_id",
    ];

    use SoftDeletes;

    public function product_images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function product_attributes()
    {
        return $this->hasMany(ProductAttribute::class);
    }
}
