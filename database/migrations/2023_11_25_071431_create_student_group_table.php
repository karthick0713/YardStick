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
        Schema::create('student_group', function (Blueprint $table) {
            $table->id('group_id');
            $table->string('group_name', 255);
            $table->unsignedBigInteger('college_id');
            $table->unsignedBigInteger('department_id');
            $table->integer('year');
            $table->integer('semester');
            $table->enum('is_active', [1, 2]);
            $table->enum('trash_key', [1, 2]);
            $table->foreign('college_id')->references('college_id')->on('master_colleges');
            $table->foreign('department_id')->references('department_id')->on('master_departments');
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
        Schema::dropIfExists('student_group');
    }
};