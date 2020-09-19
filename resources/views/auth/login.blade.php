@extends('layouts.app')

@section('content')
<div class="container pt-5" style="min-height:96vh">
    <div class="row justify-content-center align-items-center p-3">

            <div class="card col-md-5 p-0 rounded-0">
                <div class="card-header bg-custom-primary">
                <h4 class="text-center text-white pt-2"><b>Expense Management System</b></h3>
                </div>
                <div class="card-body p-sm-3 p-lg-5">

                    <h4 class="text-uppercase text-center pb-2"><b>Login</b></h3>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-user"></i></span>
                            </div>
                            
                            <input
                                id="email"
                                type="email"
                                class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}"
                                required autocomplete="email"
                                autofocus aria-label="{{ __('E-Mail Address') }}"
                                aria-describedby="basic-addon1"
                                placeholder="Email Address">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-lock"></i></span>
                            </div>
                        
                            <input
                                id="password"
                                type="password"
                                class="form-control @error('password') is-invalid @enderror"
                                name="password"
                                required autocomplete="current-password"
                                aria-label="Password"
                                aria-describedby="basic-addon1"
                                placeholder="Password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <button class="btn btn-dark w-100" type="submit" id="btnLogin">{{ __('Login') }}</button>
                            @if (Route::has('password.request'))
                                <div class="text-center p-2">
                                    <a id="forgot-pw"  href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                </div>
                            @endif
                        </div>
                    </form>
                </div>
            </div>

        </div>
</div>
@endsection
