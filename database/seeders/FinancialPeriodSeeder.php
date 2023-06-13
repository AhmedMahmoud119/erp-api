<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Domains\FinancialPeriod\Models\FinancialPeriod;


class FinancialPeriodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        FinancialPeriod::create([
            'financial_Year' => '2020-2021',
            'status' => '0',
            'financial_Year_Start' => '2023-6-6',
            'financial_Year_End' => '2023-6-7',
            'creator_id' => '1',
        ]);
    }
}
