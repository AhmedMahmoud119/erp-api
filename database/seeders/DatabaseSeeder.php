<?php

namespace Database\Seeders;

use App\Domains\User\Models\User;
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
        $user=User::firstOrCreate(['email' => 'admin@admin.com'], [
            'name' => 'super-admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('123456'),
        ]);

        $this->call([
            PermissionsTableSeeder::class,
           GroupTypeSeeder::class,
//            FinancialPeriodSeeder::class,
            // TaxSeeder::class,
           CurrencyCodesSeeder::class,
        ]);

        $user->roles()->sync([1]);
    }
}
