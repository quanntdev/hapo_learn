@extends('layouts.app')

@section('content')
@if (session('success_reset'))
<div class="toast" role="alert" aria-live="assertive" aria-atomic="true" id="toast">
    <div class="toast-header">
      <strong class="me-auto">HapoLearn</strong>
      <small>Now</small>
      <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close" onclick="getElementById('toast').classList.toggle('none')"></button>
    </div>
    <div class="toast-body">
       {{ __('We have sent a new password to your email, please check your email') }}
    </div>
  </div>
@endif
<div class="container login-form ">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card card-login">
                <div class="card-body">
                    @if (session('error'))
                        <div class="alert alert-danger text-center" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif
                    <div class="card-body-title">Sign in to HapoLearn</div>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label @error('username') is-invalid @enderror text-input">Username</label>
                            <input  id="text" type="text" class="form-control login-input @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}"  autocomplete="username" autofocus>
                            @error('username')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                          </div>

                          <div class="mb-3">
                            <label for="password" class="form-label text-input">Password</label>
                            <input  id="password" type="password" class="form-control login-input @error('password') is-invalid @enderror" name="password"  autocomplete="current-password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                          </div>
                        <div class="form-group row mb-0 mt-4">
                            <div class="d-flex justify-content-between w-100 gruop-login-btn">
                                <div class="btn-signIn">
                                    <button type="submit" class="btn btn-login">
                                        {{ __('Sign in') }}
                                    </button>
                                </div>

                                @if (Route::has('password.request'))
                                <div class="btn-signIn">
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
                        <div class="Google-signin">
                            <button><i class="fa-brands fa-google-plus-g"></i> Google</button>
                        </div>
                        <div class="other-sign">
                            <p class="new-account">or New to Hapolearn</p>
                            <div class="aline"></div>
                        </div>
                        <div class="create-account">
                            <a href="{{route('register')}}">Create new Account</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
