<?php

namespace Database\Seeders;

use Database\Factories\FixedAssetFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FixedAssetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        FixedAssetFactory::new()->count(10)->create();
    }
}
