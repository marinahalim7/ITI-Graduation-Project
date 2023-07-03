<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreDrug extends Model
{

    use HasFactory;

    protected $fillable=
    [
        'name',
        'img',
        'price',
        'quantity',
        'store_id'

    ];


    public function stores(){
        return $this->belongsTo(Store::class);
    }

}
