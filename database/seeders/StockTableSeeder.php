<?php

namespace Database\Seeders;

use App\Domains\Product\Models\Product;
use App\Domains\Stock\Models\Stock;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StockTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $product = Product::first();
        $warehouse = 1; // Tax::first()->id

        $data = [
            [
                'quantity' => rand(50, 200),
                'opening_stock' => now(),
                'selling_price' => rand(50, 200),
                'purchase_price' => rand(30, 150),
                'product_id' => $product->id,
                'warehouse_id' => $warehouse,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'quantity' => rand(50, 200),
                'opening_stock' => now(),
                'selling_price' => rand(50, 200),
                'purchase_price' => rand(30, 150),
                'product_id' => $product->id,
                'warehouse_id' => $warehouse,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        Stock::insert($data);

    }
}
