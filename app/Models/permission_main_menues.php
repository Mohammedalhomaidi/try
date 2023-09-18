<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class permission_main_menues extends Model
{
    use HasFactory;
   protected $table='permission_main_menues';
   protected $fillable=['name',  'active','created_at', 'added_by',
   'updated_at', 'updated_by', 'com_code', 'date'];
   
}
