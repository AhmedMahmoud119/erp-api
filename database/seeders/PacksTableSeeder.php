<?php

namespace Database\Seeders;

use App\Domains\Pack\Models\Pack;
use App\Domains\Product\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Foundation\Auth\User;

class PacksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $creator = User::first();
        $packsData = [
            [
                'name' => 'Sample Pack 1',
                'description' => 'Description of Sample Pack 1',
                'material' => 'Material 1',
                'quantity' => 10,
                'selling_prirce' => 50.00,
                'purchase_prirce' => 40.00,
                'retail_prirce' => 60.00,
                'weight' => 2.5,
                'width' => 10.0,
                'length' => 15.0,
                'height' => 5.0,
                'creator_id' => $creator->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sample Pack 2',
                'description' => 'Description of Sample Pack 2',
                'material' => 'Material 2',
                'quantity' => 20,
                'selling_prirce' => 75.00,
                'purchase_prirce' => 60.00,
                'retail_prirce' => 90.00,
                'weight' => 3.0,
                'width' => 12.0,
                'length' => 18.0,
                'height' => 6.0,
                'creator_id' => $creator->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($packsData as $packData) {
            $pack = Pack::create($packData, );
            $products = Product::inRandomOrder()->limit(3)->get();
            $pack->products()->attach($products);
        }

    }
}
