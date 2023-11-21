<?php

namespace Database\Seeders;

use App\Domains\Pack\Models\Pack;
use App\Domains\Product\Models\Product;
use Database\Factories\PackFactory;
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
        PackFactory::times(10)->create()
            ->each(function ($pack) {
                $pack->products()->saveMany(
                    Product::inRandomOrder()->limit(3)->get()
                );
            });
    }
}
