<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Category as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
class Category extends Model
{
    use Notifiable;
    protected $table = "category";

    protected $fillable = [
        'category'
    ];

    protected $hidden = [
        'remember_token',
    ];
}
