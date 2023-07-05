<?php

namespace Database\Seeders;

use App\Domains\GroupType\Models\GroupType;
use Database\Factories\GroupTypeFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GroupTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        GroupType::create([
            'code' => '1000',
            'name' => 'Assets',
        ]);
        GroupType::create([
            'code' => '2000',
            'name' => 'Liabilities',
        ]);
        GroupType::create([
            'code' => '3000',
            'name' => 'Equity',
        ]);
        GroupType::create([
            'code' => '4000',
            'name' => 'Revenue',
        ]);
        GroupType::create([
            'code' => '5000',
            'name' => 'Expenses',
        ]);
    }
}
