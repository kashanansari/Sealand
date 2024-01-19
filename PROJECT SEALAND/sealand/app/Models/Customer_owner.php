<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer_owner extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id ',
        'customer_owner_name',
        'owner_mon_amount',
     
      
        
    ];
    protected $table='customer_owner';
}
