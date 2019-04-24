<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Task;
use Faker\Generator as Faker;

$factory->define(Task::class, function (Faker $faker) {
    $creator = $faker->numberBetween(1, 50);
    $assigned = $creator < 40 ? $creator + 10 : $creator - 10;

    return [
        'name' => $faker->sentence,
        'description' => $faker->paragraph,
        'creator_id' => $creator,
        'assigned_id' => $assigned
    ];
});
