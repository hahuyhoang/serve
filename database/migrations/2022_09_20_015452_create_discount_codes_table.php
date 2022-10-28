<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiscountCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discount_codes', function (Blueprint $table) {
            $table->id();
            $table->string('discount_name');
            $table->text('description')->nullable();
            $table->dateTime('date_time_start');
            $table->dateTime('date_time_end');
            $table->bigInteger('type_discount')->unsigned();
            $table->bigInteger('min_sale')->unsigned()->nullable();
            if (Schema::hasTable('users')) {
                $table->bigInteger('user_id')->unsigned()->nullable();
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            }
            $table->string('discount_code');
            $table->bigInteger('total_discount_limit')->unsigned()->nullable();
            $table->bigInteger('total_discount_used')->unsigned()->default(0);
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('discount_codes');
    }
}
