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
            $table->integer('application_stutus')->default(0);
            $table->unsignedBigInteger('applicant_id');
            $table->string('revit_file');
            $table->unsignedBigInteger('buildingOfficer_id')->nullable();
            $table->foreign('applicant_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('buildingOfficer_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('bureau');
            $table->text('comment_BO')->nullable();
            
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
