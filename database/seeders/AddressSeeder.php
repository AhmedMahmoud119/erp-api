<?php

namespace Database\Seeders;

use Database\Factories\AddressFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AddressFactory::times(10)->create();
    }
}
