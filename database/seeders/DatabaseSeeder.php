<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Review;
use App\Models\Product;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(10)->create();
        Product::factory(50)->create();
        Review::factory(100)->create();
    }
}
