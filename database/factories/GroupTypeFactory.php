<?php

namespace Database\Factories;

use App\Domains\User\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\=GroupType>
 */
class GroupTypeFactory extends Factory
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
            'code' =>  $this->faker->numberBetween(1000, 9999),
            'creator_id' => User::inRandomOrder()->first()->id,
        ];
    }
}
