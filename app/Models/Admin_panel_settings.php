<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin_panel_settings extends Model
{
    use HasFactory;

    protected $table="admin_panel_settings";
    protected $fillable=['system_name','photo','admin_panel_settings' , 'batches_setting_type', 'is_set_batches_setting','active','general_alert','address','phone','created_at','updated_at','added_by','updated_by','com_code','defualt_unit','Numbers_vist'];
}
