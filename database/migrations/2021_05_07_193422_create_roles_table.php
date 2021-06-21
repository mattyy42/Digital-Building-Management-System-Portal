<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->unsignedBigInteger('user_id');
           // $table->unsignedBigInteger('bureau_id')->nullable();
           // $table->foreign('bureau_id')->references('bureau')->on('bureau')->onDelete('cascade');
            $table->string('bureau')->nullable();

            // add attribute to count active application of bo should be nullable 
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('active_applications')->default(0);
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
        Schema::dropIfExists('roles');
    }
}
