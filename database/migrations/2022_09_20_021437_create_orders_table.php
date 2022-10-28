<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            if (Schema::hasTable('users')) {
                $table->bigInteger('user_id')->unsigned();
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            }
            if (Schema::hasTable('discount_codes')) {
                $table->bigInteger('discount_code_id')->unsigned()->nullable();
                $table->foreign('discount_code_id')->references('id')->on('discount_codes');
            }
            if (Schema::hasTable('address_orders')) {
                $table->bigInteger('address_order_id')->unsigned()->nullable();
                $table->foreign('address_order_id')->references('id')->on('address_orders');
            }
            // $table->bigInteger('time_receive')->unsigned(); thời gian nhận
            $table->string('payment_method');
            $table->bigInteger('total_payment')->unsigned();
            $table->bigInteger('total_payment_sale')->unsigned()->default(0);
            $table->text('description')->nullable();
            $table->tinyInteger('status');
            //$table->bigInteger('id_ship')->unsigned()->nullable();/*id ship from db ship company, storage info order ship*/
            //$table->bigInteger('fee_ship')->unsigned()->default(0);
            // $table->boolean('pick_up');

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
        Schema::dropIfExists('orders');
    }
}
