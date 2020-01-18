<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Entities\Order;
use Faker\Generator as Faker;

$factory->define(Order::class, function (Faker $faker) {
    return [
        'user_id'    => $faker->numberBetween(1, 3),
        'product_id' => $faker->numberBetween(1, 10),
        'total'      => $faker->randomFloat(null, 0, 100000),
        'quantity'   => $faker->numberBetween(1, 10),
        'method'     => $faker->randomElement(['COD', 'Bank card']),
        'status'     => $faker->boolean,
    ];
});
