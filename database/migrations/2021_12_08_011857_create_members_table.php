<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('jamaat_id');
            $table->unsignedBigInteger('blood_group_id')->nullable();
            $table->string('card_id')->unique();
            $table->string('first_name');
            $table->string('last_name')->nullable();
            $table->tinyInteger('member_type')->comment('1 for student 2 for teacher');
            $table->date('dob')->nullable();
            $table->string('father_name')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('present_address')->nullable();
            $table->string('emergency_contact_address')->nullable();
            $table->string('contact_no')->nullable();
            $table->string('emergency_contact_no')->nullable();
            $table->tinyInteger('gender');
            $table->string('avatar')->nullable();
            $table->date('join_date')->nullable();
            $table->tinyInteger('status')->default(1)->comment('0 for inactive 1 for active');
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
        Schema::dropIfExists('members');
    }
}
