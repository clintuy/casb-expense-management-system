@extends('layouts.app')
@section('main-content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">User Management</li>
        <li class="breadcrumb-item"><a class="text-dark" href="/users">Users</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit User</li>
    </ol>
</nav>

<div id="user-page">
    <div class="card">
        <div class="card-header">
            <h3><b>Edit User</b></h3>
        </div>
        <div class="card-body">
        
            <p>Note: Filled marked with an ( <span style="color:red">*</span> ) are required</p>

            <form method="POST" action="{{ route('users.update', $user->id) }}">
                @method('PATCH')
                @csrf
                
                <div class="row">

                    <!-- Full Name Field -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="fullName"><b>Full Name <span style="color:red">*</b></span></label>
                            <input 
                                id="fullName" 
                                name="fullName" 
                                class="form-control @error('fullName') is-invalid @enderror" 
                                type="text"   
                                value="{{ old('fullName') ?? $user->name }}"
                                placeholder="Enter your Fullname"
                                autocomplete="fullName"
                            />
                            @error('fullName')
                                <span class="invalid-feedback pb-3" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <!-- Email Address Field -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email"><b>Email Address <span style="color:red">*</span></b></label>
                            <input 
                                id="email" 
                                name="email" 
                                class="form-control @error('email') is-invalid @enderror" 
                                type="text"   
                                value="{{ old('email') ?? $user->email }}"
                                placeholder="Enter your Email Address"
                                autocomplete="email"
                            />
                            @error('email')
                                <span class="invalid-feedback pb-3" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">

                    <!-- User Role Lists -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="userRole"><b>User Role <span style="color:red">*</span></b></label>
                            <select id="userRole" name="userRole" class="form-control">
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}" {{ $user->roles->pluck('id')->implode(' ') == $role->id ? 'selected="selected"' : '' }}>{{ $role->name }}</option>
                                @endforeach
                            </select>
                            @error('userRole')
                                <span class="invalid-feedback pb-3" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Update User Button -->
                <div class="text-right">
                    <button class="btn btn-dark" type="submit"><i class="fas fa-download"></i> Update User</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection