<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user')->insert([
            'username' => "r.lambot",
            'email' => "lambot.rom@gmail.com",
            'password' => password_hash("Rootroot9", PASSWORD_BCRYPT),
            'firstName' => "Romain",
            'lastName' => "LAMBOT",
            'languages' => "French, English",
            'skills' => "PHP",
            'isActive' => 1,
            'remember_token' => str_random(10),
            'roles' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        factory(App\User::class, 20)->create();
        factory(App\Accommodation::class, 20)->create();
        factory(App\Picture::class, 20)->create();
        factory(App\Mission::class, 20)->create();
        factory(App\Candidate::class, 20)->create();
        factory(App\Message::class, 500)->create();
    }
}
