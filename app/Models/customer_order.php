<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class customer_order extends Model
{
    use HasFactory;
    protected $table ="customer_order";
    protected $fillable=[ 'invoice_date', 'customer_code', 'is_approved', 'com_code', 'notes', 'discount_percent', 'discount_value', 'tax_percent', 'total_cost_items', 'total_befor_discount', 'total_cost', 'account_number', 'customer_balance_befor', 'customer_balance_after', 'added_by', 'created_at', 'updated_at', 'updated_by', 'approved_by'
  ];
}
