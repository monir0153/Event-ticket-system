<?php

namespace Database\Seeders;

use App\Models\User;
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
        $adminRole = Role::create(['name' => 'Admin']);

        $permissions =[
            ['name'=>'user list'],
            ['name'=>'create user'],
            ['name'=>'edit user'],
            ['name'=>'delete user'], 
            ['name'=>'role list'],
            ['name'=>'create role'],
            ['name'=>'edit role'],
            ['name'=>'delete role'],                 
            ['name'=>'permission list'],        
            

        ];
         
         foreach($permissions as $item){
            Permission::create($item);
        }

         
        // $permissions = Permission::all();
       
        $permissions= Permission::all();
        $adminRole->syncPermissions($permissions);
         
        $user = User::first();
        if ($user) {
            $user->assignRole($adminRole);
        }


    }
}
