<?php

namespace Database\Factories;

use App\Domains\Currency\Models\Currency;
use App\Domains\User\Models\User;
use DB;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;


class CurrencyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Currency::class;
    public function definition()
    {
        $startDate = fake()->date();
        $currency_code = DB::table('currency_codes')->inRandomOrder()->first();
        return [
            'name' => $currency_code->name,
            'code' => $currency_code->code,
            'symbol' => $currency_code->symbol,
            'price_rate' => 'Custom',
            'price' => fake()->randomFloat(3, 0, 1000),
            'default' => fake()->numberBetween(0, 1),
            'creator_id' => User::inRandomOrder()->first()->id,
            'backup_changes' => null,
            'from' => $startDate,
            'to' => Carbon::parse($startDate)->addWeek(),
        ];

    }
}