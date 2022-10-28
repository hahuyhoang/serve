<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
            if (Schema::hasTable('orders')) {
                $table->bigInteger('order_id')->unsigned();
                $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
            }
            if (Schema::hasTable('products')) {
                $table->bigInteger('product_id')->unsigned();
                $table->foreign('product_id')->references('id')->on('products');
            }
            $table->integer('quantity')->unsigned()->default(1);
            $table->bigInteger('price')->unsigned();
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
        Schema::dropIfExists('order_details');
    }
}
