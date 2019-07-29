<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Reservation;
use App\User;
use Faker\Generator as Faker;

$factory->define(Reservation::class, function (Faker $faker) {
    return [
        'user_id' => factory(User::class)->create()->id,
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'phone' => $faker->phoneNumber,
        'seats' => $faker->numberBetween(1,200),
        'date' => $faker->dateTimeBetween($startDate = 'now', $endDate = '+1 years'),
    ];
});
