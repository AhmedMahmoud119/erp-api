<?php

namespace Database\Seeders;

use App\Domains\Account\Models\Account;
use App\Domains\Currency\Models\Currency;
use App\Domains\Supplier\Models\Supplier;
use App\Domains\Vendor\Models\Address;
use Database\Factories\SupplierFactory;
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

        SupplierFactory::times(10)->create();

    }
}
