<?php

namespace Database\Seeders;

use App\Domains\Product\Models\Product;
use App\Domains\Stock\Models\Stock;
use App\Domains\User\Models\User;
use App\Domains\Warehouse\Models\Warehouse;
use Illuminate\Database\Seeder;

class StocksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $product = Product::first();
        $warehouse = Warehouse::first();
        $creator = User::first();

        $data = [
            [
                'quantity' => rand(50, 200),
                'opening_stock' => now(),
                'selling_price' => rand(50, 200),
                'purchasing_price' => rand(30, 150),
                'product_id' => $product->id,
                'warehouse_id' => $warehouse->id,
                'creator_id' => $creator->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'quantity' => rand(50, 200),
                'opening_stock' => now(),
                'selling_price' => rand(50, 200),
                'purchasing_price' => rand(30, 150),
                'product_id' => $product->id,
                'warehouse_id' => $warehouse->id,
                'creator_id' => $creator->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        Stock::insert($data);

    }
}
