<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Entities\ProductAttributes;
use Faker\Generator as Faker;

$factory->define(ProductAttributes::class, function (Faker $faker) {
    return [
        'sub_name'   => $faker->name,
        'sub_price'  => $faker->randomFloat(null, 0, 1000000),
        'size'       => $faker->numberBetween(26, 36),
        'color'      => $faker->hexColor,
        'product_id' => $faker->numberBetween(1, 10),
    ];
});
