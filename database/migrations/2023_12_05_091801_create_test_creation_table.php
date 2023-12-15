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
        Schema::create('test_creation', function (Blueprint $table) {
            $table->id('test_id');
            $table->string('test_code', 20)->unique();
            $table->unsignedBigInteger('difficulties_id');
            $table->string('title', 100);
            $table->unsignedBigInteger('skills_id');
            $table->integer('category');
            $table->integer('visibility');
            $table->integer('duration');
            $table->integer('marks');
            $table->integer('pass_percentage');
            $table->integer('shuffle_questions');
            $table->integer('restrict_attempts');
            $table->integer('disable_finish_button');
            $table->integer('enable_question_list_view');
            $table->integer('hide_solutions');
            $table->integer('show_leaderboard');
            $table->integer('schedule_type');
            $table->date('start_date');
            $table->date('end_date');
            $table->time('start_time');
            $table->time('end_time');
            $table->string('test_assigned_to', 100);
            $table->enum('is_active', [1, 2]);
            $table->enum('trash_key', [1, 2]);
            $table->timestamps();
        });

        Schema::table('test_creation', function (Blueprint $table) {
            $table->foreign('difficulties_id')->references('id')->on('your_difficulties_table_name');
            $table->foreign('skills_id')->references('id')->on('your_skills_table_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('test_creation');
    }
};
