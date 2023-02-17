<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'name' => $this->name,
            'description' => $this->discreption,
            'price' => $this->price,
            'stock' => $this->stock == 0 ? 'Out of stock' : $this->stock,
            'rating' => $this->reviews->count() > 0 ? $this->reviews->sum('star') / $this->reviews->count() : 'No Rating',
            'reviews' => route('reviews.index', $this->id)
        ];
    }
}