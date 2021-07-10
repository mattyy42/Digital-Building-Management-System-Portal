<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlanConsentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plan__consents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('sub_city');
            $table->string('new_woreda');
            $table->string('street_address');
            $table->string('house_number');
            $table->string('ownership_authentication_number');
            $table->string('ownership_authentication_type');//either existing or lease 
            $table->date('ownership_authentication_issued_date');
            $table->string('name_stated_on_ownership_authentication');


            $table->string('previous_service');// residentioal shop bearaue hotel appartament store factory health schools other
            $table->string('type_of_construction');// new renewal change of service other
            $table->string('method_of_construction')->nullable(); //built once one by one 
            $table->unsignedBigInteger('application_id')->nullable();
            $table->foreign('application_id')->references('id')->on('applications')->onDelete('cascade');
            $table->unsignedBigInteger('application_issued_date')->nullable();
            $table->foreign('application_issued_date')->references('id')->on('applications')->onDelete('cascade');
            $table->unsignedBigInteger('ground_floor_number')->nullable();
            $table->foreign('ground_floor_number')->references('id')->on('construction_types');

            $table->string('owner_full_name');
            $table->string('reperesentative_full_name')->nullable();
            $table->string('phone_number');
            $table->string('mobile_number');
            $table->string('TIN_number')->nullable();

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
        Schema::dropIfExists('plan__consents');
    }
}
