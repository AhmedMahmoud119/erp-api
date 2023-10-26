<?php

namespace Database\Seeders;

use Database\Factories\CashManagementFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CashManagementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CashManagementFactory::new()->count(10)->create();
    }
}
