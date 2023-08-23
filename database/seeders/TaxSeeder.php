<?php

namespace Database\Seeders;

use App\Domains\Tax\Models\Tax;
use Database\Factories\TaxFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaxSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TaxFactory::new()->count(10)->create();
    }
}
