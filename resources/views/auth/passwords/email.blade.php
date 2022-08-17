@extends('layouts.app')

@section('content')
<div class="container login-form">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card-login">
                <div class="card-body card-confirm">
                    <div class="card-body-title">Reset Password</div>
                    <form method="POST" action="{{ url('reset-password') }}">
                        @csrf
                        @method('GET')
                        <div class="mb-3">
                            <label class="mb-2" for="exampleInputEmail1" class="form-label @error('email') is-invalid @enderror">Enter your email to reset password</label>
                            <input id="email" type="input" class="form-control login-input @error('email') is-invalid @enderror" name="email"  autofocus>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                          </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary btn-login">
                                    {{ __('Reset Password') }}
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

