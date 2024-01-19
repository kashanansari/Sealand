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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('expense_id');
            $table->foreign('expense_id')->references('id')->on('expense');
            $table->unsignedBigInteger('customer_id');
            $table->foreign('customer_id')->references('id')->on('customer');
            $table->string('invoice_no')->nullable();
            $table->string('service_charges')->nullable();
            $table->string('sales_tax')->nullable();
            $table->string('sales_tax_amount')->nullable();
            $table->string('total')->nullable();
            $table->string('received_amount')->nullable();
            $table->string('inv_date')->nullable();
            $table->string('inv_status')->nullable();

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
        Schema::dropIfExists('invoices');
    }
};
