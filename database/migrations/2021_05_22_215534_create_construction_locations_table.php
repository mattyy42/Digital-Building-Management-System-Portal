<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConstructionLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('construction_locations', function (Blueprint $table) { $table->bigIncrements('id');
            $table->string('city');
            $table->string('sub_city');
            $table->string('wereda/kebele');
            $table->string('special_name');
            $table->integer('house_number');
            
            $table->unsignedBigInteger('application_id');
            
            $table->foreign('application_id')->references('id')->on('applications')->onDelete('cascade');
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
        Schema::dropIfExists('construction_locations');
    }
}
