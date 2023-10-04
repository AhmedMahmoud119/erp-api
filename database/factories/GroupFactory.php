<?php

namespace Database\Factories;

use App\Domains\GroupType\Models\GroupType;
use App\Domains\User\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Domains\Group\Models\Group>
 */
class GroupFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = \App\Domains\Group\Models\Group::class;
    public function definition()
    {

        $end = GroupType::count();
        return [
            'name' => $this->faker->name(),
            'group_type_id' => $this->faker->numberBetween(1, GroupType::count()),
            'code' => $this->faker->numberBetween(1, $end).'00'. $this->faker->numberBetween(1,9),
            'creator_id' =>  User::inRandomOrder()->first()->id,
        ];
    }
}
