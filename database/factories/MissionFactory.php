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

$factory->define(App\Mission::class, function (Faker $faker) {
    $isActive = $faker->boolean;
    $isBooked = $faker->boolean;
    if(!$isActive){
        $isActive = false;
        $isBooked = false;
    }
    return [
        'checkoutHour' => $faker->time,
        'checkinHour' => $faker->time,
        'checkinDate' => $faker->dateTime,
        'checkoutDate' => $faker->dateTime,
        'checkinDetails' => $faker->text,
        'checkoutDetails' => $faker->text,
        'nbPersons' => $faker->numberBetween(1,10),
        'description' => $faker->text,
        'isActive' => $isActive,
        'isBooked' => $isBooked,
        'nbNights' => $faker->numberBetween(1,14),
        'created_at' => Carbon::now()->format('Y-m-d H:i:s')
    ];
});
