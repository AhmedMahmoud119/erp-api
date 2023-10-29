<?php

namespace Database\Factories;

use App\Domains\Account\Models\Account;
use App\Domains\User\Models\User;
use App\Domains\CashManagment\Models\CashManagment;
use Illuminate\Database\Eloquent\Factories\Factory;

class CashManagementFactory extends Factory
{
    protected $model = CashManagment::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'date' => $this->faker->date('Y-m-d'),
            'payment_method' => $this->faker->randomElement(['installment', 'cash']),
            'type' => $this->faker->randomElement(['creditor', 'debtor']),
            'amount' => $this->faker->randomFloat(),
            'account_id' => Account::where('is_parent', 1)->inRandomOrder()->first()->id,
            'cashable_id' => Account::where('is_parent', 0)->inRandomOrder()->first()->id,
            'description' => $this->faker->realText(200),
            'creator_id' => User::inRandomOrder()->first()->id,
        ];
    }
}
