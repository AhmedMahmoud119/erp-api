<?php

namespace Database\Factories;

use App\Domains\Account\Models\Account;
use App\Domains\SafeMovement\Models\SafeMovement;
use App\Domains\User\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class SafeMovementFactory extends Factory
{
    protected $model = SafeMovement::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'date' => $this->faker->date('Y-m-d'),
            'description' => $this->faker->realText(200),
            'assets_involved' => $this->faker->randomElement(['table', 'building', 'chair', 'laptop']),
            'amount' => $this->faker->randomFloat(),
            'source_id' => Account::inRandomOrder()->first()->id,
            'destination_id' => Account::inRandomOrder()->first()->id,
            'creator_id' => User::inRandomOrder()->first()->id,
        ];
    }
}
