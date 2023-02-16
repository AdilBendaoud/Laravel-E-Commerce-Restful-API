<?php

namespace Database\Factories;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReviewFactory extends Factory
{
    protected $model = Review::class;
    public function definition()
    {
        return [
            'product_id' => function(){return Product::all()->random();},
            'customer' => $this->faker->name(),
            'review'=> $this->faker->sentence(),
            'star'=>$this->faker->numberBetween(0,5)
        ];
    }
}
