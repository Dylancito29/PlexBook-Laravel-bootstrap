<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuthorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('authors', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255); // Name of the author, limited to 255 characters.
            $table->string('email', 255)->nullable(); // Email for the author, can be null.
            $table->text('biography')->nullable(); // Biography of the author, can be null.
            $table->string('website', 255)->nullable(); // Author's website, can be null.
            $table->string('photo_url', 255)->nullable(); // URL for the author's photo, can be null.   
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('authors');
    }
}
