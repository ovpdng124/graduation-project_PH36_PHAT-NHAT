<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Entities\Order;
use Faker\Generator as Faker;

$factory->define(Order::class, function (Faker $faker) {
    return [
        'user_id'     => $faker->numberBetween(1, 3),
        'voucher_id'  => $faker->numberBetween(1, 10),
        'total_price' => $faker->randomFloat(null, 0, 100000),
        'quantity'    => $faker->numberBetween(1, 10),
        'method_type' => $faker->numberBetween(1, 2),
        'status'      => $faker->numberBetween(0, 3),
        'is_sale'     => $faker->boolean,
        'sale_price'  => $faker->randomFloat(null, 0, 100000),
    ];
});
