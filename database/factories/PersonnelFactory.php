<?php

namespace Database\Factories;

use App\Enum\Position;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Personnel>
 */
class PersonnelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'department_id' => fake()->numberBetween(1, 5),
            'first_name' => fake()->firstName(),
            'middle_name' => fake()->optional()->firstName(),
            'last_name' => fake()->lastName(),
            'gender' => fake()->randomElement(['Male', 'Female']),
            'date_of_birth' => fake()->date(),
            'phone_number' => fake()->phoneNumber(),
            'email' => fake()->unique()->safeEmail(),
            'position' => fake()->randomElement(Position::values()),
            'start_date' => fake()->date(),
            'end_date' => fake()->optional()->date(),
            'remarks' => fake()->optional()->sentence(),
        ];
    }
}