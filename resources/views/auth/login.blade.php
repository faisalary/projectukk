@extends('partials_auth.login')

@section('conten')

<form method="POST" action="{{ route('login') }}">
    @csrf
    <div class="form-group mb-3">
        <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email or Username') }}</label>

        <div class="mb-3">
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

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
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="mb-3 form-password-toggl">
        <div class="d-flex form-check justify-content-between">
          <input class="form-check-input" type="checkbox" id="remember-me" />
          <label class="form-check-label" for="remember-me"> Remember Me </label>
          
          @if (Route::has('password.request'))  
          <a href="{{ route('password.request') }}">
            <small>Forgot Password?</small>
          </a>
          @endif  
                
        </div>
    </div>
    
    <div class="form-group mb-3">
        <div class="col-sm-12 mt-4">
            <button type="submit" class="btn btn-primary d-grid w-100" style="background: var(--primary-500-base, #4EA971);">
                {{ __('Login') }}
            </button>

            
        </div>
    </div>
</form>
           
@endsection
