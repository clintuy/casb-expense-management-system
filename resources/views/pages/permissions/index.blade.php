@extends('layouts.app')
@section('main-content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">User Management</li>
        <li class="breadcrumb-item active" aria-current="page">Permission</li>
    </ol>
</nav>

<div id="permission-page">

    <!-- Add Permission Button -->
    <div class="text-right mb-2">
        <a class="btn btn-dark" href="{{ route('permissions.create') }}"><i class="fas fa-plus"></i> Add Permission</a>
    </div>

    <div class="card">
        <div class="card-header">
            <h3><b>Permission Details</b></h3>
        </div>
        <div class="card-body">

            <!-- Validation if adding of user is successful -->
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif

            <div class="table-responsive">
                <table id="tablePermissions" class="table table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Permission ID</th>
                            <th>Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>

                        <!-- Permission Lists -->
                        @foreach ($permissions as $permission)
                            <tr>
                                <td>{{ $permission->id }}</td>
                                <td>{{ $permission->name }}</td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Action Group">

                                        <!-- Edit Permission Button -->
                                        @can('edit_permission')
                                            <a href="{{ route('permissions.edit', $permission->id) }}" class="btn btn-sm btn-outline-dark"><i class="fas fa-edit"></i></a>
                                        @endcan

                                        <!-- Delete Permission Button -->
                                        @can('delete_permission')
                                            <form method="POST" action="{{ route('permissions.destroy', $permission->id) }}">
                                            {{ method_field('DELETE') }}
                                            @csrf
                                                <button class="btn btn-sm btn-outline-dark" type="submit" value="Delete" onclick="return confirm('Are you sure you want to delete this permission?')"><i class="fas fa-trash-alt"></i></button> 
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
    $('#tablePermissions').DataTable();
</script>
@endsection