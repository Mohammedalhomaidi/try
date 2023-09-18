<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class custmoer_favorite_itemcard extends Model
{
    use HasFactory;
    protected $table ="custmoer_favorite_itemcard";
    protected $fillable=[ 'itemcard_id', 'customer_id', 'created_at', 'com_code' ];
}
