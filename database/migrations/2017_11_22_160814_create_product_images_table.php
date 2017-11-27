<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_images', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id');

            $table->string('bag_front_image')->nullable();

            $table->string('white_front_image')->nullable();
            $table->string('white_back_image')->nullable();
            $table->string('white_left_image')->nullable();
            $table->string('white_right_image')->nullable();
            $table->string('white_round_neck_image')->nullable();
            $table->string('white_v_neck_image')->nullable();
            $table->string('white_collar_image')->nullable();

            $table->string('red_front_image')->nullable();
            $table->string('red_back_image')->nullable();
            $table->string('red_left_image')->nullable();
            $table->string('red_right_image')->nullable();
            $table->string('red_round_neck_image')->nullable();
            $table->string('red_v_neck_image')->nullable();
            $table->string('red_collar_image')->nullable();

            $table->string('green_front_image')->nullable();
            $table->string('green_back_image')->nullable();
            $table->string('green_left_image')->nullable();
            $table->string('green_right_image')->nullable();
            $table->string('green_round_neck_image')->nullable();
            $table->string('green_v_neck_image')->nullable();
            $table->string('green_collar_image')->nullable();

            $table->string('blue_front_image')->nullable();
            $table->string('blue_back_image')->nullable();
            $table->string('blue_left_image')->nullable();
            $table->string('blue_right_image')->nullable();
            $table->string('blue_round_neck_image')->nullable();
            $table->string('blue_v_neck_image')->nullable();
            $table->string('blue_collar_image')->nullable();
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
        Schema::dropIfExists('product_images');
    }
}
