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
        Schema::create('test_creation_difficulty_wise_count', function (Blueprint $table) {
            $table->id();
            $table->string('test_code', 30);
            $table->unsignedBigInteger('difficulty_id');
            $table->integer('question_count');
            $table->timestamps();
        });

        Schema::table('test_creation_difficulty_wise_count', function (Blueprint $table) {
            $table->foreign('test_code')->references('test_code')->on('test_creation');
            $table->foreign('difficulty_id')->references('difficulty_id')->on('master_difficulties');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('test_creation_difficulty_wise_count');
    }
};
