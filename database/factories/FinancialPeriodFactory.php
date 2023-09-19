<?php

namespace Database\Factories;

use App\Domains\FinancialPeriod\Models\FinancialPeriod;
use App\Domains\User\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

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
        $startDate = fake()->date();
        return [
            'title' => fake()->name(),
            'start' => $startDate,
            'end' => Carbon::parse($startDate)->addMonth(),
            'created_at' => now(),
            'status' => 'open',
            'creator_id' => User::inRandomOrder()->first()->id,
        ];
    }
}