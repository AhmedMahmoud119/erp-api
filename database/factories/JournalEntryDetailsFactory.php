<?php

namespace Database\Factories;

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
    public function definition()
    {
        return [
            'journal_entry_id' => $this->faker->numberBetween(1, 10),
            'account_id' => $this->faker->numberBetween(1, 10),
            'debit' => $this->faker->numberBetween(1000, 9999),
            'credit' => $this->faker->numberBetween(1000, 9999),
            'description' => $this->faker->text(),
            'tax_id' => $this->faker->numberBetween(1, 10),
        ];
    }
}
