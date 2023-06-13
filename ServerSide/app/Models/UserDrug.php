<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDrug extends Model
{
    protected $fillable=['name','exp_date','price','quantity','publishable'];
    
    public function users(){
        return $this->belongsTo(User::class);
    }
    use HasFactory;
}
