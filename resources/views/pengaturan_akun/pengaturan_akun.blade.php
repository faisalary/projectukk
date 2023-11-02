@extends('layouts.front_layout')

@section('page_style')

<link id="bootstrap-css" href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
@endsection

@section('content-main')
<section class="top-companies" style="background: #E5E5E5; margin-top: 80px;">
  <div class="auto-container">
    <div class="sec-title mt-4 mb-4">
      <h4 style="color:#4B465C;">Pengaturan Akun</h4>
    </div>
    <div class="card col-12 mb-3" style="height: auto;">
      <div style="margin-top: 15px; margin-left: 20px; ">
        <h5 style="color:#4B465C;">Ubah Kata sandi</h5>
      </div>
      <div class="card-body">
        <div class="form-row">
          <div class="form-group col-md-4">
            <label style="color:#4B465C;">Kata sandi Saat Ini</label>
            <div class="input-group" id="show_hide_password">
              <input type="password" class="form-control" placeholder="Kata sandi Saat Ini" style="border-right: 0px;">
              <div class="input-group-append">
                <span class="input-group-text" style="background-color: #ffffffff; border-left: 0px;"><i class="fa fa-eye-slash" aria-hidden="true"></i></span>
              </div>
            </div>
          </div>

          <div class="form-group col-md-4">
            <label style="color:#4B465C;">Kata sandi Baru</label>
            <div class="input-group" id="show_hide_password_baru">
              <input type="password" class="form-control" placeholder="Kata sandi Baru" style="border-right: 0px;">
              <div class="input-group-append">
                <span class="input-group-text" style="background-color: #ffffffff; border-left: 0px;"><i class="fa fa-eye-slash" aria-hidden="true"></i></span>
              </div>
            </div>
          </div>
          <div class="form-group col-md-4">
            <label style="color:#4B465C;">Konfirmasi Kata sandi Baru</label>
            <div class="input-group" id="show_hide_password_konfirmasi">
              <input type="password" class="form-control" placeholder="Konfirmasi Kata sandi Baru" style="border-right: 0px;">
              <div class="input-group-append">
                <span class="input-group-text" style="background-color: #ffffffff; border-left: 0px;"><i class="fa fa-eye-slash" aria-hidden="true"></i></span>
              </div>
            </div>
            </div>
          </div>
          <div class="col-12 text-right pr-0 mt-2 mb-2">
            <button type="button" id="btn_edit_password" class="btn btn-success waves-effect waves-float waves-light" style="background-color: #4EA971;"> Simpan</button>
          </div>
        </div>
      </div>
    <div class="card col-12 mb-5" style="height: auto;">
      <div style="margin-top: 15px; margin-left: 20px; ">
        <h5 style="color:#4B465C;">Ubah Email</h5>
      </div>
      <div class="card-body">
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="inputEmail" style="color:#4B465C;">Email Saat ini</label>
            <input type="email" placeholder="Email Saat ini" class="form-control" id="inputEmail">
          </div>
          <div class="form-group col-md-6">
            <label for="inputEmailBaru" style="color:#4B465C;">Email Baru</label>
            <input type="email" placeholder="Email Baru" class="form-control" id="inputEmailBaru">
          </div>
        </div>
        <div class="col-12 text-right pr-0 mt-2 mb-2">
          <button type="button" id="btn_edit_password" class="btn btn-success waves-effect waves-float waves-light" style="background-color: #4EA971;">
            Simpan</button>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection