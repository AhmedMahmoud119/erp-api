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
            'code' => '1',
            'name' => 'Assets',
            'is_fixed' => 1,
            'creator_id'=>1
        ]);
        GroupType::create([
            'code' => '2',
            'name' => 'Liabilities',
            'is_fixed' => 1,
            'creator_id'=>1
        ]);
        GroupType::create([
            'code' => '3',
            'name' => 'Equity',
            'is_fixed' => 1,
            'creator_id'=>1
        ]);
        GroupType::create([
            'code' => '4',
            'name' => 'Revenue',
            'is_fixed' => 1,
            'creator_id'=>1
        ]);
        GroupType::create([
            'code' => '5',
            'name' => 'Expenses',
            'is_fixed' => 1,
            'creator_id'=>1
        ]);
    }
}
