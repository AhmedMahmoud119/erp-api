<?php

namespace Database\Factories;

use App\Domains\Account\Models\Account;
use App\Domains\Group\Models\Group;
use App\Domains\User\Models\User;
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
            'creator_id' => User::inRandomOrder()->first()->id,
            'group_id' => Group::inRandomOrder()->first()->id,
            'account_type' => $this->faker->randomElement(['debit', 'credit', 'both']),
            'opening_balance' => $this->faker->numberBetween(1000, 9999),
            'parent_id' => null,
        ];
    }
}
