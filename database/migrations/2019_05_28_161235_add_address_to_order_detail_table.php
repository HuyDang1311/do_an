<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAddressToOrderDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_detail', function (Blueprint $table) {
            $table->smallInteger('address_start_id')->default(1);
            $table->smallInteger('address_end_id')->default(4);
            $table->foreign('address_start_id')->references('id')->on('bus_stations');
            $table->foreign('address_end_id')->references('id')->on('bus_stations');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_detail', function (Blueprint $table) {
            $table->dropColumn('address_start_id');
            $table->dropColumn('address_end_id');
        });
    }
}
