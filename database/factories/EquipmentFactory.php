<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Equipment>
 */
class EquipmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'responsible_person_id' => fake()->numberBetween(1, 10),
            'uid' => fake()->uuid(),
            'name' => fake()->company(),
            'is_borrowed' => fake()->randomElement([true, false])
        ];
    }
}
