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
        Schema::create('facility_tutorial_quizzes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('facility_tutorial_id')->nullable();
            $table->foreign('facility_tutorial_id')->references('id')->on('facility_tutorials');
            $table->string('question')->nullable();
            $table->string('opt1')->nullable();
            $table->string('opt2')->nullable();
            $table->string('opt3')->nullable();
            $table->string('opt4')->nullable();
            $table->string('answer')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->foreign('created_by')->references('id')->on('users');
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
        Schema::dropIfExists('facility_tutorial_quizzes');
    }
};
