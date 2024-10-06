<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Supply>
 */
class SupplyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'description' => fake()->word(),
            'unit' => fake()->randomElement(['pcs', 'pack']),
            'quantity' => fake()->numberBetween(1, 100),
            'used' => fake()->numberBetween(0, 50),
            'recently_added' => fake()->numberBetween(0, 50),
            'total' => fake()->numberBetween(50, 150),
            'expiry_date' => fake()->optional()->date(),
            'is_consumable' => fake()->boolean(),
        ];
    }
}
