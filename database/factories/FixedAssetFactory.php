<?php

namespace Database\Factories;

use App\Domains\Account\Models\Account;
use App\Domains\FixedAsset\Models\FixedAsset;
use App\Domains\User\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class FixedAssetFactory extends Factory
{
    protected $model = FixedAsset::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $AccCode = Account::pluck('code');
        return [
            'code' => $this->faker->randomElement($AccCode) . '000' . $this->faker->numberBetween(1, 10),
            'name' => $this->faker->name(),
            'description' => $this->faker->realText(),
            'acquisition_date' => $this->faker->date('Y-m-d'),
            'acquisition_value' => $this->faker->numberBetween(1, 100000),
            'depreciation_ratio' => $this->faker->randomFloat(2, 0, 0),
            'depreciation_duration_value' => $this->faker->numberBetween(1, 100),
            'depreciation_duration_type' => $this->faker->randomElement(['month', 'year']),
            'depreciation_value' => $this->faker->numberBetween(1, 1000),
            'depreciation' => $this->faker->numberBetween(1, 1000),
            'parent_id' => Account::inRandomOrder()->first()->id,
            'parent_type' => Account::class,
            'creator_id' => User::inRandomOrder()->first()->id,
        ];
    }
}
