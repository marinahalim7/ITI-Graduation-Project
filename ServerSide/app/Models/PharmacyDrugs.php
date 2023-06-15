<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PharmacyDrugs extends Model
{
    protected $table = 'pharmacy_drugs';
    protected $fillable=['name','price','quantity','pharmacy_id'];
    
    public function pharmacies(){
        return $this->belongsTo(Pharmacy::class);
    }
    use HasFactory;
}
