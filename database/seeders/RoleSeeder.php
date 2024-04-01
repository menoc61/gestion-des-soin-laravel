<?php

namespace Database\Seeders;

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RoleSeeder extends Seeder
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
        Permission::create(['name' => 'add patient']);
        Permission::create(['name' => 'view patient']);
        Permission::create(['name' => 'edit patient']);
        Permission::create(['name' => 'view all patients']);
        Permission::create(['name' => 'delete patient']);

        Permission::create(['name' => 'create health history']);
        Permission::create(['name' => 'delete health history']);

        Permission::create(['name' => 'add medical files']);
        Permission::create(['name' => 'delete medical files']);

        Permission::create(['name' => 'create appointment']);
        Permission::create(['name' => 'view all appointments']);
        Permission::create(['name' => 'delete appointment']);
        Permission::create(['name' => 'edit appointment']);

        Permission::create(['name' => 'create prescription']);
        Permission::create(['name' => 'view prescription']);
        Permission::create(['name' => 'view all prescriptions']);
        Permission::create(['name' => 'edit prescription']);
        Permission::create(['name' => 'delete prescription']);
        Permission::create(['name' => 'print prescription']);

        Permission::create(['name' => 'create drug']);
        Permission::create(['name' => 'edit drug']);
        Permission::create(['name' => 'view drug']);
        Permission::create(['name' => 'delete drug']);
        Permission::create(['name' => 'view all drugs']);

        Permission::create(['name' => 'create diagnostic test']);
        Permission::create(['name' => 'edit diagnostic test']);
        Permission::create(['name' => 'view all diagnostic tests']);
        Permission::create(['name' => 'delete diagnostic test']);

        Permission::create(['name' => 'create invoice']);
        Permission::create(['name' => 'edit invoice']);
        Permission::create(['name' => 'view invoice']);
        Permission::create(['name' => 'view all invoices']);
        Permission::create(['name' => 'delete invoice']);
        Permission::create(['name' => 'print invoice']);

        Permission::create(['name' => 'manage settings']);
        Permission::create(['name' => 'manage roles']);

        $role1 = Role::create(['name' => 'Admin']);
        $role2 = Role::create(['name' => 'Praticien']);
        $role3 = Role::create(['name' => 'Hôte']);

        $role1->givePermissionTo(Permission::all());
        $role2->givePermissionTo(Permission::all()->except(['delete invoice', 'manage settings', 'manage roles']));
        $role3->syncPermissions('view patient');

        $user = User::create([
            'name' => 'ADMIN',
            'email' => 'admin@admin',
            'password' => Hash::make('admin'),
            'role_id' => '1',
        ]);
        $user2 = User::create([
            'name' => 'PRATICIENT',
            'email' => 'doc@admin',
            'password' => Hash::make('admin'),
            'role_id' => '2',
        ]);

        $user->assignRole($role1);
        $user2->assignRole($role2);
    }
}
