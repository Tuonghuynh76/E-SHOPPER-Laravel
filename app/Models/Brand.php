<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Brand as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
class Brand extends Model
{
    use Notifiable;
    protected $table = "brand";

    protected $fillable = [
        'brand'
    ];

    protected $hidden = [
        'remember_token',
    ];
}
