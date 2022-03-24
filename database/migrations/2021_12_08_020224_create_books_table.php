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
            $table->id();
            $table->string('title');
            $table->integer('book_no')->unique();
            $table->text('image')->nullable();
            $table->unsignedBigInteger('title_id');
            $table->unsignedBigInteger('language_id');
            $table->unsignedBigInteger('self_id')->nullable();
            $table->unsignedBigInteger('jamaat_id');
            $table->string('taak')->nullable();
            $table->integer('part');
            $table->double('price');
            $table->tinyInteger('borrow_status')->default(0)->comment('1 for reserved 0 for available');
            $table->tinyInteger('book_status')->default(1)->comment('1 for available 0 for lost');
            $table->date('purchase_at')->nullable();
            $table->date('lost_at')->nullable();
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
        Schema::dropIfExists('books');
    }
}
