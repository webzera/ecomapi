<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Product;
use App\User;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'user_id' => function(){
    		return User::all()->random();
    	},
        'details'=> $faker->paragraph,
        'price' => $faker->numberBetween(100, 999),
        'stock' => $faker->randomDigit,
        'discount' => $faker->numberBetween(2, 30),
    ];
});
