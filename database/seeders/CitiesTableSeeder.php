<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $CairoCities = [
            "Nasr City",
            "Abbasiya",
            "Agouza",
            "Ain Shams",
            "Bulaq",
            "Downtown Cairo",
            "El Basatin",
            "El Marg",
            "El Matareya",
            "El Mosky",
            "El Nozha",
            "El Sayeda Zeinab",
            "El Shorouk",
            "El Tagamu El Khames",
            "Garden City",
            "Giza",
            "Heliopolis",
            "Maadi",
            "Mohandessin",
            "New Cairo",
            "Obour",
            "Old Cairo",
            "Rod El Farag",
            "Shubra",
            "Zamalek"
        ];

        $citiesData = [];
        foreach ($CairoCities as $city) {
            $citiesData[] = [
                'name' => $city,
                'state_id' => 1,
                'country_id' => 1
            ];
        }

        DB::table('cities')->insert($citiesData);
    }
}
