<?php

namespace Database\Factories;

use App\Domains\Company\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\=Company>
 */
class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Company::class;
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'status' => $this->faker->numberBetween(1, 10),
            'creator_id' => $this->faker->numberBetween(1, 10),
            'tenant_id' => $this->faker->numberBetween(1, 10),
            'user_id' => $this->faker->numberBetween(1, 10),
            'description' => $this->faker->text()
        ];
    }
}
