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
            $table->string('facility_name')->nullable();
            $table->string('facility_code')->nullable();
            $table->string('facility_address_1')->nullable();
            $table->string('facility_address_2')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('zipcode')->nullable();
            $table->string('facility_type')->nullable();
            $table->string('contact_person')->nullable();
            $table->string('contact_phone')->nullable();
            $table->string('email')->nullable();
            $table->string('filename')->nullable();
            $table->unsignedBigInteger('facility_departments_id')->nullable();
            $table->foreign('facility_departments_id')->references('id')->on('facility_departments');
            $table->unsignedBigInteger('facility_locations_id')->nullable();
            $table->foreign('facility_locations_id')->references('id')->on('facility_locations');
            $table->unsignedBigInteger('facility_types_id')->nullable();
            $table->foreign('facility_types_id')->references('id')->on('facility_types');
            $table->unsignedBigInteger('facility_job_classes_id')->nullable();
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
