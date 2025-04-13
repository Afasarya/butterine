<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            // Brownies
            [
                'category_id' => 1,
                'name' => 'Original Brownies',
                'description' => 'Delicious Mini Brownies by Bite',
                'price' => 50000,
                'sold_count' => 409,
                'rating' => 4.9,
                'is_featured' => true,
            ],
            [
                'category_id' => 1,
                'name' => 'Almond Brownies',
                'description' => 'Delicious Mini Brownies by Bite with almond topping',
                'price' => 55000,
                'sold_count' => 396,
                'rating' => 4.8,
                'is_featured' => true,
            ],
            [
                'category_id' => 1,
                'name' => 'Milo Chips Brownies',
                'description' => 'Delicious Mini Brownies by Bite with milo chips',
                'price' => 55000,
                'sold_count' => 243,
                'rating' => 4.7,
                'is_featured' => true,
            ],
            [
                'category_id' => 1,
                'name' => 'Cheese Brownies',
                'description' => 'Delicious Mini Brownies by Bite with cheese topping',
                'price' => 60000,
                'sold_count' => 178,
                'rating' => 4.6,
                'is_featured' => false,
            ],
            [
                'category_id' => 1,
                'name' => 'Nutella Brownies',
                'description' => 'Delicious Mini Brownies by Bite with nutella swirl',
                'price' => 65000,
                'sold_count' => 156,
                'rating' => 4.8,
                'is_featured' => false,
            ],
            
            // Donuts
            [
                'category_id' => 2,
                'name' => 'Chocolate Donut',
                'description' => 'Classic donut with chocolate glaze',
                'price' => 30000,
                'sold_count' => 289,
                'rating' => 4.7,
                'is_featured' => false,
            ],
            [
                'category_id' => 2,
                'name' => 'Strawberry Donut',
                'description' => 'Classic donut with strawberry glaze',
                'price' => 30000,
                'sold_count' => 245,
                'rating' => 4.6,
                'is_featured' => false,
            ],
            [
                'category_id' => 2,
                'name' => 'Vanilla Donut',
                'description' => 'Classic donut with vanilla glaze',
                'price' => 30000,
                'sold_count' => 212,
                'rating' => 4.5,
                'is_featured' => false,
            ],
            
            // Risoles
            [
                'category_id' => 3,
                'name' => 'Chicken Risoles',
                'description' => 'Savory risoles filled with chicken and vegetables',
                'price' => 45000,
                'sold_count' => 176,
                'rating' => 4.7,
                'is_featured' => false,
            ],
            [
                'category_id' => 3,
                'name' => 'Beef Risoles',
                'description' => 'Savory risoles filled with beef and vegetables',
                'price' => 50000,
                'sold_count' => 145,
                'rating' => 4.8,
                'is_featured' => false,
            ],
            
            // Floss Roll
            [
                'category_id' => 4,
                'name' => 'Floss Roll',
                'description' => 'Soft bread rolls filled with chicken floss',
                'price' => 55000,
                'sold_count' => 635,
                'rating' => 4.9,
                'is_featured' => false,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}