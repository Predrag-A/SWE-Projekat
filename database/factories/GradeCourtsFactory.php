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

$factory->define(App\GradeCourt::class, function (Faker $faker) {
    return [        
        'court_id' => rand(1, 6),
        'user_id' => rand(1, 103),
        'grade' => $faker->biasedNumberBetween($min=1, $max=5, $function='sqrt')
    ];
});
