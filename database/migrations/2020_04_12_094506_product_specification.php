<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ProductSpecification extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('product_specification', function(Blueprint $table) {
            $table->bigInteger('product_id')->unsigned();
            $table->bigInteger('specification_id')->unsigned();

            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('specification_id')->references('id')->on('specifications');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('product_specification', function(Blueprint $table) {
           $table->dropForeign('product_id');
           $table->dropForeign('specification_id');
        });

        Schema::dropIfExists('product_specification');
    }
}
