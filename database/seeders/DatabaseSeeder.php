<?php

namespace Database\Seeders;

use App\Models\AccountingOfficer;
use App\Models\Category;
use App\Models\Department;
use App\Models\Equipment;
use App\Models\Fund;
use App\Models\Office;
use App\Models\OperatingUnitProject;
use App\Models\OrganizationUnit;
use App\Models\PersonalProtectiveEquipment;
use App\Models\Personnel;
use App\Models\Position;
use App\Models\ResponsiblePerson;
use App\Models\SupplyCategory;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'first_name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'testtest',
            'role' => 'Admin'
        ]);

        User::factory(20)->create();
        Department::factory(5)->create();
        Position::factory(5)->create();
        Fund::factory(5)->create();
        OperatingUnitProject::factory(5)->create();
        OrganizationUnit::factory(5)->create();
        PersonalProtectiveEquipment::factory(5)->create();
        Office::factory(5)->create();
        AccountingOfficer::factory(100)->create();
        Personnel::factory(100)->create();
        // ResponsiblePerson::factory(10)->create();
        // Equipment::factory(100)
        //     ->has(BorrowedEquipment::factory()->count(rand(0, 1)), 'borrowed_log')
        //     ->create();

        Equipment::factory(100)
            ->create();

        $this->call(SupplySeeder::class);

        Category::factory(5)->create();

        for ($i = 1; $i <= 100; $i++) {
            SupplyCategory::create([
                'supply_id' => $i,
                'category_id' => random_int(1, 5)
            ]);
        }
        // BorrowedEquipment::factory(20)->create();
    }
}
