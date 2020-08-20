<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
	$categories = (['computer','smartphone','accessory']);
    return [
        'name' => $faker->text(30),
        'isEnabled' => $faker->boolean($chanceOfGettingTrue = 70),
        'description' => $faker->text(900),
        'category' => $categories[rand(0,2)],
        'image' => null,
        'price' => rand(1,100000)
    ];
});
