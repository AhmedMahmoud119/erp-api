<?php

namespace Database\Factories;

use App\Domains\Account\Models\Account;
use App\Domains\Currency\Models\Currency;
use App\Domains\Supplier\Models\Supplier;
use App\Domains\Vendor\Models\Address;
use Illuminate\Database\Eloquent\Factories\Factory;

class SupplierFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Supplier::class;
    public function definition()
    {
        CurrencyFactory::times(5)->create();
        $currency = Currency::first();
        return [
            'code' => $this->faker->numberBetween(1, 2023),
            'name' => $this->faker->name(),
            'email' => fake()->unique()->safeEmail(),
            'contact' => $this->faker->phoneNumber(),
            'currency_id' => $currency->id,
            'address_id' => Address::first()->id,
            'parent_account_id' => Account::first()->id,
        ];
    }
}