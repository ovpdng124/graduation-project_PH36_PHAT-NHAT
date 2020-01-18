<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Entities\Discount;
use Faker\Generator as Faker;

$factory->define(Discount::class, function (Faker $faker) {
    return [
        'code' => $faker->currencyCode,
        'value' => $faker->numberBetween(10, 50),
        'unit' => '%',
    ];
});
