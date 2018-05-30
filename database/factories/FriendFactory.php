<?php

use Faker\Generator as Faker;

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

$factory->define(App\Friend::class, function (Faker $faker) {
    return [        
        'requester' => rand(1, 3),
        'user_requested' => $faker->unique()->numberBetween(4,103),
        'status' => rand(0, 1)
    ];
});
