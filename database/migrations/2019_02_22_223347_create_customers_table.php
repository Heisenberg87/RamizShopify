<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->bigInteger('customer_id');
            $table->primary('customer_id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->nullable();
            $table->string('note')->nullable();
            $table->string('phone', 20)->nullable();
            $table->string('state')->nullable();
            $table->string('tags')->nullable();
            $table->string('multipass_identifier')->nullable();
            $table->bigInteger('last_order_id')->nullable();
            $table->string('currency', 3);
            $table->dateTime('created_at');
            $table->dateTime('updated_at');
            $table->boolean('accepts_marketing')->default(false);
            $table->boolean('verified_email')->default(false);
            $table->boolean('tax_exempt')->default(false);
            $table->string('last_order_name')->nullable();
            $table->integer('orders_count');
            $table->decimal('total_spent', 8, 2);
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
}
