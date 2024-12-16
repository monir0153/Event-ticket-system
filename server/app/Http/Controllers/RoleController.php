<?php

namespace App\Http\Controllers;

use App\Traits\AppResponse;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{

    use AppResponse;
    public function index()
    {
        // $rol = Role::all();
        $roles = Role::with('permissions');
            return response()->json(['message' => 'All Roles', 'roles' => $roles ]);
    }

    public function allPermission(){
                  
            $permissions = Permission::all();
            return response()->json(['message' => 'All Permissions', 'permissions' => $permissions ]);
        
    }
}
