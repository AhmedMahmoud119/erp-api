<?php

namespace Database\Factories;

use App\Domains\Account\Models\Account;
use App\Domains\Currency\Models\Currency;
use App\Domains\User\Models\User;
use App\Domains\Vendor\Models\Address;
use App\Domains\Vendor\Models\Vendor;
use Illuminate\Database\Eloquent\Factories\Factory;

class VendorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Vendor::class;
    public function definition()
    {
        CurrencyFactory::times(5)->create();
        $Currency = Currency::first();
        return [
            'name' => $this->faker->name(),
            'code' => $this->faker->numberBetween(1, 2023),
            'contact' => $this->faker->phoneNumber(),
            'email' => fake()->unique()->safeEmail(),
            'currency_id' => $Currency->id,
            'creator_id' => User::first()->id,
            'address_id' => Address::first()->id,
            'billing_address_id' => Address::first()->id,
            'parent_account_id' => Account::first()->id,
        ];
    }
}
