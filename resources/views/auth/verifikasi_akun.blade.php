@extends('partials.guest')

@section('content')
<div class="authentication-wrapper authentication-cover authentication-bg" style="background-image: url({{ asset('app-assets/img/branding/bg_password.png') }});background-size: cover; background-repeat: no-repeat; min-width:100%;">
    <div class="authentication-inner row">
        <div class="d-flex col-12 align-items-center p-sm-5 p-4">
            <div class="w-px-400 mx-auto">
                @yield('conten')
                <div class="card text-center" style="width: 450px;">
                    <div class="card-header">
                        <div class="text-center">
                            <img src="{{ asset('app-assets/img/branding/Talentern.png') }}" style="width:250px">
                        </div>
                    </div>
                    <form id="updatePasswordForm" action="{{ route('register.set-password.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="token" value="{{$token}}">
                        <div class="text-start ps-5 pe-5">
                            <h5>Silakan buat kata sandi anda</h5>
                            <div class="mb-3 ">
                                <label class="form-label">Kata sandi <span style="color: red;">*</span> </label>
                                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Kata sandi"  >
                                @error('password')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3 ">
                                <label class="form-label">Konfirmasi Kata sandi <span style="color: red;">*</span> </label>
                                <input type="password" name="password_confirmation" class="form-control @error('password') is-invalid @enderror" placeholder="Konfirmasi Kata sandi" >
                                @error('password_confirmation')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <h6>Password Requirements:</h6>
                            <li>Panjang minimal 8 karakter</li>
                            <li>Setidaknya satu karakter huruf kecil</li>
                            <li>Setidaknya satu angka, simbol atau karakter</li>
                        </div>
                        <button type="submit" class="btn btn-primary m-5">Atur kata sandi</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>     
@endsection