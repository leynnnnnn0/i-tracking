<?php

namespace Database\Seeders;

use App\Models\AccountingOfficer;
use App\Models\Equipment;
use App\Models\Office;
use App\Models\ResponsiblePerson;
use App\Models\Supply;
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
            'password' => 'testtest'
        ]);

        User::factory(10)->create();
        Office::factory(10)->create();
        AccountingOfficer::factory(10)->create();
        ResponsiblePerson::factory(10)->create();
        Equipment::factory(10)->create();
        Supply::factory(10)->create();
    }
}
