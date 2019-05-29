<?php

use Faker\Generator as Faker;

$factory->define(App\Vote::class, function (Faker $faker) {
    return [
        "user_id" =>  "1",
        "artwork_id" =>  "1",
        "vote" => $faker->boolean
    ];
});
