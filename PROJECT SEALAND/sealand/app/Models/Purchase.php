<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    public function meter()
     {
        $this->hasMany('App\Models\Vendor','purchase_id ','id');
     }
    protected $fillable=[
        'pay',
        'user_id',
        'date',
        'status',
        'attach_document',
        'supplier',
        'purchases_voucher',
        'order_tax',
        'discount',
        'shipping',
        'payment_term',
        'note',
        
    ];
    use HasFactory;
    protected $table='purchases';

}
