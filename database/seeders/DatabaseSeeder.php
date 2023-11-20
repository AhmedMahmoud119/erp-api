<?php

namespace Database\Seeders;

use App\Domains\User\Models\User;
use Database\Seeders\AddressesTableSeeder;
use Database\Seeders\CategoriesTableSeeder;
use Database\Seeders\CitiesTableSeeder;
use Database\Seeders\CountriesTableSeeder;
use Database\Seeders\CurrencyCodesSeeder;
use Database\Seeders\ProductsTableSeeder;
use Database\Seeders\StatesTableSeeder;
use Database\Seeders\StocksTableSeeder;
use Database\Seeders\SuppliersTableSeeder;
use Database\Seeders\UnitTypesTableSeeder;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Database\Seeders\PacksTableSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = User::firstOrCreate(['email' => 'admin@admin.com'], [
            'name' => 'super-admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('123456'),
        ]);

        $this->call([
            PermissionsTableSeeder::class,
            GroupTypeSeeder::class,
//            TaxSeeder::class,
            // CompanySeeder::class,
//            FinancialPeriodSeeder::class,
            // JournalEntrySeeder::class,
            CurrencyCodesSeeder::class,
            CurrencySeederTable::class,
            CountriesTableSeeder::class,
            StatesTableSeeder::class,
            CitiesTableSeeder::class,
//            AddressesTableSeeder::class,
//            AddressSeeder::class,
//            UnitTypesTableSeeder::class,
//            CategoriesTableSeeder::class,
//            ProductsTableSeeder::class,
//            WarehouseSeeder::class,
//            StocksTableSeeder::class,
//            PacksTableSeeder::class,
//            SuppliersTableSeeder::class,
//            VendorSeeder::class,
//            FixedAssetSeeder::class,
//            SafeMovementSeeder::class,
//            CashManagementSeeder::class,

        ]);

    }
}
