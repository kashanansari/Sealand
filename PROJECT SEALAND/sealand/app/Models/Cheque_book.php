<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cheque_book extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'amount',
        'bank_description',
        'add_bank',
       

    ];
    protected $table='customer_cheque_printing_book';
}
