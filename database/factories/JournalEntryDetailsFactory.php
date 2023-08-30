<?php

namespace Database\Factories;

use App\Domains\Account\Models\Account;
use App\Domains\JournalEntry\Models\JournalEntry;
use App\Domains\JournalEntry\Models\JournalEntryDetail;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\=JournalEntryDetails>
 */
class JournalEntryDetailsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = JournalEntryDetail::class;

    public function definition()
    {

        return [
            'journal_entry_id' => JournalEntry::inRandomOrder()->first()->id,
            'account_id' =>  Account::inRandomOrder()->first()->id,
            'debit' => $this->faker->numberBetween(1000, 9999),
            'credit' => $this->faker->numberBetween(1000, 9999),
            'description' => $this->faker->text(),
        ];
    }
}
