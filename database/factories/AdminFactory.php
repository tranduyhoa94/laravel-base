<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Models\Admin;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;

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

$factory->define(Admin::class, function (Faker $faker) {
    return [
        'name' => 'admin',
        'email' => 'admin@gmail.com',
        'is_super_admin' => 1,
        'password' => '12345678',
    ];
});
