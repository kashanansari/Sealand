<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('product_name')->nullable();
            $table->string('product_code')->nullable();
            $table->string('barcode')->nullable();
            $table->string('size')->nullable();
            $table->string('brand')->nullable();
            $table->string('gramage')->nullable();
            $table->string('category')->nullable();
            $table->string('sub_category')->nullable();
            $table->string('product_unit')->nullable();
            $table->string('product_cost')->nullable();
            $table->string('product_price')->nullable();
            $table->string('product_image')->nullable();
            $table->string('product_details')->nullable();
            $table->string('product_details_for_invoice')->nullable();
            $table->timestamps();
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
};
