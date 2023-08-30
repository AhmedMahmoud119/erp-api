<?php

namespace Database\Seeders;

use Database\Factories\JournalEntryDetailsFactory;
use Database\Factories\JournalEntryFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JournalEntrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        JournalEntryFactory::times(10)->create()
            ->each(function ($journalEntry) {
                $journalEntry->details()->saveMany(
                    JournalEntryDetailsFactory::times(2)->make()
                );
            });
    }
}
