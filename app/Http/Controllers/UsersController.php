<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Traits\HasRoles;

use App\User;

class UsersController extends Controller
{

    public function index()
    {
        // get all users
        $users = User::all();
        return view('pages.users.index', compact('users'));
    }


    public function create()
    {
        // get all roles
        $roles = Role::all();
        return view('pages.users.create', compact('roles'));
    }


    public function store(Request $request)
    {
        // validate inputs
        $validator = $request->validate([
            'fullName' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'userRole' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:6', 'same:confirmPassword'],
            'confirmPassword' => ['required', 'string', 'min:6', 'same:password']
        ]);

        // insert user
        $user = User::create([

            'name' => $request['fullName'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);
        
        // find role id
        $role = Role::findById($request['userRole']);
        
        // assign user to this role
        $user->assignRole($role);
        
        return redirect()->route('users.index')
            ->with('success', 'User successfuly created!');
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        // find user with this id
        $user = User::where('id', $id)->firstOrFail();

        // get all roles
        $roles = Role::all();

        return view('pages.users.edit', compact('user', 'roles'));
    }


    public function update(Request $request, $id)
    {
        // validate inputs
        $validator = $request->validate([
            'fullName' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $id],
            'userRole' => ['required', 'string', 'max:255']
        ]);

        // update a user with this id
        $user = User::where('id', $id)
            ->update([
                'name' => $request['fullName'],
                'email' => $request['email'],
            ]);

        // find this user
        $user = User::find($id);

        // get user role
        $role = $user->getRoleNames();

        // remove role to this user
        $user->removeRole($role[0]);

        // assign new role for this user
        $assignRole = Role::find($request['userRole']);
        $user->assignRole($assignRole);

        return redirect()->route('users.index')
            ->with('success', 'User successfuly updated!');
    }


    public function destroy($id)
    {
        //
    }
}
