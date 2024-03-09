<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            ['name' => 'Home', 'description' => 'Your current pr soon-to-be home'],
            ['name' => 'Auto', 'description' => 'Your personal vehicle(s)'],
            ['name' => 'Recreational Vehicle', 'description' => 'Your boat RV, motorcycle, etc']
        ];

        foreach ($products as $product) {
            $existingProduct = Product::where('name', $product['name'])->first();
            if (!$existingProduct) {
                Product::create(
                    [
                        'name' => $product['name'],
                        'description' => $product['description']
                    ]
                );
            }
        }
    }
}
