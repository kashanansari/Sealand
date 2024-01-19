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
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('date')->nullable();
            $table->string('pay')->nullable();
            $table->string('status')->nullable();
            $table->string('attach_document')->nullable();
            $table->string('supplier')->nullable();
            $table->string('purchases_voucher')->nullable();
            $table->string('order_tax')->nullable();
            $table->string('discount')->nullable();
            $table->string('shipping')->nullable();
            $table->string('payment_term')->nullable();
            $table->string('note')->nullable();
            
            

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
        Schema::dropIfExists('purchases');
    }
};
