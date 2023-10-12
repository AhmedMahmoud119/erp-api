<?php

namespace Database\Seeders;

use App\Domains\Vendor\Models\State;
use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatesTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $egyptStates = [
            [
                "ar" => "القاهرة",
                "en" => "Cairo",
            ],
            [
                "ar" => "الجيزة",
                "en" => "Giza",
            ],
            [
                "ar" => "الأسكندرية",
                "en" => "Alexandria",
            ],
            [
                "ar" => "الدقهلية",
                "en" => "Dakahlia",
            ],
            [
                "ar" => "البحر الأحمر",
                "en" => "Red Sea",
            ],
            [
                "ar" => "البحيرة",
                "en" => "Beheira",
            ],
            [
                "ar" => "الفيوم",
                "en" => "Fayoum",
            ],
            [
                "ar" => "الغربية",
                "en" => "Gharbiya",
            ],
            [
                "ar" => "الإسماعلية",
                "en" => "Ismailia",
            ],
            [
                "ar" => "المنوفية",
                "en" => "Menofia",
            ],
            [
                "ar" => "المنيا",
                "en" => "Minya",
            ],
            [
                "ar" => "القليوبية",
                "en" => "Qaliubiya",
            ],
            [
                "ar" => "الوادي الجديد",
                "en" => "New Valley",
            ],
            [
                "ar" => "السويس",
                "en" => "Suez",
            ],
            [
                "ar" => "اسوان",
                "en" => "Aswan",
            ],
            [
                "ar" => "اسيوط",
                "en" => "Assiut",
            ],
            [
                "ar" => "بني سويف",
                "en" => "Beni Suef",
            ],
            [
                "ar" => "بورسعيد",
                "en" => "Port Said",
            ],
            [
                "ar" => "دمياط",
                "en" => "Damietta",
            ],
            [
                "ar" => "الشرقية",
                "en" => "Sharkia",
            ],
            [
                "ar" => "جنوب سيناء",
                "en" => "South Sinai",
            ],
            [
                "ar" => "كفر الشيخ",
                "en" => "Kafr Al sheikh",
            ],
            [
                "ar" => "مطروح",
                "en" => "Matrouh",
            ],
            [
                "ar" => "الأقصر",
                "en" => "Luxor",
            ],
            [
                "ar" => "قنا",
                "en" => "Qena",
            ],
            [
                "ar" => "شمال سيناء",
                "en" => "North Sinai",
            ],
            [
                "ar" => "سوهاج",
                "en" => "Sohag",
            ],
        ];


        foreach ($egyptStates as $state) {
            State::create([
                'name' => $state
                ]+[
                'country_id' => 1
                ]);
        }

    }
}
