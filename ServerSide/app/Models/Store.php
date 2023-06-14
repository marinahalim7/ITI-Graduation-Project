<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Store extends Model
{
    use Sluggable;
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
    
    use HasFactory;
    protected $fillable = [
        'name',
        'password',
        'owner_SSN',
        'phone_num',
        'location_lat',
        'location_long'
    ];


}
