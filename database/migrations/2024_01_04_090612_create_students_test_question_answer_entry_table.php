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
        Schema::create('students_test_questions_answers_entry', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('test_entry_id');
            $table->string('student_reg_no', 50);
            $table->string('test_code', 50);
            $table->unsignedBigInteger('course_id');
            $table->string('time_taken_for_each_question', 12);
            $table->integer('mark_for_each_question');
            $table->string('question_code', 50);
            $table->text('question');
            $table->string('answer_selected', 12);
            $table->string('correct_answer', 12);
            $table->timestamps();

            // $table->foreign('test_entry_id')->references('id')->on('your_test_entries_table')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students_test_question_answer_entry');
    }
};
