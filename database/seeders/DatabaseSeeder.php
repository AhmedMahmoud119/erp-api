<?php

namespace Database\Seeders;

use App\Domains\User\Models\User;
use Database\Seeders\AddressesTableSeeder;
use Database\Seeders\CitiesTableSeeder;
use Database\Seeders\CountriesTableSeeder;
use Database\Seeders\FinancialPeriodSeeder;
use Database\Seeders\StatesTableSeeder;
use Database\Seeders\TaxSeeder;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Database\Seeders\UnitTypesTableSeeder;

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
            TaxSeeder::class,
            // CompanySeeder::class,

            FinancialPeriodSeeder::class,
            CurrencyCodesSeeder::class,
            CountriesTableSeeder::class,
            StatesTableSeeder::class,
            CitiesTableSeeder::class,
            AddressesTableSeeder::class,
            UnitTypesTableSeeder::class,
        ]);

        //        $user->roles()->sync([1]);
        // $this->call(countriesTableSeeder::class);
        // $this->call(statesTableSeeder::class);
        // $this->call(citiesTableSeeder::class);
        // $this->call(AddressesTableSeeder::class);
    }
}
