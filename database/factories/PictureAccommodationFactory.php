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

$factory->define(App\PictureAccommodation::class, function (Faker $faker) {
    $accommodations = \App\Accommodation::all();
    $accommodation = $accommodations[rand(0, count($accommodations)-1)]->getId();
    $imagedata = file_get_contents($faker->imageUrl());
    $base64 = base64_encode($imagedata);
    return [
        'url' => $base64,
        'accommodation_id' => $accommodation,
        'created_at' => Carbon::now()->format('Y-m-d H:i:s')
    ];
});
