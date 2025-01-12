<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $product_array = [
            [
                'product_name' => 'Arabic Coffee', 
                'profit_margin' => 0.25,
            ],
            [
                'product_name' => 'Gold Coffee', 
                'profit_margin' => 0.15,
            ]
        ];

        // Product Database Seeder Job
        foreach ($product_array as $product) {
            Product::create( $product );
        }
    }
}
