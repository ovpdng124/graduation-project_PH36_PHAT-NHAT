<?php

/** @var Factory $factory */

use App\Entities\ProductImage;
use Illuminate\Database\Eloquent\Factory;

$factory->define(ProductImage::class, function () {
    static $id, $count, $productAttributeId;

    $imageTypes = 1;

    if ($count >= 10) {
        ($id == 10) ? $id = 1: $id++;
        $imageTypes = 2;
        $productAttributeId++;
    } else {
        $id++;
    }

    $count++;

    return [
        'image_path'           => strtr('template/images/sX.jpg', 'X', $id),
        'image_type'           => $imageTypes,
        'product_id'           => $id,
        'product_attribute_id' => $productAttributeId,
    ];
});
