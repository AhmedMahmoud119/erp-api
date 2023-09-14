<?php

namespace Database\Factories;

use App\Domains\Product\Models\Product;
use App\Domains\Stock\Models\Stock;
use App\Domains\User\Models\User;
use App\Domains\Vendor\Models\Address;
use App\Domains\Warehouse\Models\Warehouse;
use Illuminate\Database\Eloquent\Factories\Factory;


class StockFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Stock::class;
    public function definition()
    {

        return [
            'quantity' => rand(50, 200),
            'opening_stock' => now(),
            'selling_price' => rand(50, 200),
            'purchasing_price' => rand(30, 150),
            'product_id' => Product::inRandomOrder()->first()->id,
            'warehouse_id' => Warehouse::inRandomOrder()->first()->id,
            'creator_id' => User::inRandomOrder()->first()->id,
        ];
    }
}