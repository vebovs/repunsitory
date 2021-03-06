<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Pun::class, function (Faker $faker) {
    return [
        'title' => $faker->text(15),
        'body' => $faker->text(500),
        'user_id' => App\User::all()->random()->id,
        'likes' => $faker->numberbetween(0,10)
    ];
});
