@extends('partials.guest')

@section('content')
    <div class="authentication-wrapper authentication-cover authentication-bg">
        <div class="authentication-inner row">
            <!-- /Left Text -->
            <div class="d-none d-lg-flex col-lg-7 p-0">
                <div class="auth-cover-bg auth-cover-bg-color d-flex justify-content-center align-items-center">
                    <img alt="auth-login-cover" class="img-fluid my-5 auth-illustration" style="background-image "
                        src="{{ asset('assets/images/background/auth_new.png') }}" alt="Login" />
                </div>
            </div>
            <!-- /Left Text -->

            <!-- Login -->
            <div class="d-flex col-12 col-lg-5 align-items-center p-sm-5 p-4">
                <div class="w-px-450 mx-auto">
                    <!-- /Logo -->
                    <div class="logo mr-3"><a href="{{ url('/') }}"><img src={{ asset('assets/images/app-logo.png') }} alt="icon" style="margin-bottom: 10px;" width="auto" height="35px"></a></div>
                    <h3 class="mb-1 fw-bold">Selamat Datang Di Talentern!👋</h3>
                    <p class="mb-4" style="font-size: 10pt">Silahkan login menggunakan Email/Username dan Password anda</p>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="email" class="col-md-4 col-form-label text-start text-nowrap">{{ __('Email or Username') }}</label>
                            <div class="mb-3">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="password" class="col-md-2 col-form-label text-md-end">{{ __('Password') }}</label>
                            <div class="mb-3">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="current-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3 form-password-toggl">
                            <div class="d-flex form-check justify-content-between">
                                <div class="d-flex justify-content start">
                                    <input class="form-check-input me-2" type="checkbox" id="remember-me" />
                                    <label class="form-check-label" for="remember-me">Remember Me</label>
                                </div>

                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}">
                                        <small>Forgot Password?</small>
                                    </a>
                                @endif

                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <div class="col-sm-12 mt-4">
                                <button type="submit" class="btn btn-primary d-grid w-100">
                                    {{ __('Login') }}
                                </button>
                            </div>
                        </div>
                    </form>

                    <p class="text-center">
                        <span>New on our platform?</span>
                        <a href="{{ route('register') }}">
                            <span>Create an account</span>
                        </a>
                    </p>
                </div>
            </div>
        </div>
        <!-- /Login -->
    </div>
    </div>
@endsection
