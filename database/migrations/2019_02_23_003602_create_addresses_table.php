<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('customer_id');
            $table->timestamps();
             $table->string('address1');
             $table->string('address2');
             $table->string('city');
             $table->string('country');
             $table->string('zip');
             $table->string('phone');
             $table->string('name');
             $table->string('country_code', 2);
             $table->string('country_name');
             $table->boolean('default')->default(false);
             $table->foreign('customer_id')->references('customer_id')->on('customers');
             
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('addresses');
    }
}
