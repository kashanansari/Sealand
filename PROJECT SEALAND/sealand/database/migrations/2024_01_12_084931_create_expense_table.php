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
        Schema::create('expense', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->foreign('customer_id')->references('id')->on('customer');
            $table->string('no_of_pkgs')->nullable();
            $table->string('expense_voucher')->nullable();
            $table->string('vir_no')->nullable();
            $table->string('index_no')->nullable();
            $table->string('dated_two')->nullable();
            $table->string('exchange_rate')->nullable();
            $table->string('document_encl')->nullable();
            $table->string('exchange_copy')->nullable();
            $table->string('invoice_list')->nullable();
            $table->string('po')->nullable();
            $table->string('vessel')->nullable();
            $table->string('dated_one')->nullable();
            $table->string('be_no')->nullable();
            $table->string('description')->nullable();
            $table->string('i_value')->nullable();
            $table->string('custom_be')->nullable();
            $table->string('importer_copy')->nullable();
            $table->string('lc_copy')->nullable();
            $table->string('shipper')->nullable();
            $table->string('custom_duties')->nullable();
            $table->string('pd_account')->nullable();
            $table->string('itax')->nullable();
            $table->string('aduty')->nullable();
            $table->string('sapt_boml')->nullable();
            $table->string('pd_account_two')->nullable();
            $table->string('infrastructure')->nullable();
            $table->string('pd_account_three')->nullable();
            $table->string('cntr_thc_two')->nullable();
            $table->string('lolo_chg_three')->nullable();
            $table->string('endrosment_chg_two')->nullable();
            $table->string('total_one')->nullable();
            $table->string('custom_fine')->nullable();
            $table->string('lolo_chg')->nullable();
            $table->string('cntr_thc')->nullable();
            $table->string('bond_paper')->nullable();
            $table->string('sapt_pict')->nullable();
            $table->string('endrosment_chg')->nullable();
            $table->string('lifter_labour')->nullable();
            $table->string('infrastructure_two')->nullable();
            $table->string('lolo_chg_two')->nullable();
            $table->string('lolo_chg_four')->nullable();
            $table->string('test_memo')->nullable();
            $table->string('labour_loading')->nullable();
            $table->string('bill_entry')->nullable();
            $table->string('cartage')->nullable();
            $table->string('assesment_pdc')->nullable();
            $table->string('exam_chrgs')->nullable();
            $table->string('fta_chrgs')->nullable();
            $table->string('rent_chrgs')->nullable();
            $table->string('other_expense')->nullable();
            $table->string('agency_commission')->nullable();
            $table->string('other')->nullable();
            $table->string('total_two')->nullable();
            $table->string('advance')->nullable();
            $table->string('balance')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expense');
    }
};
