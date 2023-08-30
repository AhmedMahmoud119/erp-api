<?php

namespace Database\Factories;

use App\Domains\Currency\Models\Currency;
use App\Domains\User\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CurrencyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Currency::class;
    /**
     * Summary of definition
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'code' => $this->faker->numberBetween(100, 1000),
            'symbol' => $this->faker->text(5),
            'price_rate' => $this->faker->numberBetween(1, 100),
            'price' => $this->faker->numberBetween(1, 100),
            'backup_changes' => $this->faker->text(100),
            'from' => $this->faker->date(),
            'to' => $this->faker->date(),
            'creator_id' => User::first()->id,
        ];
    }
}
