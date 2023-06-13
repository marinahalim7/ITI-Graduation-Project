<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDrug extends Model
{
    protected $table = 'user_drugs';
    protected $fillable=['name','img','exp_date','exp_img','price','quantity','publishable'];
    
    public function users(){
        return $this->belongsToMany(User::class,'user_rel_drugs','user_id','drug_id');
    }
    use HasFactory;
}
