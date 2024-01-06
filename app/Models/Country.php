<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Country as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
class Country extends Model
{
    //
    use Notifiable;
    protected $table = "country";

    protected $fillable = [
        'name'
    ];

    protected $hidden = [
        'remember_token',
    ];
}

