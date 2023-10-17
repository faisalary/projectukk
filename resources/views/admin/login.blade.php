<!DOCTYPE html>
<html>
<head>
    <title>Login Admin</title>
</head>
<body>
    <h1>Login Admin</h1>
    <form method="POST" action="{{ route('admin.login') }}">
        @csrf
        <div class=row>
        <label for="name">Name:</label>
        <input type="name" name="name" required>
        <label for="email">Email:</label>
        <input type="email" name="email" required>
        <label for="password">Password:</label>
        <input type="password" name="password" required>
        <button type="submit">Login</button>
        </div>
    </form>
    {{-- <p>Belum punya akun admin? <a href="{{ route('admin.register') }}">Register</a></p> --}}

    {{-- <form method="POST" action="{{ route('admin.login') }}">
        @csrf
        <div class="form-group mb-3">
            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>
    
            <div class="col">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
    
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
    
        <div class="form-group mb-3">
            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>
    
            </div>
        </div>
    
        <div class="form-group mb-3 ">
            <div class="row">
                <div class="col">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
    
                        <label class="form-check-label" for="remember">
                            {{ __('Remember Me') }}
                        </label>
                    </div>
                </div>
            </div>
        </div>
    
        <div class="form-group mb-3">
            <div class="col-sm-12 mt-4">
                <button type="submit" class="btn btn-primary btn-block">
                    {{ __('Login') }}
                </button>
    
                
            </div>
        </div>       <div class="col">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
    
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            <p>Belum punya akun admin? <a href="{{ route('admin.register') }}">Register</a></p> --}}
    </form>
</body>
</html>
