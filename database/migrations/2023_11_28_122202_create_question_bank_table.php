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
        Schema::create('question_banks', function (Blueprint $table) {
            $table->id('question_id');
            $table->string('question_code');
            $table->unsignedBigInteger('skills_id');
            $table->foreign('skills_id')->references('skill_id')->on('master_skills');
            $table->unsignedBigInteger('difficulties_id');
            $table->foreign('difficulties_id')->references('difficulty_id')->on('master_difficulties');
            $table->unsignedBigInteger('topics_id');
            $table->foreign('topics_id')->references('topic_id')->on('master_topics');
            $table->integer('category');
            $table->text('questions');
            $table->text('solutions');
            $table->string('correct_option', 10);
            $table->enum('is_active', [1, 2]);
            $table->enum('trash_key', [1, 2]);
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
        Schema::dropIfExists('question_bank');
    }
};
