<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class permission_sub_menues extends Model
{
    use HasFactory;
    protected $table='permission_sub_menues';
    protected $fillable=['name', 'permission_main_menues_id', 'active','created_at', 'added_by',
    'updated_at', 'updated_by', 'com_code', 'date'];
}
