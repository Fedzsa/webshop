<?php

use App\Models\Category;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Product::class, 10)
            ->create()
            ->each(function ($product) {
                $product
                    ->category()
                    ->associate(factory(Category::class)->make());
            });
    }
}
