<?php

namespace Database\Seeders;

use App\Domains\Product\Models\Product;
use App\Domains\Stock\Models\Stock;
use App\Domains\User\Models\User;
use App\Domains\Warehouse\Models\Warehouse;
use Database\Factories\StockFactory;
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
        StockFactory::times(50)->create();
    }
}
