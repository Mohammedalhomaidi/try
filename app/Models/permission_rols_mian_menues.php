<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class permission_rols_mian_menues extends Model
{
    use HasFactory;
    protected $table="permission_rols_main_menues";
    protected $fillable=[  'permission_rols_id', 'permission_main_menues_id', 'added_by', 'created_at', 'updated_at', 'updated_by', 'com_code' ];
}
