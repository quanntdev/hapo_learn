@extends('layouts.app')

@section('content')
@if (session('error_change'))
    <div class="toast" role="alert" aria-live="assertive" aria-atomic="true" id="toast">
        <div class="toast-header">
            <strong class="me-auto">HapoLearn</strong>
            <small>Now</small>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close" onclick="getElementById('toast').classList.toggle('none')"></button>
        </div>
        <div class="toast-body text-danger">
            {{ session('error_change') }}
        </div>
    </div>
@endif
<div class="container login-form">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card-login">
                <div class="card-body">
                    <div class="card-body-title">Change Your Password</div>
                    <form method="POST" action="{{ route('change-password.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label  @error('email') is-invalid @enderror">Your Password now</label>
                            <input  id="password" type="password" class="form-control login-input login-inout @error('password') is-invalid @enderror" name="old_password"  autocomplete="new-password">
                            @error('password')
                                <span   span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                          </div>

                          <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label  @error('password') is-invalid @enderror"> New Password</label>
                            <input  id="password" type="password" class="form-control login-input login-inout @error('password') is-invalid @enderror" name="password"  autocomplete="new-password">
                            @error('password')
                                <span   span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                          </div>
                          <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label  @error('password_confirmation') is-invalid @enderror"> ConFirm Password</label>
                            <input  id="password-confirm" type="password" class="form-control login-input" name="password_confirmation" autocomplete="new-password">
                            @error('password_confirmation')
                                <span   span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                          </div>
                        <div class="form-group row mb-0">
                            <div class="d-flex justify-content-center">
                                <button type="submit" class="btn btn-primary btn-login" onclick="return confirm('Do you want to update?')">
                                    {{ __('Change the password') }}
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

