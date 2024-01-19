<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoices extends Model
{
    use HasFactory;
    protected $fillable=[
        'expense_id',
        'invoice_no',
        'customer_id',
        'service_charges',
        'sales_tax',
        'sales_tax_amount',
        'total',
        'received_amount',
        'inv_date',
        'inv_status',
        'user_id',
        
    ];
    use HasFactory;
    protected $table='invoices';

}

