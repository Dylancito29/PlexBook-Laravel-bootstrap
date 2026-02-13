<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;
use App\Category;
use App\Book;
use App\Loan;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // 1. MANUAL ROLE CREATION
        // We create specific roles "by hand" because they are fundamental and fixed.
        Role::Create(['Rol_name' => 'admin']);
        Role::Create(['Rol_name' => 'user']);


        // 2. USER CREATION (The Population)
        // ANALOGY: We use the "Factory" to clone 10 users.
        // create() is the command that says: "Build them and save them to the database RIGHT NOW".
        factory(User::class, 10)->create();

        // 3. CATEGORY CREATION (The Labels)
        // We create 5 random categories using their recipe (Factory).
        factory(Category::class, 5)->create();

        // 4. SMART ASSIGNMENT (The Trick)
        // We retrieve all the categories we just created.
        // It's like taking all available labels and spreading them out on a table.
        $categories = Category::all();

        $authors = factory(App\Author::class, 10)->create(); // Create 10 authors

        // ANALOGY OF THE PROCESS:
        // A. factory(...)->make(): Creates 20 books in "memory" (imaginary, drafts), NOT in the database yet.
        // B. each(...): Takes each book draft one by one and...
        // C. Sticks a label (category_id) chosen at random from our table ($categories).
        // D. $book->save(): NOW YES, saves the definitive book to the shelf (Database).
        // * This prevents the book from automatically creating its own new category and duplicating data unnecessarily.
        factory(Book::class, 20)->make()->each(function ($book) use ($categories, $authors) {
            $book->category_id = $categories->random()->id;
            $book->author_id = $authors->random()->id;
            $book->save();

        });


        // 5. LOAN GENERATION (The Logbook)
        // Finally, we simulate some activity in the library.
        // We create 15 records of "Who borrowed What".
        // The LoanFactory handles picking a random user, a random book, and setting a realistic status for each entry.
        factory(Loan::class, 15)->create();

    }
}



    

