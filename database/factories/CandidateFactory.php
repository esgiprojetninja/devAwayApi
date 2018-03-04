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

$factory->define(App\Candidate::class, function (Faker $faker) {
    return [
        'status' => $faker->numberBetween(0,2),
        'fromDate' => $faker->dateTime,
        'toDate' => $faker->dateTime,
        'created_at' => Carbon::now()->format('Y-m-d H:i:s')
    ];
});
