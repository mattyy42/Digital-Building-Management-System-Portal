<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('application_stutus')->nullable();
            $table->unsignedBigInteger('applicant_id');
            $table->unsignedBigInteger('buildingOfficer_id')->nullable();
              
            $table->foreign('applicant_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('buildingOfficer_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('bureau');
            // $table->unsignedBigInteger('bureau_id');
            // $table->foreign('bureau_id')->references('id')->on('bureau')->onDelete('cascade');
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
        Schema::dropIfExists('applications');
    }
}
