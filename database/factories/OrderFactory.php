<?php

/** @var Factory $factory */

use App\Entities\Order;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Order::class, function (Faker $faker) {
    $order_label = 'BI-' . $faker->monthName . '-' . $faker->numberBetween(1, 10);

    return [
        'user_id'     => $faker->numberBetween(1, 3),
        'voucher_id'  => $faker->numberBetween(1, 10),
        'total_price' => $faker->randomFloat(null, 0, 100000),
        'quantity'    => $faker->numberBetween(1, 10),
        'method_type' => $faker->numberBetween(1, 2),
        'status'      => $faker->numberBetween(0, 4),
        'is_sale'     => $faker->boolean,
        'sale_price'  => $faker->randomFloat(null, 0, 100000),
        'order_label' => $order_label,
    ];
});
