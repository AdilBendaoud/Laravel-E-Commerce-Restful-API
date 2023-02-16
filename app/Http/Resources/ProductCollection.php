<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductCollection extends JsonResource
{
    public function toArray($request)
    {
        return [
            'name' => $this->name,
            'price' => $this->price,
            'rating' => $this->reviews->count() > 0 ? $this->reviews->sum('star') / $this->reviews->count() : 'No Rating',
            'link' => route('products.show', $this->id)
        ];
    }
}