<?php

namespace Database\Factories;

use Carbon\Carbon;
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
        $dateAcquired = fake()->date();
        $estimatedUsefulYears = fake()->numberBetween(1, 10);

        return [
            'responsible_person_id' => fake()->numberBetween(1, 10),
            'organization_unit' => 'R & E', 
            'operating_unit_project' => 'OVPRE',  
            'property_number' => fake()->unique()->numerify('PN#####'),
            'quantity' => fake()->numberBetween(1, 100),
            'quantity_borrowed' => 0,
            'unit' => fake()->randomElement(['pcs', 'unit', 'pack']),
            'name' => fake()->word(),
            'description' => fake()->sentence(),
            'date_acquired' => $dateAcquired,
            'fund' => fake()->word(),
            'ppe_class' => fake()->word(),
            'estimated_useful_time' => $this->calculateEstimatedUsefulTime($dateAcquired, $estimatedUsefulYears),
            'unit_price' => fake()->randomFloat(2, 10, 1000), 
            'total_amount' => fake()->randomFloat(2, 10, 1000), 
            'status' => 'active',
        ];
    }

    private function calculateEstimatedUsefulTime($dateAcquired, $years): string
    {
        $acquiredDate = Carbon::parse($dateAcquired);
        $estimatedEndDate = $acquiredDate->copy()->addYears($years);

        if ($estimatedEndDate->year == $acquiredDate->year) {
            $estimatedEndDate->addYear();
        }

        return $estimatedEndDate->format('Y-m');
    }
}
