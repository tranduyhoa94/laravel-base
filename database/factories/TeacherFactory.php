<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use App\Models\Teacher;

$factory->define(Teacher::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => '12345678',
        'phone' => $faker->phoneNumber,
        'gender' => $faker->randomElement(['1', '0'])
    ];
});
