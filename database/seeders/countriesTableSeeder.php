<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class countriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('countries')->insert([
            [
                'id' => 1,
                'name' => 'Egypt',
            ],
            [
                'id' => 2,
                'name' => 'Saudi Arabia',
            ],
        ]);    
    }
}
