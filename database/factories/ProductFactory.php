<?php

/** @var Factory $factory */

use App\Product;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Product::class, function (Faker $faker) {
	$categories = (['computer','smartphone','accessory']);
    return [
        'name' => $faker->text(30),
        'is_enabled' => rand(0,6) != 0 ? 1 : 0,
        'description' => $faker->text(900),
        'category' => $categories[rand(0,2)],
        'image' => null,
        'price' => rand(1,59900)*50+5000, // prices between 5000 and 3'000,000 cop
        'stock' => rand(0, 500),
    ];
});
