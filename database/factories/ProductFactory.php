<?php

/** @var Factory $factory */

use App\Product;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Product::class, function (Faker $faker) {
	$categories = (['computer','smartphone','accessory']);
    return [
        'name' => $faker->text(30),
        'is_enabled' => $faker->boolean($chanceOfGettingTrue = 70),
        'description' => $faker->text(900),
        'category' => $categories[rand(0,2)],
        'image' => null,
        'price' => rand(1,19900)*50+5000, // prices between 1 and 1'000,000 cop
        'stock' => rand(0, 500)
    ];
});
