<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
        factory(\App\Room::class, 10)->create();
        factory(\App\User::class, 100)->create();
        factory(\App\Message::class, 1000)->create();
    }
}
