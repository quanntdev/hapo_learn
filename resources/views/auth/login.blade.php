@extends('layouts.app')

@section('content')
<div class="container login-form ">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="card-body-title">Sign in to HapoLearn</div>
                    <form method="POST" action="{{ route('loginhapo.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label @error('email') is-invalid @enderror">Username</label>
                            <input  id="email" type="email" class="form-control login-input @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                          </div>

                          <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input  id="password" type="password" class="form-control login-input @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                          </div>
                        

                        <div class="form-group row mb-0 mt-4">
                            <div class="d-flex justify-content-between w-100">
                                <div>
                                    <button type="submit" class="btn btn-primary btn-login">
                                        {{ __('Sign in') }}
                                    </button>
                                </div>

                                @if (Route::has('password.request'))
                                <div>
                                    <a class="btn btn-link forgotpassword  float-start" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="other-sign">
                            <p>Sign in with</p>
                            <div class="aline"></div>
                        </div>
                        <div class="GG-signin">
                            <button><i class="fa-brands fa-google-plus-g"></i> Google</button>
                        </div>
                        <div class="other-sign">
                            <p class="new-account">or New to Hapolearn</p>
                            <div class="aline"></div>
                        </div>
                        <div class="create-account">
                            <a href="{{route('login')}}">Create new Account</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
