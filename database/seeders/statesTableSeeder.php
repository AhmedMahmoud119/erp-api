<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class statesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $egyptStates = [
            "Cairo",
            "Alexandria",
            "Giza",
            "Sharm El Sheikh",
            "Luxor",
            "Aswan",
            "Hurghada",
            "Mansoura",
            "Tanta",
            "Suez",
            "Port Said",
            "Assiut",
            "Zagazig",
            "Ismailia",
            "El Mahalla El Kubra",
            "Minya",
            "Beni Suef",
            "Sohag",
            "Banha",
            "Qena"
        ];

        $statesData = [];
        foreach ($egyptStates as $state) {
            $statesData[] = ['name' => $state];
        }

        DB::table('states')->insert($statesData);
    }
}
