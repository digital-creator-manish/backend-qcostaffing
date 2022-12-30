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
        Schema::create('nurse_duties', function (Blueprint $table) {
            $table->id();
			$table->unsignedBigInteger('nurse_id');
			$table->string('available_duty');
			$table->string('available_dutytime');
			$table->string('available_day');
            $table->timestamps();
			$table->foreign('nurse_id')->references('id')->on('nurses')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {	
        Schema::dropIfExists('nurse_duties');
    }
};
