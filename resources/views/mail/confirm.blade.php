@extends('layouts.app')

@section('content')
<div class="container login-form">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card-login">
                <div class="card-body card-confirm">
                    <div class="card-body-title">Verification infomation</div>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <input type="hidden" name="username" value="{{ $data['username'] }}">
                        <input type="hidden" name="email" value="{{ $data['email'] }}">
                        <input type="hidden" name="password" value="{{ $data['password'] }}">
                        <input type="hidden" name="code" value="{{ $code }}">
                        <div class="mb-3">
                            <label class="mb-2" for="exampleInputEmail1" class="form-label @error('username') is-invalid @enderror">We have sent a verification code to your email, please enter the verification code right below (6 characters)</label>
                            <input id="confirm" type="username" class="form-control login-input @error('username') is-invalid @enderror" name="confirm"  autofocus>
                          </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary btn-login">
                                    {{ __('Confirm') }}
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

