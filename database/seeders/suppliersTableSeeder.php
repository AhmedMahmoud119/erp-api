<?php

namespace Database\Seeders;

use App\Domains\Supplier\Models\Supplier;
use App\Domains\Vendor\Models\Address;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class suppliersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Address::create([
            'id'=> 1,
            'phone' => '9876543210',
            'name' => 'another address name',
            'address' => 'another address details',
            'country_id' => 1,
            'city_id' => 1,
            'state_id' => 1,
            'zip_code' => '55555',
        ]);

        Address::create([
            'id'=> 2,
            'phone' => '9876543210',
            'name' => 'another address name',
            'address' => 'another address details',
            'country_id' => 1,
            'city_id' => 1,
            'state_id' => 1,
            'zip_code' => '55455',
        ]);
        Supplier::create([
            'name' => 'supplier',
            'email' => 'supplier@gmail.com',
            'contact' => '233-333-212',
            'parent' => 1,
            'currency_id' => 1,
            'address_id' => 1,
        ]);
        Supplier::create([
            'name' => 'Another Supplier',
            'email' => 'another_supplier@example.com',
            'contact' => '444-555-666',
            'parent' => 1,
            'currency_id' => 1,
            'address_id' => 1,
        ]);
    }
}
