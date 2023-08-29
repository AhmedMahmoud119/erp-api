<?php

namespace Database\Factories;

use App\Domains\Vendor\Models\Address;
use App\Domains\Vendor\Models\City;
use App\Domains\Vendor\Models\Country;
use App\Domains\Vendor\Models\State;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Model>
 */
class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Address::class;

    public function definition()
    {
        return [
            'address'  => $this->faker->address(),
            'phone'   => $this->faker->phoneNumber(),
            'name'  => $this->faker->name(),
            'zip_code' => $this->faker->postcode(),
            'state_id' => State::inRandomOrder()->first()->id,
            'city_id' => City::inRandomOrder()->first()->id,
            'country_id' => Country::inRandomOrder()->first()->id,
        ];
    }
}
