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
            'is_fixed' => true,
        ]);
        GroupType::create([
            'code' => '2000',
            'name' => 'Liabilities',
            'is_fixed' => true,
        ]);
        GroupType::create([
            'code' => '3000',
            'name' => 'Equity',
            'is_fixed' => true,
        ]);
        GroupType::create([
            'code' => '4000',
            'name' => 'Revenue',
            'is_fixed' => true,
        ]);
        GroupType::create([
            'code' => '5000',
            'name' => 'Expenses',
            'is_fixed' => true,
        ]);
    }
}
