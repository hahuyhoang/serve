<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            if (Schema::hasTable('media')) {
                $table->unsignedBigInteger('media_id')->unsigned()->nullable();
                $table->foreign('media_id')->references('id')->on('media')->onDelete('cascade');
            }
            $table->string('name');
            $table->string('title');
            $table->text('description')->nullable();
            $table->float('price', 8, 2);
            $table->bigInteger('total_rate')->unsigned();
            $table->bigInteger('total_vote')->unsigned();
            $table->unsignedTinyInteger('status')->default(0);
            $table->softDeletes();
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
        Schema::dropIfExists('products');
    }
}
