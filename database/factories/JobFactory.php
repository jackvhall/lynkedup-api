<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Job;
use Faker\Generator as Faker;

$factory->define(Job::class, function (Faker $faker) {
    return [
        'title' => $faker->word,
        'organization' => $faker->word,
        'description' => $faker->text,
        'salary_start' => $faker->randomFloat(2, 2000000),
        'salary_end' => $faker->randomFloat(2, 50000000),
        'type' => 'full-time'
    ];
});
