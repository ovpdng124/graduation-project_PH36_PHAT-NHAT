<?php

/** @var Factory $factory */

use App\Entities\OrderProduct;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(OrderProduct::class, function (Faker $faker) {
    static $orderId;

    return [
        'order_id'             => ++$orderId,
        'product_attribute_id' => $faker->numberBetween(1, 10),
        'quantity'             => $faker->numberBetween(1, 10),
        'price'                => $faker->randomFloat(null, 0, 1000000),
    ];
});
