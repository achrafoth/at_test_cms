<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $clientPermissions = [
            'client.access',
            'client.view',
            'client.create',
            'client.edit',
            'client.delete'
        ];

        $trustedSpecialistPermissions = [
            'trusted-specialist.access',
            'trusted-specialist.view',
            'trusted-specialist.create',
            'trusted-specialist.edit',
            'trusted-specialist.delete'
        ];

        $atExpertPermissions = [
            'at-expert.access',
            'at-expert.view',
            'at-expert.create',
            'at-expert.edit',
            'at-expert.delete'
        ];

        $atEquipmentPermissions = [
            'at-equipment.access',
            'at-equipment.view',
            'at-equipment.create',
            'at-equipment.edit',
            'at-equipment.delete'
        ];

        $atCategoryPermissions = [
            'at-category.access',
            'at-category.view',
            'at-category.create',
            'at-category.edit',
            'at-category.delete'
        ];

        $supplierPermissions = [
            'supplier.access',
            'supplier.view',
            'supplier.create',
            'supplier.edit',
            'supplier.delete'
        ];

        $provisionLoanPermissions = [
            'provision-loan.access',
            'provision-loan.view',
            'provision-loan.create',
            'provision-loan.edit',
            'provision-loan.delete'
        ];

        $systemPermissions = [
            'system.access',
            'system.settings',
            'system.reports'
        ];

        $allPermissions = array_merge(
            $clientPermissions,
            $trustedSpecialistPermissions,
            $atExpertPermissions,
            $atEquipmentPermissions,
            $atCategoryPermissions,
            $supplierPermissions,
            $provisionLoanPermissions,
            $systemPermissions
        );

        foreach ($allPermissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        
        $adminRole = Role::create(['name' => 'Admin']);
        $adminRole->givePermissionTo(Permission::all());

        $managerRole = Role::create(['name' => 'Manager']);
        $managerRole->givePermissionTo([
            'client.access', 'client.view', 'client.create', 'client.edit',
            'trusted-specialist.access', 'trusted-specialist.view', 'trusted-specialist.create', 'trusted-specialist.edit',
            'at-expert.access', 'at-expert.view', 'at-expert.create', 'at-expert.edit',
            'system.access', 'system.reports',
            'at-equipment.access', 'at-equipment.view',
            'at-category.access', 'at-category.view',
            'supplier.access', 'supplier.view',
            'provision-loan.access', 'provision-loan.view'
        ]);

        $trustedSpecialistRole = Role::create(['name' => 'Trusted Specialist']);
        $trustedSpecialistRole->givePermissionTo([
            'client.access', 'client.view', 'client.edit',
            'at-equipment.access', 'at-equipment.view',
            'provision-loan.access', 'provision-loan.view', 'provision-loan.create'
        ]);

        $atExpertRole = Role::create(['name' => 'AT Expert']);
        $atExpertRole->givePermissionTo([
            'client.access', 'client.view',
            'at-equipment.access', 'at-equipment.view', 'at-equipment.create', 'at-equipment.edit',
            'at-category.access', 'at-category.view',
            'provision-loan.access', 'provision-loan.view', 'provision-loan.create'
        ]);

        $inventoryManagerRole = Role::create(['name' => 'Inventory Manager']);
        $inventoryManagerRole->givePermissionTo([
            'at-equipment.access', 'at-equipment.view', 'at-equipment.create', 'at-equipment.edit', 'at-equipment.delete',
            'at-category.access', 'at-category.view', 'at-category.create', 'at-category.edit', 'at-category.delete',
            'supplier.access', 'supplier.view', 'supplier.create', 'supplier.edit', 'supplier.delete',
            'provision-loan.access', 'provision-loan.view'
        ]);

        $caseworkerRole = Role::create(['name' => 'Caseworker']);
        $caseworkerRole->givePermissionTo([
            'client.access', 'client.view', 'client.create', 'client.edit',
            'provision-loan.access', 'provision-loan.view', 'provision-loan.create'
        ]);
    }
}
