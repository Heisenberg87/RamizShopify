<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVariantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('variants', function (Blueprint $table) {

            $table->bigInteger('id')->primary();
            $table->bigInteger('product_id');
            $table->foreign('product_id')->references('id')->on('products');
            $table->string('title');
            $table->decimal('price', 8, 2);
            $table->string('sku');
            $table->integer('position');
            $table->string('option1');
            $table->string('inventory_policy', 20);
            $table->string('fulfillment_service');
            $table->string('weight_unit', 10);
            $table->bigInteger('inventory_item_id');
            $table->boolean('taxable')->default(false);
            $table->integer('weight');
            $table->boolean('requires_shipping')->default(false);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('variants');
    }
}
