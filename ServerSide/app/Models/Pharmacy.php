<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
class Pharmacy extends Model
{
    use HasFactory;
    protected $fillable=[
        'name',
        'slug',
        'password',
        'owner_SSN',
        'phone_num',
        'location_lat',
        'location_long'
    ];



    
    use Sluggable;
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
    
    public function pharmacy_drugs(){
        return $this->hasMany(PharmacyDrugs::class);
        
 
     }
}
