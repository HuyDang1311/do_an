<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('oders', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('seat_id');
            $table->unsignedInteger('plan_id');
            $table->unsignedInteger('customer_id');
            $table->smallInteger('status')->index();
            $table->timestamps();
            $table->foreign('seat_id')->references('id')->on('seats');
            $table->foreign('plan_id')->references('id')->on('plans');
            $table->foreign('customer_id')->references('id')->on('customers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('oders');
    }
}
