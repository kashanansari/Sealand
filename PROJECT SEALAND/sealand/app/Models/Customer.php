<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
    protected $fillable = [
        'customer_name',
        'company_name',
        'customer_address',
        'customer_contact_number',
        'company_detail',
        'customer_ntn_number',
        'customer_owner',
        'customer_gst_number',
        'prev_customer_balance',
        'user_id',

    ];
    protected $table='customer';

}
