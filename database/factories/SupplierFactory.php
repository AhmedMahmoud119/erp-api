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
    protected $id = 0;
    public function definition()
    {
        $parent = Account::inRandomOrder()->first();
        $account = Account::inRandomOrder()->first();

        return [
            'code' => $account->code . Supplier::max('id') + ++$this->id,
            'name' => $this->faker->name(),
            'email' => $this->faker->email(),
            'contact' => $this->faker->phoneNumber(),
            'parent_account_id' => $parent->id,
            'account_id' => $account->id,
            'currency_id' => Currency::inRandomOrder()->first()->id,
//            'address_id' => Address::inRandomOrder()->first()->id,
        ];
    }
}
