<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Brownies',
                'description' => 'Delicious chocolate brownies with various toppings',
                'item_count' => 5,
            ],
            [
                'name' => 'Donut',
                'description' => 'Sweet and soft donuts with different fillings and glazes',
                'item_count' => 3,
            ],
            [
                'name' => 'Risoles',
                'description' => 'Savory snacks with various fillings',
                'item_count' => 2,
            ],
            [
                'name' => 'Floss Roll',
                'description' => 'Soft bread rolls filled with meat floss',
                'item_count' => 1,
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}