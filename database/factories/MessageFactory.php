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

$factory->define(App\Message::class, function (Faker $faker) {
    $candidates = \App\Candidate::all();
    $candidate = $candidates[rand(0, count($candidates)-1)]->getId();
    $missions = \App\Mission::all();
    $mission = $missions[rand(0, count($missions)-1)]->getId();
    return [
        'content' => $faker->text,
        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        'candidate' => $candidate,
        'mission' => $mission
    ];
});
