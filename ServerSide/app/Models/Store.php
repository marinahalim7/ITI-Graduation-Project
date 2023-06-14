<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Store extends Model
{
    use HasFactory;
    public function store_drugs(){
        return $this->hasMany(StoreDrug::class);
    }

    use Sluggable;
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    protected $fillable = [
        'name',
        'password',
        'owner_SSN',
        'phone_num',
        'location_lat',
        'location_long'
    ];


}
