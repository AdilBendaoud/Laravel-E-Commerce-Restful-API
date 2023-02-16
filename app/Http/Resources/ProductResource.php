<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    
    public function toArray($request)
    {
        return [
            'name'=>$this->name,
            'description'=>$this->discreption,
            'price'=>$this->price,
            'stock' => $this->stock,
            'rating' => $this->rating
        ];
    }
}
