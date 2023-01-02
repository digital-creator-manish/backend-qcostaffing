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
        Schema::create('nurses', function (Blueprint $table) {
            $table->id();
			$table->string('lname');
			$table->string('fname');
			$table->string('m_initial');
			$table->string('maiden_name');
			$table->string('social_security_number');
			$table->string('home_phone', 25);
			$table->string('cell_phone', 25);
			$table->string('work_number', 25);
			$table->string('us_citizen', 1);
			$table->string('driver_license', 1);
			$table->date('birth_date');
			$table->string('emergency', 250);
			$table->string('relationship_applicant', 100);
			$table->string('phone', 25);
			$table->string('emergency_address', 250);
			$table->string('street', 50);
			$table->string('email', 50);
			$table->string('city', 25);
			$table->string('state', 25);
			$table->string('zipcode', 25);
			$table->string('p_street', 50);
			$table->string('p_city', 25);
			$table->string('p_state', 25);
			$table->string('p_zipcode', 25);
			$table->string('license_certification', 100);
			$table->string('number', 100);
			$table->string('issuing_organization', 100);
			$table->date('expiration_date');
			$table->string('present_employer', 4);
			$table->string('present_organization', 100);
			$table->string('present_supervisor', 50);
			$table->string('present_address', 50);
			$table->string('verify_employment_phone', 25);
			$table->date('employment_date');
			$table->string('employment_salary');
			$table->string('reason_leaving');
			$table->date('created_date');
			$table->string('user_id');
			$table->string('password1');
			$table->string('app_house');
			$table->string('hear_about');
			$table->string('comment');
			$table->string('active', 1);
			$table->string('initial', 50);
			$table->date('last_login');
			$table->string('archive', 1);
			$table->string('disciplines');
			$table->string('gender', 25);
			$table->string('myresume');
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
        Schema::dropIfExists('nurses');
    }
};
