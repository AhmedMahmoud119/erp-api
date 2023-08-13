<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**w
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\=Currency>
 */
class CurrencyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'code' => $this->faker->numberBetween(1000, 9999),
            'symbol' => $this->faker->name(),
            'creator_id' => $this->faker->numberBetween(1, 10),
            'from' => $this->faker->numberBetween(1, 10),
            'to' => $this->faker->numberBetween(1, 10),
            'backup_changes' => $this->faker->numberBetween(1, 10),
            'price_rate' => $this->faker->numberBetween(1, 10),
            'price' => $this->faker->numberBetween(1, 10),
            'default' => $this->faker->numberBetween(1, 10),

        ];
    }
}
