<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        

        {
            $permissions = [
               'role-list',
               'role-create',
               'role-edit',
               'role-delete',
               'product-list',
               'product-create',
               'product-edit',
               'product-delete'
            ];
            
            foreach ($permissions as $permission) {
                 Permission::create(['name' => $permission]);
            }
        }
        $adminRole = Role::create(['name' => 'admin']);
         
        $permissions = Permission::pluck('id','id')->all();
       
        $adminRole->syncPermissions($permissions);

        $user = User::first();
        if ($user) {
            $user->assignRole($adminRole);
        }
    }
}
