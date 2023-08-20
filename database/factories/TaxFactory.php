<?php

namespace Database\Factories;

use App\Domains\Tax\Models\Tax;
use App\Domains\User\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Tax>
 */
class TaxFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Tax::class;

    public function definition()
    {
        return [
            'name' => fake()->name(),
            'percentage' => fake()->numberBetween(1,100),
            'created_at' => now(),
            'creator_id' => User::inRandomOrder()->first(),
        ];
    }
}
