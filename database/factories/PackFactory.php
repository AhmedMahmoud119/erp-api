<?php

namespace Database\Factories;

use App\Domains\Pack\Models\Pack;
use App\Domains\User\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Model>
 */
class PackFactory extends Factory
{
    protected $model = Pack::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'description' => $this->faker->text(),
            'material' => $this->faker->text(10),
            'quantity' => $this->faker->numberBetween(0, 20),
            'price' => $this->faker->randomFloat(null, 2000),
            'weight' => $this->faker->randomFloat(null, 1, 300),
            'width' => $this->faker->randomFloat(null, 1, 300),
            'length' => $this->faker->randomFloat(null, 1, 300),
            'height' => $this->faker->randomFloat(null, 1, 300),
            'creator_id' => User::inRandomOrder()->first()->id,
        ];
    }
}
