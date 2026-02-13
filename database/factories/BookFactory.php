<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Book;
use Faker\Generator as Faker;

$factory->define(Book::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(3),
        'description' => $faker->paragraph,
        
        'isbn' => $faker->isbn13,
        // We pick a random URL from the static list we defined in the Book Model.
        'cover_url' => $faker->randomElement(Book::$covers),
        'stock' => $faker->numberBetween(0, 100),

        // IMPORTANT ANALOGY:
        // We intentionally DO NOT define 'category_id' inside here.
        // If we put 'category_id' => factory(Category::class), every time we create a book,
        // it would AUTOMATICALLY create a new category just for itself.
        // We would end up with 20 books and 20 repeated categories (Fiction, Fiction, Fiction...).
        // That's why we "inject" the category from the Seeder (the Boss).
    ];
});
    