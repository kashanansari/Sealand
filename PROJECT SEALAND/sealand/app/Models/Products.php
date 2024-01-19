<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;
    protected $fillable=[
        'user_id',
        'product_name',
        'product_code',
        'barcode',
        'size',
        'brand',
        'gramage',
        'category',
        'sub_category',
        'product_unit',
        'product_price',
        'product_cost',
        'product_image',
        'product_details',
        'product_details_for_invoice',
      
    ];
    protected $table='products';
}
