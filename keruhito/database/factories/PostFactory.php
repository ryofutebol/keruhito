<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'user_id' => $faker->randomNumber(),
        'title' => $faker->name(),
        'content' => $faker->word(),
        'image' => $faker->word() . '.jpg',
    ];
});
