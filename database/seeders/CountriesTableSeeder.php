<?php

namespace Database\Seeders;

use App\Domains\Vendor\Models\Country;
use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CountriesTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Country::create([
            'name' => [
                'ar' => 'مصر',
                'en' => 'Egypt',
            ]
        ]);

        Country::create([
            'name' => [
                'ar' => 'السعودية',
                'en' => 'Saudi Arabia',
            ]
        ]);
    }
}
