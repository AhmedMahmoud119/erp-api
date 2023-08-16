<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AddressesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $addresses = [
            [
                'address' => '456 Main Street',
                'phone' => '01012345678',
                'name' => 'Abbass alaqad',
                'zip_code' => '12345',
                'state_id' => 1, 
                'city_id' => 1, 
                'country_id' => 1, 
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'address' => '123 Main Street',
                'phone' => '01112345678',
                'name' => 'Makram ebid',
                'zip_code' => '12345',
                'state_id' => 1, 
                'city_id' => 1, 
                'country_id' => 1, 
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('addresses')->insert($addresses);
    }
}
