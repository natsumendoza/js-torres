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
            $table->string('transaction_code');
            $table->integer('user_id');
            $table->string('front_image');
            $table->string('back_image');
            $table->string('left_image')->nullable();
            $table->string('right_image')->nullable();
            $table->string('fabric_type')->nullable();
            $table->string('print_type')->nullable();
            $table->integer('quantity');
            $table->decimal('total_price', 10,2);
            $table->string('status');
            $table->string('order_type')->nullable();
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
