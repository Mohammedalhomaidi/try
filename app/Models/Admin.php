<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasFactory;
    protected $table= "admins";
    protected $fillable=['name','email','permission_rols_id','username','password','created_at','updated_at','added_by','update_by','com_code','date','active']
    
    ;}
