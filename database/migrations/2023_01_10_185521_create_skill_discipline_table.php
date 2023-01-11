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
        Schema::create('skill_discipline', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('skill_id');
            $table->unsignedBigInteger("discipline_id");
            $table->foreign("skill_id")->references("id")->on("skills")
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
        Schema::dropIfExists('skill_discipline');
    }
};
