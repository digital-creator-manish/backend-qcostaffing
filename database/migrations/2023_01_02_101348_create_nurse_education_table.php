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
        Schema::create('nurse_education', function (Blueprint $table) {
            $table->id();
			$table->unsignedBigInteger('nurse_id');
            $table->string('education_type');
            $table->string('name_school_address');
            $table->string('course');
            $table->string('diploma');
            $table->string('years_completed');
            $table->string('other_skills');
            
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
        Schema::dropIfExists('nurse_education');
    }
};
