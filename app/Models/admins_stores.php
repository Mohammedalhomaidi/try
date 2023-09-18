<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class admins_stores extends Model
{
    protected $table="admins_stores";
    protected $fillable=[
        'id', 'admin_id', 'Store_id', 'active', 'added_by', 'created_at', 'updated_by', 'updated_at', 'com_code', 'date' ];
 
}
