<?php

namespace App\Http\Controllers;

use App\Models\User as ModelsUser;
use App\Models\Task as TaskModel;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $users = ModelsUser::all();
         $roles = Role::all();
        return view('users', compact('users', 'roles'));
    }
    

    public function updateRole(Request $request, $id)
    {

        $user = ModelsUser::findOrFail($id);

        //(User Rights)reset role and updates role 
        $user->syncRoles($request->role);

        return back()->with('success', 'Role updated.');
    }

  
     public function groupRights()
    {
// dd(Role::findByName('admin')->getPermissionNames());
    
         $permissions = Permission::all();
         $roles = Role::all();
        return view('group_rights', compact('permissions', 'roles'));
    }

    public function updateGroupRights(Request $request, $role)
{
    
    $role = Role::findByName($role);

    // (Group Rights)sync the permission of roles
    $role->syncPermissions($request->permissions ?? []);

    return back()->with('success', 'Group rights updated successfully.');
}
}
