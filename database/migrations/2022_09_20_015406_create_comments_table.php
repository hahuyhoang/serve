<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            if (Schema::hasTable('users')) {
                $table->bigInteger('user_id')->unsigned();
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            }
            if (Schema::hasTable('reviews')) {
                $table->bigInteger('review_id')->unsigned();
                $table->foreign('review_id')->references('id')->on('reviews')->onDelete('cascade');
            }
            $table->bigInteger('id_parent')->unsigned()->default(0);
            $table->bigInteger('id_post')->unsigned();

            $table->bigInteger('id_user_reply')->unsigned();
            $table->string('cmt_type');
            $table->text('content');
            // $table->bigInteger('total_like')->unsigned()->default(0);
            // $table->text('list_user_like')->nullable();

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
        Schema::dropIfExists('comments');
    }
}
