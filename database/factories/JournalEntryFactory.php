<?php

namespace Database\Factories;

use App\Domains\JournalEntry\Models\JournalEntry;
use App\Domains\User\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\=JournalEntry>
 */
class JournalEntryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = JournalEntry::class;

    public function definition()
    {
        return [
            'title' => $this->faker->name(),
            'entry_no' => $this->faker->numberBetween(1, 10),
            'date' => $this->faker->date(),
            'description' => $this->faker->text(),
            'creator_id' => User::inRandomOrder()->first()->id,
        ];
    }
}
