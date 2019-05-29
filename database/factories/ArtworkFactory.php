<?php

use Faker\Generator as Faker;

$factory->define(App\Artwork::class, function (Faker $faker) {
    return [
        "user_id" => "1",
        "title" => $faker->text(50),
        "description" => $faker->text(400)

           ];
});
