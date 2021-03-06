<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('products', function(BluePrint $table) {
            $table->increments('id');
            $table->decimal('price');

            $table->integer('currency_id')->unsigned()->nullable()->default(null);

            $table->tinyInteger('active')->default(0);
            $table->integer('position');

            $table->index(['price']);

            $table->foreign('currency_id')->references('id')->on('currencies')
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
        Schema::drop('products');
    }
}
