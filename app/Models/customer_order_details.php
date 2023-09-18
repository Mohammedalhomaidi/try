<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class customer_order_details extends Model
{
   
    use HasFactory;
    protected $table ="customer_order_details";
    protected $fillable=[ 'customer_order_id', 'item_code', 'quantity', 'total_price', 'added_by', 'created_at', 'updated_by', 'updated_at' 
  ]; 
}
