<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use App\Models\Student;
use Illuminate\Support\Facades\Hash;

$factory->define(Student::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => Hash::make('12345678'),
        'phone' => $faker->phoneNumber,
        'gender' => $faker->randomElement(['1', '0'])
    ];
});
