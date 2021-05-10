<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Models\Schedule;
use Faker\Generator as Faker;
use Illuminate\Support\Carbon;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(Schedule::class, function (Faker $faker) {
    $startTime = $faker->dateTimeBetween($startDate = '-2 months', $endDate = '+ 2 months', $timezone = null)
        ->format('Y-m-d H:i:s');
    return [
        'topic_id' => function () {
            return factory(\App\Models\Topic::class)->create()->id;
        },
        'room_id' => function () {
            return factory(\App\Models\Room::class)->create()->id;
        },
        'teacher_id' => function () {
            return factory(\App\Models\Teacher::class)->create()->id;
        },
        'is_active' => rand(0, 1),
        'start_time' => (new Carbon($startTime))->setTimezone('UTC'),
        'end_time' => (new Carbon($startTime))->copy()->addMinutes('120'),
        'name' => $faker->text($maxNbChars = 50),
    ];
});
