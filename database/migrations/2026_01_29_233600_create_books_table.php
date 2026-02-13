<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id() ;
            $table->timestamps();
            
            // string(..., 255) limits the text to 255 letters.
            $table->string('title', 255);
            $table->text('description')->nullable(); // Text can be long, so we use 'text' type.
            $table->string('isbn', 255)->unique(); // Unique ISBN, like the book's fingerprint.
            $table->string('cover_url', 255);
            $table->integer('stock'); // integer for whole numbers (quantity of books).

            // STRONG RELATIONSHIP (The Rope)
            // constrained('categories'): We "tie" this book to the 'categories' table.
            // onDelete('cascade'): DOMINO EFFECT ANALOGY.
            // If we delete a Category (e.g. "Science Fiction"), ALL books belonging to it are automatically deleted.
            // Be careful with this! It prevents leaving "orphan" books in the database.
            $table->foreignId('author_id')->constrained('authors')->onDelete('cascade');
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books');
    }
}
