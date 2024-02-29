@extends('partials_auth.register_mitra')
@section('conten')

    <form method="POST" action="{{ url('mitra/register') }}">
        @csrf
        <div class="row">
            <div class="col mb-2 form-input">
                <label for="role" class="form-label">Silahkan Pilih Role Untuk Registrasi</label>
                <select class="form-select select2" id="roleregister" name="roleregister"
                    data-placeholder="Pilih Role Anda Terlebih Dahulu" onchange="redirectToPage()">
                    <option disabled selected>Pilih Role Anda Terlebih Dahulu</option>
                    <option value="user">Mahasiswa</option>
                    <option value="mitra">Mitra</option>
                </select>
            </div>
        </div>

        {{-- form-control --}}
        <div class="form-group">
            <div class="col">
                <label for="name" class="col-form-label text-md-end">{{ __('Nama Penanggung Jawab Perusahaan') }}</label>

                <div class="md-6">
                    <input id="name" type="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" placeholder="Masukkan Nama" autofocus>

                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col">
                <label for="namaindustri" class="col-form-label text-md-end">{{ __('Nama Instansi/Perusahaan') }}</label>
                <div class="md-6">
                    <input id="namaindustri" type="namaindustri" class="form-control @error('namaindustri') is-invalid @enderror" name="namaindustri" value="{{ old('namaindustri') }}" required autocomplete="namaindustri" placeholder="Masukkan nama perusahaan/instansi" autofocus>

                    @error('namaindustri')
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
                <label for="email" class="col-form-label text-md-end">{{ __('Email Instansi') }}</label>

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
                <label for="notelpon" class="col-form-label text-md-end">{{ __('No Hp ') }}</label>

                <div class="md-6">
                    <input id="notelpon" type="notelpon" class="form-control @error('notelpon') is-invalid @enderror" name="notelpon" value="{{ old('notelpon') }}" required autocomplete="notelpon" placeholder="No. Hp Penanggung Jawab" autofocus>

                    @error('notelpon')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
        </div>
        {{-- form-control --}}
        <div class="form-group mt-3">
            <div class="col-sm-12 mt-4">
            <button type="submit" class="btn btn-primary d-grid w-100" style="background: var(--primary-500-base, #4EA971);" name="register" data-bs-toggle="modal" data-bs-target="#register-mitra">Buat Akun</button>
            </div>
        </div>
    </form>
@endsection
