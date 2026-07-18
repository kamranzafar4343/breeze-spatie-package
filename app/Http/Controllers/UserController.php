<?php

namespace App\Http\Controllers;

use App\Models\User as ModelsUser;
use App\Models\Task as TaskModel;

use Spatie\Permission\Models\Role;

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
    
    public function user_rights()
    {
         $users = ModelsUser::all();
         $roles = Role::all();
        return view('user_rights', compact('users', 'roles'));
    }

    public function updateRole(Request $request, $id)
    {

        // dd($request->role);

        // $user->syncRoles($request->role);

        $user = ModelsUser::findOrFail($id);

        //reset role and updates role 
        $user->syncRoles($request->role);
        
        // dd($user->fresh()->getRoleNames());

        return back()->with('success', 'Role updated.');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
