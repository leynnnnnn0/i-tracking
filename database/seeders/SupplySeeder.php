<?php

namespace Database\Seeders;

use App\Models\Supply;
use App\Models\SupplyCategory;
use Illuminate\Database\Seeder;

class SupplySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Supply::factory(10)->create()->each(function ($supply) {
            SupplyCategory::factory()->create([
                'supply_id' => $supply->id, 
            ]);
        });
    }
}
