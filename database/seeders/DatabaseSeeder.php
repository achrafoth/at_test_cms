<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RolesAndPermissionsSeeder::class,
            AdminUserSeeder::class,
            ClientSeeder::class,
            TrustedSpecialistSeeder::class,
            ATExpertSeeder::class,
            ATCategorySeeder::class,
            SupplierSeeder::class,
            ATEquipmentSeeder::class,
            ATSoftwareSeeder::class,
            // ProvisionSeeder::class,
            // LoanSeeder::class,
            // SessionSeeder::class,
        ]);
    }
}
