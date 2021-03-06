<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Like::class, function (Faker $faker) {
    return [
        'user_id' => App\User::all()->random()->id,
        'user_email' => App\User::all()->random()->email,
        'pun_id' => App\Pun::all()->random()->id
    ];
});
