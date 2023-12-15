@extends('partials_auth.register')

@section('conten')

<form method="POST" action="{{ route('register') }}">
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
      <div class="row">
        <div class="col mb-2 form-input">
            <label for="universitas" class="form-label">Universitas</label>
            <select class="form-select select2" id="universitas" name="universitas"
                data-placeholder="Pilih Universitas">
                <option disabled selected>Pilih Universitas</option>
                <option>Telkom University</option>
                <option>BINUS</option>
                <option>UNICOM</option>         
                <option>UPI</option>         
                <option>UNJANI</option>         
            </select>
        </div>
      </div>
      <div class="row">
        <div class="col mb-2 form-input">
            <label for="fakultas" class="form-label">Fakultas</label>
            <select class="form-select select2" id="fakultas" name="fakultas"
                data-placeholder="Pilih Fakultas">
                <option disabled selected>Pilih Fakultas</option>
                <option>FIK</option>
                <option>FIT</option>
                <option>FIF</option>
                <option>FTE</option>
                <option>FEB</option>
                <option>FRI</option>
                <option>FKB</option>
            </select>
        </div>
      </div>
      <div class="row">
        <div class="col mb-2 form-input">
            <label for="prodi" class="form-label">Prodi</label>
            <select class="form-select select2" id="prodi" name="prodi" data-placeholder="Pilih Program Prodi">
              <option disabled selected>Pilih Program Prodi</option>
              <option>D3 Rekayasa Perangkat Lunak Aplikasi</option>
              <option>D3 Sistem Informasi</option>
              <option>D3 Perhotelan</option>
              <option>D4 Teknik Rekayasa Multimedia</option>
            </select>
        </div>
      </div>    
    {{-- form-control --}}
    <div class="form-group">
        <div class="row">
            <div class="col">
                <label for="fullname" class=" col-form-label text-md-end">{{ __('Fullname') }}</label>
                <div class="md-6">
                    <input id="fullname" type="text" class="form-control @error('fullname') is-invalid @enderror" name="fullname" value="{{ old('fullname') }}" required autocomplete="fullname" placeholder="Enter your Name" autofocus>

                    @error('fullname')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            
            {{-- form-control --}}
            <div class="col">
                <label for="username" class="col-form-label text-md-end">{{ __('Username') }}</label>
                <div class="md-6">
                    <input id="username" type="text" class="form-control @error('usermane') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" placeholder="Enter your Username" autofocus>

                    @error('username')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
        </div>
    </div>

    {{-- form-control --}}
    <div class="form-group">
        <div class="col">
            <label for="email" class="col-form-label text-md-end">{{ __('Email Address') }}</label>

            <div class="md-6">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Enter your Email" autofocus>

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
    </div>

    {{-- form-control --}}
    <div class="form-group">
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
    </div>

    {{-- form-control --}}
    <div class="form-group">
        <div class="col">
        <label for="password-confirm" class="col-form-label text-md-end">{{ __('Confirm Password') }}</label>

        <div class="md-6 input-group input-group-merge">
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm Password" autofocus/>
            <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
        </div>
        </div>
    </div>

    
    <div class="form-group mt-3">
        <div class="col-sm-12 mt-4">
        <button type="submit" class="btn btn-primary d-grid w-100" style="background: var(--primary-500-base, #4EA971);"  name="register">Buat Akun</button>
        </div>
    </div>
</form>

@endsection
