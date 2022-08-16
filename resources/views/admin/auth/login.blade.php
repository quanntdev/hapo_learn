<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="{{asset('css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/owl.theme.default.min.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="img js-fullheight" style="background-image: url(images/bg.jpg);">
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
	<section class="ftco-section mt-5">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 text-center mb-5">
					<h2 class="heading-section">Hapo Learn Admin</h2>
				</div>
			</div>
            @if (session('error'))
                        <div class="alert alert-danger text-center" role="alert">
                            {{ session('error') }}
                        </div>
            @endif
			<div class="row justify-content-center">
				<div class="col-md-6 col-lg-4">
					<div class="login-wrap p-0">
		      	<form method="POST" action="{{ route('login') }}" class="signin-form">
                    @csrf
		      		<div class="form-group">
                        <label for="exampleInputEmail1" class="form-label @error('username') is-invalid @enderror text-input">Username</label>
                        <input  id="text" type="text" class="form-control login-input @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}"  autocomplete="username" autofocus>
                        @error('username')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
		      		</div>
	            <div class="form-group mt-3">
                    <label for="password" class="form-label text-input">Password</label>
                    <input  id="password" type="password" class="form-control login-input @error('password') is-invalid @enderror" name="password"  autocomplete="current-password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
	            </div>
	            <div class="form-group mt-5">
	            	<button type="submit" class="form-control btn btn-primary submit px-3">Sign In</button>
	            </div>
	          </form>
	          </div>
		      </div>
				</div>
			</div>
	</section>
</body>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</html>
