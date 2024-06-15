@extends('partials.guest')

@section('content')
    <div class="authentication-wrapper authentication-cover authentication-bg">
        <div class="authentication-inner row">
            <!-- Register -->
            <div class="d-flex col-12 col-lg-5 align-items-center p-sm-5 p-4">
                <div class="w-px-400 mx-auto">
                    <!-- Logo -->
                    <div class="logo mr-3"><a href="{{ url('/') }}"><img src={{ asset('assets/images/app-logo.png') }} alt="icon" style="margin-bottom: 10px;" width="auto" height="35px"></a></div>
                    <h3 class="mb-1 fw-bold">Selamat Datang Di Talentern!👋</h3>
                    <p class="mb-4" style="font-size: 10pt">Silahkan melakukan pendaftaran dengan mengisi data diri berikut</p>
                    <!-- /Logo -->

                    <form class="default-form" method="POST" action="{{ url('/mahasiswa/register') }}">
                        @csrf
                        <div class="row">
                            <div class="col mb-2 form-input">
                                <label for="roleregister" class="form-label">Role Registrasi</label>
                                <select class="form-select select2" id="roleregister" name="roleregister" data-placeholder="Pilih Role Anda Terlebih Dahulu" onchange="redirectToPage()">
                                    {{-- <option disabled selected>Pilih Role Anda Terlebih Dahulu</option> --}}
                                    <option value="user">Mahasiswa</option>
                                    <option value="mitra">Company</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col">
                                <label for="nim" class="col-form-label text-md-end">{{ __('NIM') }}</label>
                                <div class="md-6">
                                    <input id="nim" type="text" class="form-control @error('nim') is-invalid @enderror" name="nim" value="{{ old('nim') }}" autocomplete="nim" placeholder="Masukkan NIM" autofocus>
                                    @error('nim')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group mt-3">
                            <div class="col-sm-12 mt-4">
                                <button id="modal-button" type="submit" class="btn btn-primary d-grid w-100" style="background: var(--primary-500-base, #4EA971);" name="register">Buat Akun</button>
                            </div>
                        </div>
                    </form>

                    <p class="text-center mt-2">
                        <span>Already have an account?</span>
                        <a href="{{ url('/login') }}">
                            <span>Sign in instead</span>
                        </a>
                    </p>
                </div>
            </div>
            <!-- /Register -->
            <!-- /Left Text -->
            <div class="d-none d-lg-flex col-lg-7 p-0">
                <div class="auth-cover-bg d-flex justify-content-center align-items-center" style="margin-right: 30px">
                    <img alt="auth-login-cover" class="img-fluid my-5 auth-illustration" style="background-image "
                        src="{{ asset('assets/images/background/register.svg') }}" alt="Login" />
                </div>
            </div>
            <!-- /Left Text -->
        </div>
    </div>
@endsection
