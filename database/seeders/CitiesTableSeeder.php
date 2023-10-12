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
                'ar' => "Nasr City",
                'en' => 'مدينة نصر'
            ],
            [
                'ar' => 'Abbasiya',
                'en' => 'عباسية',
            ],[
                'ar' => 'Agouza',
                'en' => 'العجوزة',
            ],[
                'ar' => 'Ain Shams',
                'en' => 'عين شمس',
            ],[
                'ar' => 'Bulaq',
                'en' => 'بولاق',
            ],[
                'ar' => 'Downtown Cairo',
                'en' => 'وسط البلد',
            ],[
                'ar' => 'El Basatin',
                'en' => 'البساتين',
            ],[
                'ar' => 'El Marg',
                'en' => 'المرج',
            ],[
                'ar' => 'El Matareya',
                'en' => 'المطرية',
            ],[
                'ar' => 'El Mosky',
                'en' => 'الموسكي',
            ],[
                'ar' => 'El Nozha',
                'en' => 'النزهة',
            ],[
                'ar' => 'El Sayeda Zeinab',
                'en' => 'السيدة زينت',
            ],[
                'ar' => 'El Shorouk',
                'en' => 'الشروق',
            ],[
                'ar' => 'El Tagamu El Khames',
                'en' => 'التجمع الخامس',
            ],[
                'ar' => 'Garden City',
                'en' => 'جاردن سيتي',
            ],[
                'ar' => 'Giza',
                'en' => 'الجيزة',
            ],[
                'ar' => 'Heliopolis',
                'en' => 'هيليوبوليس',
            ],[
                'ar' => 'Maadi',
                'en' => 'المعادي',
            ],[
                'ar' => 'Mohandessin',
                'en' => 'المهندسين',
            ],[
                'ar' => 'New Cairo',
                'en' => 'القاهره الجديدة',
            ],[
                'ar' => 'Obour',
                'en' => 'العبور',
            ],[
                'ar' => 'Old Cairo',
                'en' => 'مصر القديمة',
            ],[
                'ar' => 'Rod El Farag',
                'en' => 'روض الفرج',
            ],[
                'ar' => 'Shubra',
                'en' => 'شبرا',
            ],[
                'ar' => 'Zamalek',
                'en' => 'الزمالك',
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
