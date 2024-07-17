<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'edit program']);
        Permission::create(['name' => 'delete program']);
        Permission::create(['name' => 'publish program']);
        Permission::create(['name' => 'unpublish program']);

        $role = Role::create(['name' => 'super-admin']);
        $role->givePermissionTo(Permission::all());

        $role = Role::create(['name' => 'admin']);
        $role = Role::create(['name' => 'teacher']);
        $role = Role::create(['name' => 'parent']);

        $superadmin = \App\Models\User::find(1);
        $superadmin->assignRole('super-admin');

        $admin = \App\Models\User::find(2);
        $admin->assignRole('teacher');

        $parent = \App\Models\User::find(3);
        $parent->assignRole('parent');
    }
}
