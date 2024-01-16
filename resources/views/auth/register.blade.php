@extends('partials_auth.register')

@section('conten')

<form method="POST" action="{{ url('/mahasiswa/register') }}">
    @csrf
    <div class="row">
        <div class="col mb-2 form-input">
            <label for="roleregister" class="form-label">Role Registrasi</label>
            <select class="form-select select2" id="roleregister" name="roleregister"
                    data-placeholder="Pilih Role Anda Terlebih Dahulu" onchange="redirectToPage()">
                <option disabled selected>Pilih Role Anda Terlebih Dahulu</option>
                <option value="user">Mahasiswa</option>
                <option value="mitra">Mitra</option>
            </select>
        </div>
    </div>
    <div class="form-group">
        <div class="col">
            <label for="nim" class="col-form-label text-md-end">{{ __('NIM') }}</label>
            <div class="md-6">
                <input id="nim" type="nim" class="form-control @error('nim') is-invalid @enderror" name="nim" value="{{ old('nim') }}" required autocomplete="nim" placeholder="Masukkan NIM" autofocus>
                @error('nim')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
    </div>

    {{-- form-control --}}
    {{-- <div class="form-group">
        <div class="col">
            <label for="password" class="col-form-label text-md-end">{{ __('Password') }}</label>

            <div class="md-6 input-group input-group-merge">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Enter your Password" autofocus>
                <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
    </div> --}}

    {{-- form-control --}}
    {{-- <div class="form-group">
        <div class="col">
        <label for="password-confirm" class="col-form-label text-md-end">{{ __('Confirm Password') }}</label>

        <div class="md-6 input-group input-group-merge">
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm Password" autofocus/>
            <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
        </div>
        </div>
    </div> --}}

    
    <div class="form-group mt-3">
        <div class="col-sm-12 mt-4">
        <button type="submit" class="btn btn-primary d-grid w-100" style="background: var(--primary-500-base, #4EA971);"  name="register">Buat Akun</button>
        </div>
    </div>
</form>

@endsection
