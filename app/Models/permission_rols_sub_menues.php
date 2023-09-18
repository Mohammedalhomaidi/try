<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class permission_rols_sub_menues extends Model
{
    use HasFactory;
    protected $table="permission_rols_sub_menues";
    protected $fillable=[  'permission_rols_main_menues_id', 'permission_sub_menues', 'permission_rols_id', 'added_by', 'created_at', 'updated_at', 'updated_by', 'com_code' ];
}
