<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('plan_id');
            $table->unsignedInteger('customer_id');
            $table->string('order_code')->unique();
            $table->smallInteger('payment_method_id')->nullable();
            $table->unsignedInteger('coupon_id')->nullable();
            $table->smallInteger('status')->default(1)->index();
            $table->timestamps();
            $table->foreign('plan_id')->references('id')->on('plans');
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->foreign('coupon_id')->references('id')->on('coupons');
        });
        DB::statement('ALTER TABLE orders ADD COLUMN seat_ids text[]');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
