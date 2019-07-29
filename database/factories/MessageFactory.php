<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Message;
use App\User;
use Faker\Generator as Faker;

$factory->define(Message::class, function (Faker $faker) {
    return [
        'user_id' => factory(User::class)->create()->id,
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'subject' => $faker->sentence(5),
        'message' => $faker->text(250),
    ];
});
