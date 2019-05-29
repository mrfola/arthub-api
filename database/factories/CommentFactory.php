<?php

use Faker\Generator as Faker;

$factory->define(App\Comment::class, function (Faker $faker) {
    return [
        "user_id" =>  "1",
        "artwork_id" =>  "1",
        "comment" => $faker->text(400)
    ];
});
