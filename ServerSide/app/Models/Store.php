<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'slug',
        'password',
        'owner_SSN',
        'phone_num',
        'location_lat',
        'location_long'
    ];
}
