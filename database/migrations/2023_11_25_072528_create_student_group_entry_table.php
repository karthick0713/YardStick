<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_group_entry', function (Blueprint $table) {
            $table->id('group_entry_id');
            $table->unsignedBigInteger('students_id');
            $table->string('students_name', 50);
            $table->unsignedBigInteger('group_id');
            $table->timestamps();
            $table->foreign('students_id')->references('student_id')->on('master_students');
            $table->foreign('group_id')->references('group_id')->on('student_group');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_group_entry');
    }
};
