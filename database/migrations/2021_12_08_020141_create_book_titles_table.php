<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookTitlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_titles', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->unsignedBigInteger('language_id');
            $table->unsignedBigInteger('self_id');
            $table->json('author_id');
            $table->integer('part');
            $table->text('image')->nullable();
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
        Schema::dropIfExists('book_titles');
    }
}
