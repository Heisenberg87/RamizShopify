<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigInteger('id')->primary();
            $table->string('title');
            $table->longText('body_html');
            $table->string('vendor');
            $table->string('product_type')->nullable();
            $table->dateTime('created_at');
            $table->string('handle');
            $table->dateTime('updated_at');
            $table->dateTime('published_at');
            $table->string('template_suffix')->nullable();
            $table->string('tags')->nullable();
            $table->string('published_scope');
            $table->text('admin_graphql_api_id')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
