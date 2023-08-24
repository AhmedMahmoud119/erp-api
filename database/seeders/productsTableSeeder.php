<?php

namespace Database\Seeders;

use App\Domains\Product\Models\Product;
use App\Domains\Product\Models\Spec;
use App\Domains\Tax\Models\Tax;
use App\Domains\UnitType\Models\UnitType;
use Illuminate\Database\Seeder;
use DB;
use App\Domains\User\Models\User;
use App\Domains\Category\Models\Category;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = Category::first();
        $tax = Tax::first();
        $creator = User::first();
        $unit = UnitType::first();


        $specs = [
            [
                'id' => '1',
                'name' => 'length',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => '2',
                'name' => 'width',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];
        Spec::insert($specs);

        $product = [
            [
                'code' => 'P001',
                'name' => 'Product A',
                'description' => 'Product A description',
                'quantity' => 30,
                'opening_stock' => 100,
                'selling_price' => 12.12,
                'purchase_price' => 13.00,
                'category_id' => $category->id,
                'taxes_id' => $tax->id,
                'unit_id' => $unit->id,
                'creator_id' => $creator->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'P001',
                'name' => 'Product B',
                'description' => 'Product B description',
                'quantity' => 30,
                'opening_stock' => 100,
                'selling_prirce' => 12.12,
                'purchase_prirce' => 13.00,
                'category_id' => $category->id,
                'taxes_id' => $tax->id,
                'unit_id' => $unit->id,
                'creator_id' => $creator->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'P001',
                'name' => 'Product 1',
                'description' => 'Description of Product 1',
                'quantity' => 100,
                'opening_stock' => 100,
                'selling_prirce' => 12.12,
                'purchase_prirce' => 13.00,
                'category_id' => $category->id,
                'taxes_id' => $tax->id,
                'unit_id' => $unit->id,
                'creator_id' => $creator->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];

        Product::insert($product);


    }
}