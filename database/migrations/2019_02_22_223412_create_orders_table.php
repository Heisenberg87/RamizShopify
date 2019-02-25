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

            $table->bigInteger('order_id')->primary();
            $table->dateTime('created_at');
            $table->dateTime('updated_at');
            $table->integer('number');
            $table->text('token');
            $table->string('gateway');
            $table->boolean('test')->default(false);
            $table->decimal('total_price', 8, 2);
            $table->decimal('subtotal_price', 8, 2);
            $table->decimal('total_line_items_price', 8, 2);
            $table->integer('total_weight');
            $table->decimal('total_tax', 8, 2);
            $table->decimal('total_discounts', 8, 2);
            $table->boolean('taxes_included')->default(false);
            $table->string('currency', 3);
            $table->string('financial_status', 10);
            $table->decimal('total_price_usd', 8, 2);
            $table->integer('order_number');
            $table->boolean('confirmed')->default(false);
            $table->string('name');

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
