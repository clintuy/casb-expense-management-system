@extends('layouts.app')
@section('main-content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">User Management</li>
        <li class="breadcrumb-item active" aria-current="page">Users</li>
    </ol>
</nav>

<div id="user-page">
    <div class="text-right mb-2">

        <!-- Add User Button -->
        @can('add_user')
            <a class="btn btn-dark" href="{{ route('users.create') }}"><i class="fas fa-plus"></i> Add User</a>
        @endcan
    </div>

    <div class="card">
        <div class="card-header">
            <h3><b>User Details</b></h3>
        </div>
        <div class="card-body">

            <!-- Validation if adding of user is successful -->
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif

            <div class="table-responsive">
                <table id="tableUsers" class="table table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>User ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>

                        <!-- Users Info List -->
                        @forelse ($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->roles->pluck('name')->implode(' ') }}</td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Action Group">

                                        <!-- Edit User Button -->
                                        @can('edit_user')
                                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-outline-dark"><i class="fas fa-user-edit"></i></a>
                                        @endcan

                                        <!-- Delete User Button -->
                                        @can('delete_user')
                                            <a href="/user/edit/{{ $user->id }}" class="btn btn-sm btn-outline-dark"><i class="fas fa-trash-alt"></i></a>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6">
                                    <h1>No user found.</h1>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    $('#tableUsers').DataTable();
</script>
@endsection