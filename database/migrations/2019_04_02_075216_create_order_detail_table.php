<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_detail', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('order_id')->nullable();
            $table->unsignedInteger('seat_id')->nullable();
            $table->integer('quantity');
            $table->string('totla_money');
            $table->string('payment_status');
            $table->string('processing_status');
            $table->timestamps();
            $table->foreign('order_id')->references('id')->on('orders');
            $table->foreign('seat_id')->references('id')->on('seats');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_detail');
    }
}
