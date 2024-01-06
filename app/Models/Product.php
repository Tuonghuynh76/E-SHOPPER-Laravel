<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = "product";
    protected $fillable = [
        'id_user', 'id_brand','id_category', 'name','image', 'price', 'status','sale','company', 'detail'
    ];
}
