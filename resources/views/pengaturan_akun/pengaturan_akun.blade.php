@extends('layouts.front_layout')

@section('page_style')
<style>
  .field-icon {
    float: right;
    margin-left: -30px;
    margin-right: 10px;
    margin-top: 11px;
    position: relative;
    z-index: 2;
  }
</style>
@endsection

@section('content-main')
<section>
  <div style="margin-top: 100px; margin-bottom: 25px; margin-left: 50px;">
    <h1>Pengaturan Akun</h1>
  </div>

  <div class="container" style="max-width: 1600px;">
    <div class="card col-12 mb-5" style="height:250px;">
      <div style="margin-top: 15px; margin-left: 20px; ">
        <h4>Ubah Kata sandi</h4>
      </div>
      <div class="card-body">
        <div class="form-row">
          <div class="form-group col-md-4">
            <label for="inputpassword">Kata sandi Saat ini </label>
            <div class="input-group form-password-toggle">
              <input id="password-field" type="password" class="form-control" name="password" placeholder="Kata sandi Saat ini" value="">
              <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password">
              </span>
            </div>
          </div>
          <div class="form-group col-md-4">
            <label for="inputpassword">Kata sandi Baru </label>
            <div class="input-group form-password-toggle">
              <input id="passwordbaru-field" type="password" class="form-control" name="password" placeholder="Kata sandi Baru" value="">
              <span toggle="#passwordbaru-field" class="fa fa-fw fa-eye field-icon toggle-password">
              </span>
            </div>
          </div>
          <div class="form-group col-md-4">
            <label for="inputpassword">Konfirmasi Kata sandi Baru </label>
            <div class="input-group form-password-toggle">
              <input id="konfirmasipassword-field" type="password" class="form-control" name="password" placeholder="Konfirmasi Kata sandi Baru" value="">
              <span toggle="#konfirmasipassword-field" class="fa fa-fw fa-eye field-icon toggle-password">
              </span>
            </div>
          </div>
          <div class="col-12 text-right pr-0 mt-2 mb-2">
            <button type="button" id="btn_edit_password" class="btn btn-primary waves-effect waves-float waves-light" style="background-color: #4EA971;"> Simpan</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section>
  <div class="container" style="max-width: 1600px;">
    <div class="card col-12 mb-5" style="height:250px;">
      <div style="margin-top: 15px; margin-left: 20px; ">
        <h4>Ubah Email</h4>
      </div>
      <div class="card-body">
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="inputEmail4">Email Saat ini</label>
            <input type="email" placeholder="Email Saat ini" class="form-control" id="inputEmail4">
          </div>
          <div class="form-group col-md-6">
            <label for="inputPassword4">Email Baru</label>
            <input type="password" placeholder="Email Baru" class="form-control" id="inputPassword4">
          </div>
        </div>
        <div class="col-12 text-right pr-0 mt-2 mb-2">
          <button type="button" id="btn_edit_password" class="btn btn-primary waves-effect waves-float waves-light" style="background-color: #4EA971;">
            Simpan</button>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection

@section('page_script')
<script>
  $(".toggle-password").click(function() {

    $(this).toggleClass("fa-eye fa-eye-slash");
    var input = $($(this).attr("toggle"));
    if (input.attr("type") == "password") {
      input.attr("type", "text");
    } else {
      input.attr("type", "password");
    }
  });
</script>
@endsection