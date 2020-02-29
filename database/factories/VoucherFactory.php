<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Entities\Voucher;
use Faker\Generator as Faker;

$factory->define(Voucher::class, function (Faker $faker) {
    return [
        'code'  => $faker->currencyCode,
        'value' => $faker->numberBetween(10, 50),
        'unit'  => '%',
    ];
});
