<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('customer', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('customer_name');
            $table->string('company_name');
            $table->string('customer_address');
            $table->string('customer_contact_number');
            $table->string('company_detail');
            $table->string('customer_ntn_number');
            $table->string('customer_owner');
            $table->string('customer_gst_number');
            $table->string('prev_customer_balance');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer');
    }
};
