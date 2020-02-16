<?php

use Illuminate\Database\Seeder;

class PunsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Pun::class, 30)->create();
    }
}
