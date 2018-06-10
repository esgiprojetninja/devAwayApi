<?php

use Faker\Generator as Faker;
use Carbon\Carbon;

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

$factory->define(App\User::class, function (Faker $faker) {
    $imagedata = file_get_contents($faker->imageUrl());
    $base64 = base64_encode($imagedata);
    return [
        'username' => $faker->unique()->userName,
        'email' => $faker->unique()->safeEmail,
        'password' => password_hash($faker->text, PASSWORD_BCRYPT),
        'firstName' => $faker->firstName,
        'lastName' => $faker->lastName,
        'languages' => $faker->text(40),
        'skills' => $faker->text(40),
        'isActive' => $faker->boolean,
        'remember_token' => str_random(10),
        'roles' => $faker->numberBetween(0,1),
        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        'avatar' => $base64
    ];
});
