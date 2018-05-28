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

$factory->define(App\Comment::class, function (Faker $faker) {
    return [
        'content' => $faker->paragraph($nbSentences = 2, $variableNbSentences = true),
        'user_id' => rand(1, 100),
        'event_id' => rand(1, 9),
    ];
});
