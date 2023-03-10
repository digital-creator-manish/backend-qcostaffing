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
    //php artisan migrate:refresh --path=/database/migrations/2023_01_10_150806_create_menuses_table.php --seed
    //C:\xampp\htdocs\qcostaffing_backend\database\migrations\2023_01_10_150806_create_menuses_table.php
    public function up()
    {
        Schema::create('menuses', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger("parent_id")->default(0);
            $table->string("name");
            $table->string("name_key");
            $table->string("priority");
            $table->unsignedInteger("status")->default(1);
            $table->unsignedInteger("menu_type")->default(1);
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
        Schema::dropIfExists('menuses');
    }
};
