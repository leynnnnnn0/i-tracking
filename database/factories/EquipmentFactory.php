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
            'organization_unit' => 'R & E',  // Fixed value
            'operating_unit_project' => 'OVPRE',  // Fixed value
            'property_number' => fake()->unique()->numerify('PN#####'),
            'quantity' => fake()->numberBetween(1, 100),
            'unit' => fake()->randomElement(['pcs', 'unit', 'pack']),
            'name' => fake()->word(),
            'description' => fake()->sentence(),
            'date_acquired' => fake()->date(),
            'fund' => fake()->word(),
            'ppe_class' => fake()->word(),
            'estimated_useful_time' => fake()->numberBetween(1, 10) . ' years',
            'unit_price' => fake()->randomFloat(2, 10, 1000), // Random price between 10 and 1000
            'total_amount' => fake()->randomFloat(2, 10, 1000), // Random total amount
            'status' => 'Active',
        ];
    }
}
