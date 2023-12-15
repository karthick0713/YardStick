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
        Schema::create('question_bank_entry', function (Blueprint $table) {
            $table->id();
            $table->string('question_code', 20);
            $table->foreign('question_code')->references('question_code')->on('question_banks');
            $table->string('title_name', 100);
            $table->text('description')->nullable();
            $table->string('correct_answer', 10);
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
        Schema::dropIfExists('question_bank_entry');
    }
};
