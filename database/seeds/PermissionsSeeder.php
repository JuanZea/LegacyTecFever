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
        Permission::create(['name' => 'viewAny_users']);
        Permission::create(['name' => 'edit_users']);
        Permission::create(['name' => 'update_users']);
        Permission::create(['name' => 'view_users']);
        Permission::create(['name' => 'create_users']);
        Permission::create(['name' => 'store_users']);
        Permission::create(['name' => 'destroy_users']);

        // Products
        Permission::create(['name' => 'viewAny_products']);
        Permission::create(['name' => 'edit_products']);
        Permission::create(['name' => 'update_products']);
        Permission::create(['name' => 'view_products']);
        Permission::create(['name' => 'create_products']);
        Permission::create(['name' => 'store_products']);
        Permission::create(['name' => 'destroy_products']);

        // Admin - Role
        Role::create(['name' => 'admin'])
            ->givePermissionTo([
            // Users
            'viewAny_users',
            'edit_users',
            'update_users',
            'view_users',
            'create_users',
            'store_users',
            'destroy_users',

            // Products
            'viewAny_products',
            'edit_products',
            'update_products',
            'view_products',
            'create_products',
            'store_products',
            'destroy_products'
        ]);

        // User - Role
        Role::create(['name' => 'user'])
            ->givePermissionTo([
            'view_products'
        ]);
    }
}
