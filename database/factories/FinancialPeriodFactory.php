<?php

namespace Database\Factories;

use App\Domains\FinancialPeriod\Models\FinancialPeriod;
use App\Domains\User\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Model>
 */
class FinancialPeriodFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = FinancialPeriod::class;
    public function definition()
    {
        return [
            'title' => fake()->name(),
            'start' => fake()->date(),
            'end' => fake()->date(),
            'created_at' => now(),
            'creator_id' => User::inRandomOrder()->first()->id,
        ];
    }
}
