<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cheque_data extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'select_bank',
        'pay',
        'amount',
        'cheque_type',
        'date',
       

    ];
    protected $table='customer_cheque_printing_Data';
}
