<?php

/** @var Factory $factory */

use App\Models\Tag;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Tag::class, function (Faker $faker) {
    return [
        'tag'=>$faker->text(10)
    ];
});
