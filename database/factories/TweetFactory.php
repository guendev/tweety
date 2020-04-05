<?php

/** @var Factory $factory */

use App\Models\Tweet;
use App\Models\User;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Tweet::class, function (Faker $faker) {
    return [
        'user_id'=>factory(User::class)->create()->id,
        'content'=>$faker->paragraph(),
        'count_like'=>$faker->numberBetween(1,100),
        'count_retweet'=>$faker->numberBetween(1,100),
        'count_share'=>$faker->numberBetween(1,100)
    ];
});
