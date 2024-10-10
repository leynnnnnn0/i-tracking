<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BorrowedEquipment>
 */
class BorrowedEquipmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $startDate = fake()->dateTimeBetween('2024-09-01', 'now');
        $endDate = fake()->dateTimeBetween($startDate, $startDate->format('Y-m-d') . ' +1 month');

        return [
            'equipment_id' => fake()->numberBetween(1, 100),
            'borrower_first_name' => fake()->firstName(),
            'borrower_last_name' => fake()->lastName(),
            'borrower_email' => fake()->safeEmail(),
            'borrower_phone_number' => fake()->phoneNumber(),
            'start_date' => $startDate,
            'end_date' => $endDate,
            'returned_date' => null
        ];
    }
}
