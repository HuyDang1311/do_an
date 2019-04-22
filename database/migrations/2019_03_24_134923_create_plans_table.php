<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('address_start_id');
            $table->unsignedInteger('address_end_id');
            $table->timestamp('time_start');
            $table->timestamp('time_end');
            $table->unsignedInteger('car_id');
            $table->unsignedInteger('user_driver_id');
            $table->unsignedInteger('company_id');
            $table->smallInteger('status')->index();
            $table->integer('price_ticket')->index();
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
            $table->foreign('address_start_id')->references('id')->on('bus_stations');
            $table->foreign('address_end_id')->references('id')->on('bus_stations');
            $table->foreign('car_id')->references('id')->on('cars');
            $table->foreign('user_driver_id')->references('id')->on('users');

            $table->foreign('company_id')->references('id')->on('companies');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plans');
    }
}
