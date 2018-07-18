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
    $users = \App\User::all();
    $from = $users[rand(0, count($users)-1)]->getId();
    $to = $users[rand(0, count($users)-1)]->getId();
    if($from == $to){
        while($from == $to){
            $to = $users[rand(0, count($users)-1)]->getId();
        }
    }
    return [
        'content' => $faker->text,
        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        'from' => $from,
        'to' => $to
    ];
});
