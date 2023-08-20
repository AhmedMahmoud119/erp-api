<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Domains\Account\Models\Account>
 */
class AccountFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = \App\Domains\Account\Models\Account::class;
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'code' => $this->faker->numberBetween(1000, 9999),
            'creator_id' => $this->faker->numberBetween(1, 10),
            'group_id' => $this->faker->numberBetween(1, 10),
            'account_type' => $this->faker->numberBetween(1, 10),
            'opening_balance' => $this->faker->numberBetween(1000, 9999),
            'parent_id' => null
        ];
    }
}
