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
        Schema::create('students_test_entries', function (Blueprint $table) {
            $table->id();
            $table->integer('student_id');
            $table->string('student_reg_no', 50);
            $table->integer('course_id');
            $table->string('test_id', 50);
            $table->integer('total_questions');
            $table->integer('total_attend_questions');
            $table->string('time_taken', 50);
            $table->integer('total_attempts');
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
        Schema::dropIfExists('student_test_entries');
    }
};
