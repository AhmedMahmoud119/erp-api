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
    protected $id = 0;

    public function definition()
    {
        $account = Account::inRandomOrder()->first();

        return [
            'code' => $account->code . Vendor::max('id') + ++$this->id,
            'name' => $this->faker->name(),
            'email' => $this->faker->email(),
            'contact' => $this->faker->phoneNumber(),
            'parent_account_id' => $account->id,
            'currency_id' => Currency::inRandomOrder()->first()->id,
            'address_id' => Address::inRandomOrder()->first()->id,
            'billing_address_id' => Address::inRandomOrder()->first()->id,
            'creator_id' => User::first()->id,
        ];
    }

}
