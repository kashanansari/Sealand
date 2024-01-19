<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;
    protected $fillable=[
        'customer_id',
        'no_of_pkgs',
        'expense_voucher',
        'vir_no',
        'index_no',
        'dated_two',
        'exchange_rate',
        'document_encl',
        'exchange_copy',
        'invoice_list',
        'po',
        'vessel',
        'dated_one',
        'be_no',
        'description',
        'i_value',
        'custom_be',
        'importer_copy',
        'lc_copy',
        'shipper',
        'custom_duties',
        'pd_account',
        'itax',
        'aduty',
        'sapt_boml',
        'pd_account_two',
        'infrastructure',
        'pd_account_three',
        'cntr_thc_two',
        'lolo_chg_three',
        'endrosment_chg_two',
        'total_one',
        'custom_fine',
        'lolo_chg',
        'cntr_thc',
        'bond_paper',
        'sapt_pict',
        'endrosment_chg',
        'lifter_labour',
        'infrastructure_two',
        'lolo_chg_two',
        'lolo_chg_four',
        'test_memo',
        'labour_loading',
        'bill_entry',
        'cartage',
        'assesment_pdc',
        'exam_chrgs',
        'fta_chrgs',
        'rent_chrgs',
        'other_expense',
        'agency_commission',
        'other',
        'total_two',
        'advance',
        'balance',

    ];


    protected $table='expense';

}
