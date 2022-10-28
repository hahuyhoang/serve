<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductBrandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_brands', function (Blueprint $table) {
            if (Schema::hasTable('products')) {
                $table->bigInteger('product_id')->unsigned();
                $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            }
            if (Schema::hasTable('brands')) {
                $table->bigInteger('brand_id')->unsigned();
                $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');
            }
            
            $table->primary(['product_id', 'brand_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_brands');
    }
}
