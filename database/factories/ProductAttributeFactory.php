<?php

/** @var Factory $factory */

use App\Entities\ProductAttribute;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(ProductAttribute::class, function (Faker $faker) {
    static $productId;

    return [
        'sub_name'   => $faker->name,
        'sub_price'  => $faker->randomFloat(null, 0, 1000000),
        'size'       => $faker->numberBetween(26, 36),
        'color'      => $faker->hexColor,
        'product_id' => ++$productId,
    ];
});
