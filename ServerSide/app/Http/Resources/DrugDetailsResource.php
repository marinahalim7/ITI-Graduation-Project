<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DrugDetailsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'name'=>$this->name,
            'img'=>$this->img,
            'exp_img'=>$this->exp_img,
            'price'=>$this->price,
            'quantity'=>$this->quantity,   
            'Owner'=>new UserDetailsResource($this->user),
   
        ];
    }
}
