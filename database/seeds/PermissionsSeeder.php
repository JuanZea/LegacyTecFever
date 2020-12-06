<?php

use App\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Permission list

        // Users
        Permission::create(['name' => 'display_users']);
        Permission::create(['name' => 'edit_users']);
        Permission::create(['name' => 'show_users']);
        Permission::create(['name' => 'create_users']);
        Permission::create(['name' => 'destroy_users']);

        // Products
        Permission::create(['name' => 'display_products']);
        Permission::create(['name' => 'edit_products']);
        Permission::create(['name' => 'show_products']);
        Permission::create(['name' => 'create_products']);
        Permission::create(['name' => 'destroy_products']);

        // Admin - Role
        Role::create(['name' => 'admin'])
            ->givePermissionTo([
            // Users
            'display_users',
            'edit_users',
            'show_users',
            'create_users',
            'destroy_users',

            // Products
            'display_products',
            'edit_products',
            'show_products',
            'create_products',
            'destroy_products'
        ]);

        // User - Role
        Role::create(['name' => 'user'])
            ->givePermissionTo([
            'show_products'
        ]);
    }
}
