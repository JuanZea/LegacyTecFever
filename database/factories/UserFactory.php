<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    $return = [
        'is_enabled' => $faker->boolean($chanceOfGettingTrue = 70),
        'name' => $faker->firstName,
        'document' => rand(1000000000, 9999999999),
        'document_type' => 'CC',
        'mobile' => rand(3210000000, 32199999999),
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
        'api_token' => Str::random(60),
    ];
    if (rand(0,1) == 1) {
        $surname = $faker->lastName;
        $return += ['surname' => $surname];
    }
        return $return;
});
