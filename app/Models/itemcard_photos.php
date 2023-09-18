<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class itemcard_photos extends Model
{
    use HasFactory;
    protected $table="itemcard_photos";
    protected $fillable =[  'itemcard_id', 'photos1', 'photo2', 'photo3', 'photo4', 'photo5', 'photo6', 'added_by', 'created_at', 'updated_at', 'updated _by', 'com_code'];
}
