<?php

/** @var Factory $factory */

use App\Entities\ProductImage;
use Illuminate\Database\Eloquent\Factory;

$factory->define(ProductImage::class, function () {
    static $id = 1;

    return [
        'image_path'           => 'template/images/s' . $id . '.jpg',
        'image_type'           => 1,
        'product_id'           => $id,
        'product_attribute_id' => $id++,
    ];
});
