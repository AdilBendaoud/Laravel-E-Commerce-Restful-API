<?php

namespace Database\Factories;
use Faker\Factory as Faker;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product;

class ProductFactory extends Factory
{
    protected $model = Product::class;   
    public function definition()
    {   
        return [
            'name'=>$this->faker->word(),
            'discreption'=>$this->faker->paragraph(),
            'price'=>$this->faker->numberBetween(50,1000),
            'stock'=> $this->faker->randomDigit()
        ];
    }
}
