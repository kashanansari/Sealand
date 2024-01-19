<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    public function vendor_bill()
     {
        $this->hasMany('App\Models\Vendor','vendor_id','id');
     }
    use HasFactory;
    protected $fillable = [
        'vendor_name',
        'user_id',

    ];
    protected $table='vendor';

}
