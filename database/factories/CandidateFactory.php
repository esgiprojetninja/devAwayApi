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
    $users = \App\User::all();
    $user = $users[rand(0, count($users)-1)]->getId();
    $missions = \App\Mission::all();
    $mission = $missions[rand(0, count($missions)-1)]->getId();
    return [
        'status' => $faker->numberBetween(0,2),
        'fromDate' => $faker->dateTime,
        'toDate' => $faker->dateTime,
        'mission_id' => $mission,
        'user' => $user,
        'created_at' => Carbon::now()->format('Y-m-d H:i:s')
    ];
});
