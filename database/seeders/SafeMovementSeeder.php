<?php

namespace Database\Seeders;

use Database\Factories\SafeMovementFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SafeMovementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SafeMovementFactory::new()->count(10)->create();
    }
}
