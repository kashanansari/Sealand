<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purcahses_product extends Model
{
    use HasFactory;
    protected $fillable=[
        'purchase_id',
        'product_id',
        'quantity',
        'price',
        'received_quantity',
       
      
    ];
    protected $table='purchases_product';

}
