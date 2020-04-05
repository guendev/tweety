<?php

/** @var Factory $factory */

use App\Models\Reply;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Reply::class, function (Faker $faker) {
    return [
        'user_id'=>$faker->numberBetween(1,10),
        'content'=>$faker->paragraph
    ];
});
