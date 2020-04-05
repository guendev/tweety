<?php

/** @var Factory $factory */

use App\Models\Follow;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Follow::class, function (Faker $faker) {
    return [
        'user_id'           =>      $faker->numberBetween(1,10),
        'user_follow_id'    =>      $faker->numberBetween(1,10)
    ];
});
