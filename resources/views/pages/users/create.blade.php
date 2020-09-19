@extends('layouts.app')
@section('main-content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">User Management</li>
        <li class="breadcrumb-item"><a class="text-dark" href="/users">Users</a></li>
        <li class="breadcrumb-item active" aria-current="page">Create User</li>
    </ol>
</nav>

<div id="user-page">
    <div class="card">
        <div class="card-header">
            <h3><b>Create User</b></h3>
        </div>
        <div class="card-body">
        
            <p>Note: Filled marked with an ( <span style="color:red">*</span> ) are required</p>

            <form method="POST" action="{{ route('users.store') }}">
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
                                value="{{ old('fullName') }}"
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
                                value="{{ old('email') }}"
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
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                            @error('userRole')
                                <span class="invalid-feedback pb-3" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <!-- Password Field -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="password"><b>Password <span style="color:red">*</span></b></label>
                            <input 
                                id="password" 
                                name="password" 
                                class="form-control @error('password') is-invalid @enderror" 
                                type="password"   
                                placeholder="Enter your Password"
                                autocomplete="password"
                            />
                            @error('password')
                                <span class="invalid-feedback pb-3" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <!-- Confirm Password Field -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="confirmPassword"><b>Confirm Password <span style="color:red">*</span></b></label>
                            <input 
                                id="confirmPassword" 
                                name="confirmPassword" 
                                class="form-control @error('confirmPassword') is-invalid @enderror" 
                                type="password"   
                                placeholder="Enter your Confirm Password"
                                autocomplete="confirmPassword"
                            />
                            @error('confirmPassword')
                                <span class="invalid-feedback pb-3" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Save User Button -->
                <div class="text-right">
                    <button class="btn btn-dark" type="submit"><i class="fas fa-download"></i> Save User</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection