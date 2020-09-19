<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\User;

class PermissionsController extends Controller
{

    public function __construct() 
    {
        $this->middleware('auth');
    }

    public function index()
    {
        abort_unless(\Gate::allows('permission_access'), 403);

        // get all permissions
        $permissions = Permission::all();

        return view('pages.permissions.index', compact('permissions'));
    }


    public function create()
    {
        abort_unless(\Gate::allows('add_permission'), 403);

        return view('pages.permissions.create');
    }


    public function store(Request $request)
    {
        abort_unless(\Gate::allows('add_permission'), 403);

        // validate inputs
        $validator = $request->validate([
            'permissionName' => ['required', 'string', 'max:255', 'unique:permissions,name']
        ]);

        // add new permission
        $permission = Permission::create([
            'name' => $request['permissionName']
        ]);

        return redirect()->route('permissions.index')
            ->with('success', 'Permission successfully created!');
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        abort_unless(\Gate::allows('edit_permission'), 403);

        // get permissions data using this id
        $permission = Permission::where('id', $id)->firstOrFail();

        return view('pages.permissions.edit', compact('permission'));
    }


    public function update(Request $request, $id)
    {
        abort_unless(\Gate::allows('edit_permission'), 403);

        // validate inputs
        $validator = $request->validate([
            'permissionName' => ['required', 'string', 'max:255', 'unique:permissions,name,' . $id]
        ]);

        // get permission using this id and update
        $permission = Permission::where('id', $id)
        ->update([
            'name' => $request['permissionName']
        ]);

        return redirect()->route('permissions.index')
            ->with('success', 'Permission successfully updated!');
    }


    public function destroy($id)
    {
        abort_unless(\Gate::allows('delete_permission'), 403);

        $permission = Permission::where('id', $id)->firstOrFail();
        $permission->delete();

        return redirect()->route('permissions.index')
            ->with('success', 'Permission data successfully deleted!');
    }
}
