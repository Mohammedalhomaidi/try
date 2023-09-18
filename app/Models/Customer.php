<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
class Customer extends Authenticatable
{
    use HasFactory;
    protected $table ="customers";
    protected $fillable=['customer_code', 'Name_enter_system','password','name', 'account_number', 'start_balance_status', 
    'start_balance', 'current_balance', 'notes', 'added_by', 
    'updated_by', 'created_at', 'updated_at', 'active', 'com_code', 'date', 'address', 'phones'];
}
