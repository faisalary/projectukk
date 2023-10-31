<head>
    <title>Tambah Mitra</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

</head>
<body>
    <div class="container" style="margin-top: 50px">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">{{ __('Tambah Mitra') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.register') }}">
                            @csrf
                            <div class="form-group m-2">
                                
                                <div class="md-6">
                                    <label for="name" class="col-md-4 m-2">{{ __('Name') }}</label>
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group m-2">
                                <label  for="email">{{ __('E-Mail Address') }}</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group m-2">
                                <label for="password">{{ __('Password') }}</label>
                                <input class="form-control" type="password" name="password" required>
                            </div>
                            <div class="form-group m-2">
                                <label for="password_confirmation">Konfirmasi Password:</label>
                                <input class="form-control" type="password" name="password_confirmation" required>
                            </div>
                            <div class="form-group m-2">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Tambah Mitra') }}
                                </button>
                            </div>
                        </form>
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

{{-- <body>
    <form method="POST" action="{{ route('admin.register') }}">
    @csrf
    <label for="name">Nama:</label>
    <input type="text" name="name" required>
    <label for="email">Email:</label>
    <input type="email" name="email" required>
    <label for="password">Password:</label>
    <input type="password" name="password" required>
    <label for="password_confirmation">Konfirmasi Password:</label>
    <input type="password" name="password_confirmation" required>
    <button type="submit">Daftar</button>
    </form>
</body>
</html> --}}