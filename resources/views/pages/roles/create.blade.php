@extends('layouts.app')
@section('main-content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">User Management</li>
        <li class="breadcrumb-item"><a class="text-dark" href="/roles">Roles</a></li>
        <li class="breadcrumb-item active" aria-current="page">Create Role</li>
    </ol>
</nav>

<div id="role-page">
    <div class="card">
        <div class="card-header">
            <h3><b>Create Role</b></h3>
        </div>
        <div class="card-body">
        
            <p>Note: Filled marked with an ( <span style="color:red">*</span> ) are required</p>

            <form method="POST" action="{{ route('roles.store') }}">
            @csrf

                <div class="row">

                    <!-- Role Name Field -->
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="roleName"><b>Role Name <span style="color:red">*</b></span></label>
                            <input 
                                id="roleName" 
                                name="roleName" 
                                class="form-control @error('roleName') is-invalid @enderror" 
                                type="text"   
                                value="{{ old('roleName') }}"
                                placeholder="Enter your Role name"
                                autocomplete="roleName"
                            />
                            @error('roleName')
                                <span class="invalid-feedback pb-3" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Permission Lists -->
                <div class="card">
                    <div class="card-body">
                        @foreach($permissions as $permission)
                            <div class="form-check">
                                <input 
                                    name="permission[]" 
                                    class="form-check-input @error('permission') is-invalid @enderror" 
                                    type="checkbox" 
                                    value="{{ $permission->name }}"
                                />
                                <label class="form-check-label">{{ $permission->name }}</label>
                            </div>
                        @endforeach
                    </div>
                    @error('permission')
                        <span style="color:#e3342f; padding:5px">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <!-- Save Role Button -->
                <div class="text-right mt-3">
                    <button class="btn btn-dark" type="submit"><i class="fas fa-download"></i> Save Role</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection