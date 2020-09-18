<?php

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\Hash;

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

use App\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions for users module-------------------------------------------//
        Permission::create(['name' => 'user_management_access']);
        Permission::create(['name' => 'user_access']);
        Permission::create(['name' => 'add_user']);
        Permission::create(['name' => 'edit_user']);
        Permission::create(['name' => 'delete_user']);
        Permission::create(['name' => 'role_access']);
        Permission::create(['name' => 'add_role']);
        Permission::create(['name' => 'edit_role']);
        Permission::create(['name' => 'delete_role']);
        Permission::create(['name' => 'permission_access']);
        Permission::create(['name' => 'add_permission']);
        Permission::create(['name' => 'edit_permission']);
        Permission::create(['name' => 'delete_permission']);
        Permission::create(['name' => 'expense_management_access']);
        Permission::create(['name' => 'expense_category_access']);
        Permission::create(['name' => 'add_expense_category']);
        Permission::create(['name' => 'edit_expense_category']);
        Permission::create(['name' => 'delete_expense_category']);
        Permission::create(['name' => 'expense_access']);
        Permission::create(['name' => 'add_expense']);
        Permission::create(['name' => 'edit_expense']);
        Permission::create(['name' => 'delete_expense']);

        // create role and assign existing permissions-------------------------------------------//
        $role1 = Role::create(['name' => 'Admin']);

        $role1->givePermissionTo('user_management_access');
        $role1->givePermissionTo('user_access');
        $role1->givePermissionTo('add_user');
        $role1->givePermissionTo('edit_user');
        $role1->givePermissionTo('delete_user');
        $role1->givePermissionTo('role_access');
        $role1->givePermissionTo('add_role');
        $role1->givePermissionTo('edit_role');
        $role1->givePermissionTo('delete_role');
        $role1->givePermissionTo('permission_access');
        $role1->givePermissionTo('add_permission');
        $role1->givePermissionTo('edit_permission');
        $role1->givePermissionTo('delete_permission');
        $role1->givePermissionTo('expense_management_access');
        $role1->givePermissionTo('expense_category_access');
        $role1->givePermissionTo('add_expense_category');
        $role1->givePermissionTo('edit_expense_category');
        $role1->givePermissionTo('delete_expense_category');
        $role1->givePermissionTo('expense_access');
        $role1->givePermissionTo('add_expense');
        $role1->givePermissionTo('edit_expense');
        $role1->givePermissionTo('delete_expense');

        // create user and assign the role admin-------------------------------------------//
        $user = User::create([
            'name' => 'Admin',
            'email' => 'admin@purple.test',
            'password' => Hash::make('123123')
        ]);
        $user->assignRole($role1);
    }
}
