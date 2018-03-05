<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class, 20)->create();
        factory(App\Picture::class, 20)->create();
        factory(App\Accommodation::class, 20)->create();
        factory(App\Candidate::class, 20)->create();
        factory(App\Message::class, 20)->create();
        factory(App\Mission::class, 20)->create();
    }
}
