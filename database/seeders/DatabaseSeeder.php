<?php

namespace Database\Seeders;

use App\Models\User;
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
        // User Database Seeder Job
        User::factory()->create([
            'name' => 'Sales Agent',
            'email' => 'sales@coffee.shop',
        ]);
        // Products Database Seeder Job
        Product::factory()->create(
            [
                'product' => 'Gold Coffee',
                'price'   => '10.00',
            ], 
            [
                'product' => 'Arabic Coffee',
                'price'   => '20.50',
            ]
        );
        // Calculations Database Seeder Job
        Calculation::factory()->create(
            [
                'type' => 'profit_margin',
                'operation' => 'multiply',
                'rate' => 0.25
            ], 
            [
                'type' => 'shipping_cost',
                'operation' => 'add',
                'rate' => 10.00,
            ]
        ); 
    }
}
