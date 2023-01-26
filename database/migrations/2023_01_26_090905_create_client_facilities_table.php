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
        Schema::create('client_facilities', function (Blueprint $table) {
            $table->id();
            $table->string('facility_name');
            $table->string('facility_code');
            $table->string('facility_address_1');
            $table->string('facility_address_2');
            $table->string('city');
            $table->string('state');
            $table->string('zipcode');
            $table->string('facility_type');
            $table->string('contact_person');
            $table->string('contact_phone');
            $table->string('email');
            $table->string('filename');
            $table->unsignedBigInteger('facility_departments_id');
            $table->foreign('facility_departments_id')->references('id')->on('facility_departments');
            $table->unsignedBigInteger('facility_locations_id');
            $table->foreign('facility_locations_id')->references('id')->on('facility_locations');
            $table->unsignedBigInteger('facility_types_id');
            $table->foreign('facility_types_id')->references('id')->on('facility_types');
            $table->unsignedBigInteger('facility_job_classes_id');
            $table->foreign('facility_job_classes_id')->references('id')->on('facility_job_classes');
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
        Schema::dropIfExists('client_facilities');
    }
};
