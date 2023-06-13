<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PharmacyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
//        return parent::toArray($request);
    return [
        'id'=>$this->id,
        'name'=>$this->name,
        'username'=>$this->slug,
        'owner_SSN'=>$this->owner_SSN,
        'phone'=>$this->phone_num,
        'location'=>$this->location_lat." , ".$this->location_long,
    ];
    }
}
