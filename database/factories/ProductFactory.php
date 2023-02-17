<?php

namespace Database\Factories;
use App\Models\User;
use App\Models\Product;
use Faker\Factory as Faker;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;   
    public function definition()
    {   
        return [
            'name'=>$this->faker->word(),
            'discreption'=>$this->faker->paragraph(),
            'price'=>$this->faker->numberBetween(50,1000),
            'stock'=> $this->faker->randomDigit(),
            'user_id'=>function(){return User::all()->random();}
        ];
    }
}
