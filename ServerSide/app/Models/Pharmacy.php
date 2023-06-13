<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pharmacy extends Model
{
    use HasFactory;
    protected $fillable=['name','slug','password','owner_SSN','phone_num','location_lat','location_long'];
//    pubplic function pharmacy_drugs(){
//        return $this->belongsToMany(PharmacyDrug::class,'pharmacy_rel_drugs','pharmacy_id','drug_id');
//}
}
