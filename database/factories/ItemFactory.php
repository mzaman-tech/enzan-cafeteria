<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Item;
use Faker\Generator as Faker;

$factory->define(Item::class, function (Faker $faker) {
    return [
        'name' => $faker->words(2, true) ,
        'price' => $faker->numberBetween(10, 25) * 100,
        'image' => null,
        'is_available' => $faker->boolean,
    ];
});
