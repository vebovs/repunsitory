<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(PunsTableSeeder::class);
        $this->call(LikesTableSeeder::class);

        //Test user
        DB::table('users')->insert([
            'username' => 'user',
            'email' => 'user@user.com',
            'email_verified_at' => now(),
            'password' => bcrypt('secret'),
            'remember_token' => Str::random(10),
            'role' => 1
        ]);

        //Test admin
        DB::table('users')->insert([
            'username' => 'admin',
            'email' => 'admin@admin.com',
            'email_verified_at' => now(),
            'password' => bcrypt('secret'),
            'remember_token' => Str::random(10),
            'role' => 2
        ]);
    }
}
