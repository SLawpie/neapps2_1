<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        $permission1 = Permission::updateOrCreate(['name' => 'view users']);
        $permission2 = Permission::updateOrCreate(['name' => 'create users']);
        $permission3 = Permission::updateOrCreate(['name' => 'edit users']);
        $permission4 = Permission::updateOrCreate(['name' => 'delete users']);

        $permission5 = Permission::updateOrCreate(['name' => 'view roles']);
        $permission6 = Permission::updateOrCreate(['name' => 'create roles']);
        $permission7 = Permission::updateOrCreate(['name' => 'edit roles']);
        $permission8 = Permission::updateOrCreate(['name' => 'delete roles']);

        $permission9 = Permission::updateOrCreate(['name' => 'view permissions']);
        $permission10 = Permission::updateOrCreate(['name' => 'create permissions']);
        $permission11 = Permission::updateOrCreate(['name' => 'edit permissions']);
        $permission12 = Permission::updateOrCreate(['name' => 'delete permissions']);

        $permission13 = Permission::updateOrCreate(['name' => 'medical-reports']);
        $permission14 = Permission::updateOrCreate(['name' => 'dedusting']); 
        $permission15 = Permission::updateOrCreate(['name' => 'visitor']);

        // create roles and assign created permissions
        $role1 = Role::updateOrCreate(['name' => 'admin']);
        $role1->syncPermissions([
          $permission1,
          $permission2,
          $permission3,
          $permission4,
          $permission5,
          $permission9,
          $permission13,
          $permission14,
          $permission15
        ]);

        $role2 = Role::updateOrCreate(['name' => 'super-admin']);

        $role3 = Role::updateOrCreate(['name' => 'medical-reports']);
        $role3->givePermissionTo($permission13);

        $role4 = Role::updateOrCreate(['name' => 'dedusting']);
        $role4->givePermissionTo($permission14);

        $role5 = Role::updateOrCreate(['name' => 'visitor']);
        $role5->syncPermissions([
          $permission15,
          $permission13,
        ]);
    }
}
