<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDrug extends Model
{
    protected $table = 'user_drugs';
    protected $fillable=['name','exp_date','price','quantity','publishable'];
    
    public function user(){
        return $this->belongsTo(User::class);
    }
    use HasFactory;
}
