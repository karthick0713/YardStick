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
        Schema::create('test_category_wise_duration', function (Blueprint $table) {
            $table->id();
            $table->string('test_code', 50);
            $table->string('category_id', 50);
            $table->integer('time_duration');
            $table->timestamps();
            $table->foreign('test_code')->references('test_code')->on('test_creation')->onDelete('cascade');
            $table->foreign('category_id')->references('category_id')->on('master_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('test_category_wise_duration');
    }
};
