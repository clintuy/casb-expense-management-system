@extends('layouts.app')
@section('main-content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">User Management</li>
        <li class="breadcrumb-item"><a class="text-dark" href="/permissions">Permissions</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit Permissions</li>
    </ol>
</nav>

<div id="permission-page">
    <div class="card">
        <div class="card-header">
            <h3><b>Edit Permission</b></h3>
        </div>
        <div class="card-body">
        
            <p>Note: Filled marked with an ( <span style="color:red">*</span> ) are required</p>

            <form method="POST" action="{{ route('permissions.update', $permission->id) }}">
            @method('PATCH')
            @csrf

                <div class="row">
                    <!-- Permission Name Field -->
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="permissionName"><b>Permission Name <span style="color:red">*</b></span></label>
                            <input 
                                id="permissionName" 
                                name="permissionName" 
                                class="form-control @error('permissionName') is-invalid @enderror" 
                                type="text"   
                                value="{{ old('permissionName') ?? $permission->name }}"
                                placeholder="Enter your Permission Name"
                                autocomplete="permissionName"
                            />
                            @error('permissionName')
                                <span class="invalid-feedback pb-3" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Edit Permission Button -->
                <div class="text-right mt-3">
                    <button class="btn btn-dark" type="submit"><i class="fas fa-plus"></i> Edit Permission</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection