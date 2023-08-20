<?php

namespace Database\Seeders;

use App\Domains\Tax\Models\Tax;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
use App\Domains\User\Models\User;
use App\Domains\Category\Models\Category;

class productsTableSeeder extends Seeder
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
        $unit = Unit::first();

        $product = [
            [
                'code' => 'P001',
                'name' =>'Product A',
                'description'=>'Product A description',
                'quantity'=>'30',
                'opening_stock'=>'100',
                'selling_prirce'=>'12.12',
                'purchase_prirce'=>'13.00',
                'category_id' => $category->id,
                'taxes_id' => $tax->id,
                'unit_id' => $unit->id ?? $unit->id , 1,
                'creator_id' => $creator->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'P001',
                'name' =>'Product B',
                'description'=>'Product B description',
                'quantity'=>'30',
                'opening_stock'=>'100',
                'selling_prirce'=>'12.12',
                'purchase_prirce'=>'13.00',
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
                'selling_price' => 10.99,
                'purchase_price' => 8.50,
                'category_id' => $category->id,
                'taxes_id' => $tax->id,
                'unit_id' => $unit->id,
                'creator_id' => $creator->id,
                ]
        ];

        DB::table('products')->insert($product[]);
    }
}
