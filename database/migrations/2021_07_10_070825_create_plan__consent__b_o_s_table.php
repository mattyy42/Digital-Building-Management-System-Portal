<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlanConsentBOSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plan__consent__b_o_s', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('sub_city');
            $table->foreign('sub_city')->references('id')->on('plan__consents')->onDelete('cascade');
          
            $table->unsignedBigInteger('new_woreda');
            $table->foreign('new_woreda')->references('id')->on('plan__consents')->onDelete('cascade');
            $table->unsignedBigInteger('street_address');
            $table->foreign('street_address')->references('id')->on('plan__consents')->onDelete('cascade');
            $table->unsignedBigInteger('house_number');
            $table->foreign('house_number')->references('id')->on('plan__consents')->onDelete('cascade');
            $table->unsignedBigInteger('ownership_authentication_number');
            $table->foreign('ownership_authentication_number')->references('id')->on('plan__consents')->onDelete('cascade');
            $table->unsignedBigInteger('ownership_authentication_type');
            $table->foreign('ownership_authentication_type')->references('id')->on('plan__consents')->onDelete('cascade');
            $table->date('design_submission_deadline')->nullable();//applicable iff lease
            $table->date('construction_initation_date')->nullable();
        //  $table->date()
            
            $table->unsignedBigInteger('owner_full_name');
            $table->foreign('owner_full_name')->references('id')->on('plan__consents')->onDelete('cascade');
            $table->string('block_number');
            $table->string('x_parcel_number');
            $table->string('y_parcel_number');
            $table->string('cadaster_number');

            $table->string('area_category');
            $table->text('building_height');
            $table->text('floor_area_ratio');
            $table->string('level');
            $table->string('land_area');//in meters
            $table->string('verified_land_area');
            $table->string('air_space')->nullable();
            $table->text('Other')->nullable();

            $table->text('infrastacture_build_on_the_land');
            

            $table->unsignedBigInteger('buildingOfficer_id')->nullable();
            $table->foreign('buildingOfficer_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('bureau');


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
        Schema::dropIfExists('plan__consent__b_o_s');
    }
}
