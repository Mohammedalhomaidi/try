<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class permission_rols extends Model
{
    use HasFactory;
   protected $table='permission_rols';
   protected $fillable=['name',  'active','created_at', 'added_by',
   'updated_at', 'updated_by', 'com_code', 'date'];
   
}
