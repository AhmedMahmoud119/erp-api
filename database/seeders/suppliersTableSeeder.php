<?php

namespace Database\Seeders;

use App\Domains\Account\Models\Account;
use App\Domains\Currency\Models\Currency;
use App\Domains\Supplier\Models\Supplier;
use App\Domains\Vendor\Models\Address;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SuppliersTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Address::create([
            'phone' => '9876543210',
            'name' => 'another address name',
            'address' => 'another address details',
            'country_id' => 1,
            'city_id' => 1,
            'state_id' => 1,
            'zip_code' => '55555',
        ]);

        $acccount = Account::first()->id;
        $currency = Currency::first()->id;
        $address = Address::first()->id;


        Supplier::create([
            'name' => 'supplier',
            'email' => 'supplier@gmail.com',
            'contact' => '233-333-212',
            'parent_id' => $acccount,
            'currency_id' => $currency,
            'address_id' => $address,
        ]);
        Supplier::create([
            'name' => 'Another Supplier',
            'email' => 'another_supplier@example.com',
            'contact' => '444-555-666',
            'parent_id' => $acccount,
            'currency_id' => $currency,
            'address_id' => $address,
        ]);


    }
}
