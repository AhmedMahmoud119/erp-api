<?php

namespace Database\Seeders;

use App\Domains\Vendor\Models\City;
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
            [
                'en' => "Nasr City",
                'ar'=> 'مدينة نصر'
            ],
            [
                'en' => 'Abbasiya',
                'ar'=> 'عباسية',
            ],[
                'en' => 'Agouza',
                'ar'=> 'العجوزة',
            ],[
                'en' => 'Ain Shams',
                'ar'=> 'عين شمس',
            ],[
                'en' => 'Bulaq',
                'ar'=> 'بولاق',
            ],[
                'en' => 'Downtown Cairo',
                'ar'=> 'وسط البلد',
            ],[
                'en' => 'El Basatin',
                'ar'=> 'البساتين',
            ],[
                'en' => 'El Marg',
                'ar'=> 'المرج',
            ],[
                'en' => 'El Matareya',
                'ar'=> 'المطرية',
            ],[
                'en' => 'El Mosky',
                'ar'=> 'الموسكي',
            ],[
                'en' => 'El Nozha',
                'ar'=> 'النزهة',
            ],[
                'en' => 'El Sayeda Zeinab',
                'ar'=> 'السيدة زينت',
            ],[
                'en' => 'El Shorouk',
                'ar'=> 'الشروق',
            ],[
                'en' => 'El Tagamu El Khames',
                'ar'=> 'التجمع الخامس',
            ],[
                'en' => 'Garden City',
                'ar'=> 'جاردن سيتي',
            ],[
                'en' => 'Giza',
                'ar'=> 'الجيزة',
            ],[
                'en' => 'Heliopolis',
                'ar'=> 'هيليوبوليس',
            ],[
                'en' => 'Maadi',
                'ar'=> 'المعادي',
            ],[
                'en' => 'Mohandessin',
                'ar'=> 'المهندسين',
            ],[
                'en' => 'New Cairo',
                'ar'=> 'القاهره الجديدة',
            ],[
                'en' => 'Obour',
                'ar'=> 'العبور',
            ],[
                'en' => 'Old Cairo',
                'ar'=> 'مصر القديمة',
            ],[
                'en' => 'Rod El Farag',
                'ar'=> 'روض الفرج',
            ],[
                'en' => 'Shubra',
                'ar'=> 'شبرا',
            ],[
                'en' => 'Zamalek',
                'ar'=> 'الزمالك',
            ]
        ];

        foreach ($CairoCities as $city) {
            $citiesData = [
                'name' => $city,
                'state_id' => 1,
                'country_id' => 1
            ];
            City::create($citiesData);
        }

    }
}
