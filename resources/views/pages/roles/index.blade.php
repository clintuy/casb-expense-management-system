@extends('layouts.app')
@section('main-content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">User Management</li>
        <li class="breadcrumb-item active" aria-current="page">Roles</li>
    </ol>
</nav>

<div id="role-page">
    <!-- Add User Button -->
    <div class="text-right mb-2">
        <a class="btn btn-dark" href="{{ route('roles.create') }}"><i class="fas fa-plus"></i> Add Roles</a>
    </div>

    <div class="card">
        <div class="card-header">
            <h3><b>Role Details</b></h3>
        </div>
        <div class="card-body">

            <!-- Validation if adding of role is successful -->
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif

            <div class="table-responsive">
                <table id="tableRoles" class="table table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Role ID</th>
                            <th>Name</th>
                            <th>Permission(s)</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>

                        <!-- Role Info Lists -->
                        @foreach ($roles as $role)
                            <tr>
                                <td>{{ $role->id }}</td>
                                <td>{{ $role->name }}</td>
                                <td>
                                    @forelse($role->permissions->pluck('name') as $permission)
                                        <span class="badge badge-dark my-2 p-2">{{ $permission }}</span>
                                    @empty
                                        <span class="badge badge-dark my-2 p-2">No Permission(s) yet.</span>
                                    @endforelse
                                </td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Action Group">

                                        <!-- Edit Role Button -->
                                        @can('edit_role')
                                        <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-sm btn-outline-dark"><i class="fas fa-edit"></i></a>
                                        @endcan

                                        <!-- Delete Role Button -->
                                        @can('delete_role')
                                            <form method="POST" action="{{ route('roles.destroy', $role->id) }}">
                                            {{ method_field('DELETE') }}
                                            @csrf
                                                <button class="btn btn-sm btn-outline-dark" type="submit" value="Delete" onclick="return confirm('Are you sure you want to delete this role?')"><i class="fas fa-trash-alt"></i></button> 
                                            </form>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    $('#tableRoles').DataTable();
</script>
@endsection