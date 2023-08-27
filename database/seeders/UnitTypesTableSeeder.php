<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Domains\UnitType\Models\UnitType;

class UnitTypesTableSeeder extends Seeder
{
    public function run()
    {
        $unitTypesData = [
            [
                'name' => 'Type A',
                'description' => 'Description for Type A',
                'creator_id' => 1,
            ],
            [
                'name' => 'Type B',
                'description' => 'Description for Type B',
                'creator_id' => 1,
            ],
        ];

        foreach ($unitTypesData as $data) {
            UnitType::create($data);
        }
    }
}
