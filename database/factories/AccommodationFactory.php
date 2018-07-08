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

$factory->define(App\Accommodation::class, function (Faker $faker) {
    $users = \App\User::all();
    $user = $users[rand(0, count($users)-1)]->getId();
    return [
        'title' => $faker->catchPhrase(),
        'description' => $faker->text,
        'city' => $faker->city,
        'userId' => $user,
        'country' => $faker->country,
        'region' => $faker->text(40),
        'address' => $faker->address,
        'longitude' => $faker->longitude,
        'latitude' => $faker->latitude,
        'nbBedroom' => $faker->numberBetween(1,5),
        'nbBathroom' => $faker->numberBetween(1,3),
        'nbToilet' => $faker->numberBetween(1,3),
        'nbMaxBaby' => $faker->numberBetween(0,5),
        'nbMaxAdult' => $faker->numberBetween(1,14),
        'nbMaxGuest' => $faker->numberBetween(0,8),
        'nbMaxChild' => $faker->numberBetween(1,10),
        'animalsAllowed' => $faker->boolean,
        'smokersAllowed' => $faker->boolean,
        'hasInternet' => $faker->boolean,
        'propertySize' => $faker->randomFloat(2,1, 300),
        'floor' => $faker->numberBetween(1,5),
        'minStay' => $faker->numberBetween(1,7),
        'maxStay' => $faker->numberBetween(7,14),
        'type' => $faker->text(40),
        'checkinHour' => $faker->datetime,
        'checkoutHour' => $faker->datetime,
        'createdAt' => Carbon::now()->format('Y-m-d H:i:s')
    ];
});
