<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderItemsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('order_items', function(Blueprint $table) {
            $table->increments('id');

            $table->integer('order_id')->unsigned()->nullable()->default(null);
            $table->integer('cart_id')->unsigned()->nullable()->default(null);

            $table->foreign('order_id')->references('id')->on('orders')
                ->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('cart_id')->references('id')->on('carts')
                ->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('order_items');
    }
}
