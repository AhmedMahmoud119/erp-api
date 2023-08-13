<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\=BankAccount>
 */
class BankAccountFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'account_number' => $this->faker->numberBetween(1000, 9999),
            'holder_name' => $this->faker->name(),
            'account_type' => $this->faker->randomElement(['credit', 'debit']),
            'chart_of_account' => $this->faker->numberBetween(1, 10),
            'currency_id' => $this->faker->numberBetween(1, 10),
            'opening_balance' => $this->faker->numberBetween(1000, 9999),
            'creator_id' => $this->faker->numberBetween(1, 10),
            'current_balance' => $this->faker->numberBetween(1000, 9999),
            'status' => $this->faker->randomElement(['active', 'inactive']),
            'authorized_by' => $this->faker->numberBetween(1, 10),
        ];
    }
}
