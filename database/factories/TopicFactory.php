<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use App\Models\Topic;

$factory->define(Topic::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'subject_id' => function () {
            return factory(\App\Models\Subject::class)->create()->id;
        },
        'is_active' => rand(0, 1)
    ];
});
