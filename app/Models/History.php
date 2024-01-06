<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;
    protected $table = "history";
    protected $fillable = [
        'email', 'name', 'phone','id_user','price'
    ];
    protected $hidden = [
        'remember_token',
    ];
}
