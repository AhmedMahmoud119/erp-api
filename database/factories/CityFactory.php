<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Model>
 */
class CityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name'  => $this->faker->city(),
            'state_id' => $this->faker->numberBetween(1, 10),
            'country_id' => $this->faker->numberBetween(1, 10)
        ];
    }
}
