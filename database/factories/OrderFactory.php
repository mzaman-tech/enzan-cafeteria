<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Item;
use App\Order;
use Faker\Generator as Faker;

$factory->define(Order::class, function (Faker $faker) {

    $item = Item::all()->random();
    $quantity = $faker->numberBetween(1, 5);

    return [
        'item_id' => $item->id,
        'quantity' => $quantity,
        'total_price' => $item->price * $quantity,
        'customer_name' => $faker->name,
        'customer_addess' => $faker->address,
        'delivery_time' => mt_rand(1262055681,1262055681),
        'is_delivered' => $faker->boolean,
    ];
});
