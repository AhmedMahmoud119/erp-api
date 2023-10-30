<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Domains\FinancialPeriod\Models\FinancialPeriod;
use Database\Factories\FinancialPeriodFactory;

class FinancialPeriodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        FinancialPeriodFactory::new()->count(1)->create();
    }
}
