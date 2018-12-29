<?php
use App\Topic;

use Faker\Generator as Faker;

$factory->define(Topic::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'bio' => $faker->paragraph
    ];
});
