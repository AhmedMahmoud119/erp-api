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
        $acccount = Account::first();
        $currency = Currency::first()->id;
        $address = Address::first()->id;
        $spplierMaxId = Supplier::max('id') ?? 0;

        return [
                'code' => $acccount->code . ($spplierMaxId + 1),
                'name' => $this->faker->name(),
                'email' => $this->faker->email(),
                'contact' => $this->faker->phoneNumber(),
                'parent_account_id' => $acccount->id,
                'currency_id' => $currency,
                'address_id' => $address,
        ];
    }
}
