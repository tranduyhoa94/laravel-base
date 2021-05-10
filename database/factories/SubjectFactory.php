<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use App\Models\Subject;

$factory->define(Subject::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'created_by' => $faker->name,
        'is_active' => $faker->randomElement(['1', '0'])
    ];
});
