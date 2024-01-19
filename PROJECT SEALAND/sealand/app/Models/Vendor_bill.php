<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor_bill extends Model
{
    public function vendor_details()
    {
        return $this->belongsTo('App\Models\Vendor', 'vendor_id', 'id');
    }  
    public function purchase_details()
    {
        return $this->belongsTo('App\Models\purchase', 'purchase_id', 'id');
    }  
    protected $fillable = [
        'vendor_id',
        'purchase_id',
        'grand_total',
        'paid_amount',
        'payment_status',

    ];
    protected $table='vendor_bill';

}
