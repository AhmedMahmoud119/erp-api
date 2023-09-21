<?php

namespace Database\Factories;

use App\Domains\User\Models\User;
use App\Domains\Vendor\Models\Vendor;
use App\Domains\Account\Models\Account;
use App\Domains\Currency\Models\Currency;
use App\Domains\Vendor\Models\Address;
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
        $account = Account::first();
        $currency = Currency::first()->id;
        $address = Address::first()->id;
        $vendorMaxId = Vendor::max('id') ?? 0;

        return [
            'code' => $account->code . ($vendorMaxId + 1),
            'name' => $this->faker->name(),
            'email' => $this->faker->email(),
            'contact' => $this->faker->phoneNumber(),
            'parent_account_id' => $account->id,
            'currency_id' => $currency,
            'address_id' => $address,
            'billing_address_id' => $address,
            'creator_id' => User::first()->id,
        ];
    }
}
