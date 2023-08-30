<?php

namespace Database\Factories;

use App\Domains\Account\Models\Account;
use App\Domains\Currency\Models\Currency;
use App\Domains\Customer\Models\Customer;
use App\Domains\User\Models\User;
use App\Domains\Vendor\Models\Address;
use Database\Factories\CurrencyFactory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\=JournalEntry>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Customer::class;
    public function definition()
    {
        CurrencyFactory::times(5)->create();
        $Currency = Currency::first();
        return [
            'name' => $this->faker->name(),
            'code' => $this->faker->numberBetween(10, 100),
            'contact' => $this->faker->phoneNumber(),
            'email' => fake()->unique()->safeEmail(),
            'creator_id' => User::first()->id,
            'address_id' => Address::first()->id,
            'billing_address_id' => Address::first()->id,
            'currency_id' => $Currency->id,
            'parent_account_id' => Account::first()->id,
        ];
    }
}
