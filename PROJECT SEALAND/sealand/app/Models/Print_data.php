<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Print_data extends Model
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
    protected $table='cheque_printing_data';

}
