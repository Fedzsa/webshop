<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddValueTimestampAndSoftDeleteToProductSpecificationTable extends
    Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_specification', function (Blueprint $table) {
            $table->string('value');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_specification', function (Blueprint $table) {
            $table->dropColumn('value');
            $table->dropTimestamps();
            $table->dropSoftDeletes();
        });
    }
}
