<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Author;
use Faker\Generator as Faker;

$factory->define(Author::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'biography' => $faker->paragraph,
        'website' => $faker->url,
        // We pick a random URL from the static list we defined in the Author Model.
        'photo_url' => $faker->randomElement(Author::$authors_picture)
        // Note: 'photo_url' can be null, so we don't need to set it
    ];
});
