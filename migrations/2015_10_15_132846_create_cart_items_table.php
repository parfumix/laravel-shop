<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCartItemsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('cart_items', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('cart_id')->unsigned();

            $table->string('title');
            $table->integer('quantity');

            $table->timestamps();

            $table->foreign('cart_id')->references('id')->on('carts')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Scema::drop('cart_items');
    }
}
