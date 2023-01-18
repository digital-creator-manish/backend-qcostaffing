<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('skills', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('filename');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->foreign('created_by')->references('id')->on('users');
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->foreign('updated_by')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('skills');
    }
};

/*

 * php artisan migrate:refresh --path=/database/migrations/2023_01_10_115527_create_skills_table.php
 * php artisan migrate:refresh --path=/database/migrations/2023_01_13_172235_create_disciplines_skills_table.php
 * php artisan migrate:rollback --path=/database/migrations/2023_01_13_172235_create_disciplines_skills_table.php


 * 
 * 
 * 
 */
