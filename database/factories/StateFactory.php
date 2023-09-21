<?php

namespace Database\Factories;

use App\Domains\Vendor\Models\Country;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Model>
 */
class StateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name'  => $this->faker->state(),
            'country_id' => Country::inRandomOrder()->first()->id,
        ];
    }
}
