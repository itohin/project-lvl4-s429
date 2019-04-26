<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Task;
use Faker\Generator as Faker;

$factory->define(Task::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence,
        'description' => $faker->paragraph,
        'creator_id' => factory(\App\User::class),
        'status_id' => 1,
        'assigned_id' => factory(\App\User::class)
    ];
});
