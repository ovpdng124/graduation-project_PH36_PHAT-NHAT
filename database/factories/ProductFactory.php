<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Entities\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name'        => $faker->name,
        'description' => $faker->text,
        'quantity'    => $faker->numberBetween(1, 10),
        'price'       => $faker->randomFloat(null, 0, 1000000),
        'thumbnail'   => $faker->word,
        'slide'       => $faker->word,
        'category_id' => $faker->numberBetween(1, 10),
    ];
});
