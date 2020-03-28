<?php

/** @var Factory $factory */

use App\Entities\Order;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Order::class, function (Faker $faker) {
    $userId      = $faker->numberBetween(1, 3);
    $voucherId   = $faker->randomElement([null, $faker->numberBetween(1, 10)]);
    $isSale      = ($voucherId) ? true : false;
    $salePrice   = ($isSale) ? $faker->randomFloat(null, 0, 100000) : null;
    $order_label = 'BI' . strtoupper(now()->monthName) . now()->day . now()->year . $userId;

    return [
        'user_id'     => $userId,
        'voucher_id'  => $voucherId,
        'total_price' => $faker->randomFloat(null, 0, 100000),
        'quantity'    => $faker->numberBetween(1, 10),
        'method_type' => $faker->numberBetween(1, 2),
        'status'      => $faker->numberBetween(0, 4),
        'is_sale'     => $isSale,
        'sale_price'  => $salePrice,
        'order_label' => $order_label,
    ];
});
