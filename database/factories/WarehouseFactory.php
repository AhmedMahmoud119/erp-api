<?php

namespace Database\Factories;

use App\Domains\User\Models\User;
use App\Domains\Vendor\Models\Address;
use App\Domains\Warehouse\Models\Warehouse;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Model>
 */
class WarehouseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Warehouse::class;
    public function definition()
    {

        return [
            'name' => $this->faker->unique()->name(),
            'description' => $this->faker->text(),
            'assigned_id' => User::inRandomOrder()->first()->id,
            'creator_id' => User::inRandomOrder()->first()->id,
            'address_id' => Address::inRandomOrder()->first()->id,
        ];
    }
}
