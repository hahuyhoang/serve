<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            if (Schema::hasTable('users')) {
                $table->unsignedBigInteger('user_id')->nullable();
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            }
            if (Schema::hasTable('media')) {
                $table->unsignedBigInteger('media_id')->unsigned()->nullable();
                $table->foreign('media_id')->references('id')->on('media')->onDelete('cascade');
            }
            $table->string('name');
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->string('background')->nullable();
            $table->string('border_color')->nullable();
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
        Schema::dropIfExists('categories');
    }
}
