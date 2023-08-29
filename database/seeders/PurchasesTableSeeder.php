<?php

namespace Database\Seeders;

use App\Domains\Product\Models\Product;
use App\Domains\Stock\Models\Stock;
use App\Domains\Supplier\Models\Supplier;
use App\Domains\Purchase\Models\Purchase;
use App\Domains\User\Models\User;
use Illuminate\Database\Seeder;

class PurchasesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $supplier = Supplier::first();
        $stock = Stock::first();
        $creator = User::first();
        $product = Product::first();

        $data = [
            'invoice_number' => 'INV-123',
            'date' => '2023-08-30',
            'supplier_id' => $supplier->id,
            'stock_id' => $stock->id,
            'creator_id' => $creator->id,
        ];
        $products = [
            [
                'product_id' => $product->id,
                'quantity' => 5,
                'discount' => 5.00,
            ]
        ];
        $taxes = [
            ['tax_id' => 1],
            ['tax_id' => 6],
        ];
        $purchase = Purchase::create($data);
        $purchase->products()->sync($products);
        $purchase->taxes()->sync($taxes);
    }
}
