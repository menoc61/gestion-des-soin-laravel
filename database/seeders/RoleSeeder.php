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

        
        // $permissions = [
        //     'add patient', 'view patient', 'edit patient', 'view all patients', 'delete patient',
        //     'create health history', 'delete health history',
        //     'add medical files', 'delete medical files',
        //     'create appointment', 'view all appointments', 'delete appointment', 'edit appointment',
        //     'create prescription', 'view prescription', 'view all prescriptions', 'edit prescription',
        //     'delete prescription', 'print prescription',
        //     'create drug', 'edit drug', 'view drug', 'delete drug', 'view all drugs',
        //     'create diagnostic test','edit diagnostic test', 'view all diagnostic tests', 'delete diagnostic test', 
        //     'create invoice', 'edit invoice', 'view invoice', 'view all invoices', 'delete invoice', 'print invoice', 
        //     'manage settings', 'manage roles', 
        //     'view all notifications', 'create notification', 'edit notification', 'delete notification', 'edit expense', 'delete expense',
        //     'manage waiting room'
    
        // ];
    
        // foreach ($permissions as $permissionName) {
        //     $permission = Permission::where('name', $permissionName)->first();
    
        //     // Supprimer la permission si elle existe
        //     if ($permission) {
        //         $permission->delete();
        //     }
    
        //     // Recréer la permission
        //     Permission::firstOrCreate(['name' => $permissionName, 'guard_name' => 'web']);
        // }
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

        Permission::updateOrcreate(['name' => 'view all notifications']);
        Permission::updateOrcreate(['name' => 'create notification']);
        Permission::updateOrcreate(['name' => 'edit notification']);
        Permission::updateOrcreate(['name' => 'delete notification']);
        Permission::updateOrcreate(['name' => 'edit expense']);
        Permission::updateOrcreate(['name' => 'delete expense']);

        Permission::updateOrCreate(['name' => 'manage waiting room']);

        $role1 = Role::create(['name' => 'Admin']);
        $role2 = Role::create(['name' => 'Praticien']);
        $role3 = Role::create(['name' => 'Hôte']);

        $role1->givePermissionTo(Permission::all());
        $role2->givePermissionTo(Permission::all()->except(['delete patient', 'delete health history', 'delete medical files', 'delete appointment', 'delete prescription', 'delete drug', 'delete diagnostic test', 'delete invoice', 'manage settings', 'manage roles']));
        $role3->syncPermissions(
            'view patient',
            'edit patient',
            'create appointment',
            'create diagnostic test',
            'view invoice',
            'print prescription',
            'print invoice',
            'add medical files',
            'view all invoices',
            'view all prescriptions',
            'view all diagnostic tests',
            'view all appointments',
            'view prescription',
            'create health history'
        );
        // $roles = [
        //     [
        //         'name' => 'Admin',
        //         'permissions' => ['add patient', 'view patient', 'edit patient', 'view all patients', 'delete patient', 'create health history', 'delete health history', 'add medical files', 'delete medical files', 'create appointment', 'view all appointments', 'delete appointment', 'edit appointment', 'create prescription', 'view prescription', 'view all prescriptions', 'edit prescription', 'delete prescription', 'print prescription', 'create drug', 'edit drug', 'view drug', 'delete drug', 'view all drugs']
        //     ],
        //     [
        //         'name' => 'Praticien',
        //         'except' => ['delete patient', 'delete health history', 'delete medical files', 'delete appointment', 'delete prescription', 'delete drug']
        //     ],
        //     [
        //         'name' => 'Hôte',
        //         'permissions' => ['view patient', 'edit patient', 'create appointment', 'create diagnostic test', 'view invoice', 'print prescription', 'print invoice', 'add medical files', 'view all invoices', 'view all prescriptions', 'view all diagnostic tests', 'view all appointments', 'view prescription', 'create health history']
        //     ]
        // ];
    
        // foreach ($roles as $roleData) {
        //     $role = Role::create(['name' => $roleData['name']]);
            
        //     if (isset($roleData['permissions'])) {
        //         $permissions = Permission::whereIn('name', $roleData['permissions'])->get();
        //         $role->givePermissionTo($permissions);
        //     } elseif (isset($roleData['except'])) {
        //         $permissions = Permission::whereNotIn('name', $roleData['except'])->get();
        //         $role->givePermissionTo($permissions);
        //     }
        // }
        $user = User::create([
            'name' => 'ADMIN',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin'),
            'role_id' => 1,
            'address' => 'Yaoundé',
            'phone' => '694437466',
            'gender' => 'Homme'
        ]);
        $user2 = User::create([
            'name' => 'PRATICIENT',
            'email' => 'doc@gmail.com',
            'password' => Hash::make('admin'),
            'role_id' => 2,
            'address' => 'Yaoundé',
            'phone' => '694437479',
            'gender' => 'Homme'
        ]);

        $user->assignRole($role1);
        $user2->assignRole($role2);
        
        
    }
}
