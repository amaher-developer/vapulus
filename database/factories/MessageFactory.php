<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Message;
use Faker\Generator as Faker;

$factory->define(Message::class, function (Faker $faker) {
    return [
        'room_id' => $faker->numberBetween(1, 10),
        'user_id' => $faker->numberBetween(1, 100),
        'message' => $faker->text,
    ];
});
