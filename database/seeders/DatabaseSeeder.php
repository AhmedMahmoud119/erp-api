<?php

namespace Database\Seeders;

use App\Domains\User\Models\User;
use Database\Seeders\AddressesTableSeeder;
use Database\Seeders\citiesTableSeeder;
use Database\Seeders\countriesTableSeeder;
use Database\Seeders\statesTableSeeder;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Database\Seeders\TaxSeeder;
use Database\Seeders\FinancialPeriodSeeder;

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
            countriesTableSeeder::class,
            statesTableSeeder::class,
            citiesTableSeeder::class,
            AddressesTableSeeder::class
        ]);

        //        $user->roles()->sync([1]);
        // $this->call(countriesTableSeeder::class);
        // $this->call(statesTableSeeder::class);
        // $this->call(citiesTableSeeder::class);
        // $this->call(AddressesTableSeeder::class);
    }
}
