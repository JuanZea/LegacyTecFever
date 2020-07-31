<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
	$categories = (['computer','smartphone','accessory']);
    return [
        'name' => $faker->sentence(6),
        'description' => $faker->text(1000),
        'category' => $categories[rand(0,2)],
        'image' => 'images/'.$faker->image('public/storage/images',640,480, null, false),
        'price' => rand(1,1000000)
    ];
});
