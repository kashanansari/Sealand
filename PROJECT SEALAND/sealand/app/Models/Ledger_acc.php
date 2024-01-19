<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ledger_acc extends Model
{
    use HasFactory;
    protected $fillable=[
        'user_id',
        'customer',
        'description',
        'amount',
        'balance',
        'voucher_no',
        'date',
        'status',
        'reference',
        
    ];
    use HasFactory;
    protected $table='ledger_acc';

}
