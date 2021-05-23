<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConstructionTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('construction_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('construction_condition');
            $table->string('construction_type');
            $table->integer('estimated_cost')->nullable();
            $table->integer('number_of_floor');
            $table->integer('ground_floor_number');
            $table->integer('building_height');
            $table->integer('ground_building_height')->nullable();
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
        Schema::dropIfExists('construction_types');
    }
}
