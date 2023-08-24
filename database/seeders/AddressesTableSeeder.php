<?php

namespace Database\Seeders;

use App\Domains\Vendor\Models\City;
use App\Domains\Vendor\Models\Country;
use App\Domains\Vendor\Models\State;
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
        $city = City::first()->id;
        $country = Country::first()->id;
        $state = State::first()->id;
        $addresses = [
            [
                'address' => '456 Main Street',
                'phone' => '01012345678',
                'name' => 'Abbass alaqad',
                'zip_code' => '12345',
                'state_id' => $state,
                'city_id' => $city,
                'country_id' => $country,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'address' => '123 Main Street',
                'phone' => '01112345678',
                'name' => 'Makram ebid',
                'zip_code' => '12345',
                'state_id' => $state,
                'city_id' => $city,
                'country_id' => $country,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('addresses')->insert($addresses);
    }
}