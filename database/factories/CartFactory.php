<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Entities\Cart;
use Faker\Generator as Faker;

$factory->define(Cart::class, function (Faker $faker) {
    return [
        'user_id'    => $faker->numberBetween(1, 3),
        'product_id' => $faker->numberBetween(1, 10),
        'quantity'   => $faker->numberBetween(1, 10),
    ];
});
