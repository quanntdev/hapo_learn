@extends('layouts.app')

@section('content')
<div class="container login-form">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card-login">
                <div class="card-body">
                    <div class="card-body-title">Sign up to HapoLearn</div>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label @error('username') is-invalid @enderror">Username</label>
                            <input  id="username" type="username" class="form-control login-input @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" autocomplete="username" autofocus>
                            @error('username')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                          </div>

                          <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label @error('email') is-invalid @enderror">Email</label>
                            <input  id="email" type="email" class="form-control login-input @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"  autocomplete="email">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                          </div>

                          <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label  @error('email') is-invalid @enderror">Password</label>
                            <input  id="password" type="password" class="form-control login-input login-inout @error('password') is-invalid @enderror" name="password"  autocomplete="new-password">
                            @error('password')
                                <span   span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                          </div>
                          <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label  @error('email') is-invalid @enderror"> ConFirm Password</label>
                            <input  id="password-confirm" type="password" class="form-control login-input" name="password_confirmation" autocomplete="new-password">
                            @error('password')
                                <span   span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                          </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary btn-login">
                                    {{ __('Sign Up') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

