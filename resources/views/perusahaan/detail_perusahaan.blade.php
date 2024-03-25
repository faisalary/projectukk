@extends('partials_mahasiswa.template')

@section('page_style')
<style>
    .hidden {
        display: none;
    }

    .page-item>.page-link.active {
        border-color: #4EA971 !important;
        background-color: #4EA971 !important;
        color: #fff;
    }

    .btn-success {
        color: #fff;
        background-color: #4EA971 !important;
        border-color: #4EA971 !important;
    }

    .highlight {
        background-color: #4EA971 !important;
        color: white !important;
    }

    .progress-bar {
        background-color: #4EA971 !important;
        color: #fff;
    }
</style>
@endsection

@section('main')
<div class="container-xxl flex-grow-1 container-p-y">

    <a id="back" type="button" class="btn btn-outline-success mt-4 mb-3 waves-effect">
        <span class="ti ti-arrow-left me-2"></span>Kembali
    </a>
    <div class="col-md-10 col-12">
        <h4 class="fw-bold"> <span class="text-muted fw-light text-xs">Daftar Mitra / </span> Detail Mitra </h4>
    </div>

    <div class="card mb-5">
        <div class="card-body">
            <div class="row">
                <div class="col-2 text-left">
                    <figure class="image" style="border-radius: 0%;"><img style="border-radius: 0%; width:200px;" src="{{ asset('front/assets/img/icon_lowongan.png')}}" alt="admin.upload">
                    </figure>
                </div>
                <div class="col-4 ">
                    <h2 class="mb-1">PT Wings Surya</h2>
                    <p>Wings Food</p>
                </div>
                <div class="col-6 text-end">
                    <button type="button" class="btn btn-outline-dark waves-effect me-3" onclick="changeColor(this)" data-bs-toggle="modal" data-bs-target="#modalbagikan" data-bs-placement="bottom" data-bs-original-title="Bagikan">
                        <i class="ti ti-share me-1"></i>Bagikan
                    </button>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-4">
                    <h6 class="mb-0">Alamat Perusahaan</h6>
                    <p>Jl. Tipar Cakung Kav. F 5-7, Cakung Barat, <br>
                        Cakung, Jakarta Timur, Jakarta 13910, ID</p>
                </div>
                <div class="col-4">
                    <h6 class="mb-0">Email</h6>
                    <p>wing@gmail.com</p>
                </div>
                <div class="col-4">
                    <h6 class="mb-0">Phone</h6>
                    <p>+6295948438388</p>
                </div>
            </div>
        </div>
    </div>

    <div class="card mb-5">
        <div class="card-body">
            <div class="border-bottom mt-3">
                <h4> Tentang Perusahaan</h4>
            </div>
            <p class="mt-3">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut ac risus sem. Sed sapien purus, consectetur ac elit
                non, iaculis bibendum quam. In sed risus quis urna molestie interdum in eu quam. Mauris id dolor semper,
                fermentum mi non, consectetur ex. Duis aliquam, tortor ut dictum sodales, mauris erat imperdiet lorem, in
                eleifend purus nisi vitae sapien. Suspendisse eget viverra ex. Sed malesuada elit ut magna interdum finibus.
                Nulla volutpat posuere felis, ac tempor turpis hendrerit pretium. Duis dictum posuere augue vel aliquet.</p>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut ac risus sem. Sed sapien purus, consectetur ac elit
                non, iaculis bibendum quam. In sed risus quis urna molestie interdum in eu quam. Mauris id dolor semper,
                fermentum mi non, consectetur ex. Duis aliquam, tortor ut dictum sodales, mauris erat imperdiet lorem, in
                eleifend purus nisi vitae sapien. Suspendisse eget viverra ex. Sed malesuada elit ut magna interdum finibus.
                Nulla volutpat posuere felis, ac tempor turpis hendrerit pretium. Duis dictum posuere augue vel aliquet. </p>
        </div>
    </div>

    <div class="card" style="background-color: #f8f7fa;">
        <div class="card-header p-3" style="background-color: #23314B;">
            <div class="row">
                <div class="col-6">
                    <h4 class="mb-0 ps-2 pt-2" style="color: #FFFFFF;">Lowongan Tersedia di Perusahaan</h4>
                </div>
                <div class="col-6">
                    <div class="row">
                        <div class="col-9">
                            <div class="input-group input-group-merge ">
                                <span class="input-group-text" id="basic-addon-search31"><i class="ti ti-search"></i></span>
                                <input type="text" class="form-control" placeholder="Lowongan Pekerjaan" aria-label="Search..." aria-describedby="basic-addon-search31">
                            </div>
                        </div>
                        <div class="col-3">
                            <button type="button" class="btn btn-success waves-effect waves-light" style="height: 47px;">Cari
                                Sekarang</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body mt-5">
            <div class="row border-bottom">
                <div class="col-2">
                    <figure class="image" style="border-radius: 0%;"><img style="border-radius: 0%; width:150px;" src="{{ asset('front/assets/img/icon_lowongan.png')}}" alt="admin.upload">
                    </figure>
                </div>
                <div class="col-8">
                    <h2 class="mb-1">Human Resources</h2>
                    <p style="text-align: left !important; font-size:15px; margin-bottom: 0px;">PT Wings Surya</p>
                    <p>Jl. Tipar Cakung Kav. F 5-7, Cakung Barat, Cakung, Jakarta Timur, Jakarta 13910, ID</p>
                </div>
                <div class="col-2">
                    <div class="text-end ps-5"> <i class="ti ti-clock mb-1"> </i> 8hari lalu</div>
                </div>
            </div>
            <div class="row border-bottom mt-5">
                <div class="col-2">
                    <figure class="image" style="border-radius: 0%;"><img style="border-radius: 0%; width:150px;" src="{{ asset('front/assets/img/icon_lowongan.png')}}" alt="admin.upload">
                    </figure>
                </div>
                <div class="col-8">
                    <h2 class="mb-1">Human Resources</h2>
                    <p style="text-align: left !important; font-size:15px; margin-bottom: 0px;">PT Wings Surya</p>
                    <p>Jl. Tipar Cakung Kav. F 5-7, Cakung Barat, Cakung, Jakarta Timur, Jakarta 13910, ID</p>
                </div>
                <div class="col-2">
                    <div class="text-end ps-5"> <i class="ti ti-clock mb-1"> </i> 8hari lalu</div>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-2">
                    <figure class="image" style="border-radius: 0%;"><img style="border-radius: 0%; width:150px;" src="{{ asset('front/assets/img/icon_lowongan.png')}}" alt="admin.upload">
                    </figure>
                </div>
                <div class="col-8">
                    <h2 class="mb-1">Human Resources</h2>
                    <p style="text-align: left !important; font-size:15px; margin-bottom: 0px;">PT Wings Surya</p>
                    <p>Jl. Tipar Cakung Kav. F 5-7, Cakung Barat, Cakung, Jakarta Timur, Jakarta 13910, ID</p>
                </div>
                <div class="col-2">
                    <div class="text-end ps-5"> <i class="ti ti-clock mb-1"> </i> 8hari lalu</div>
                </div>
            </div>
        </div>
    </div>

    <nav aria-label="Page navigation">
        <ul class="pagination justify-content-end mb-0 mt-3">
            <li class="page-item ">
                <a class="page-link waves-effect" href="javascript:void(0);">Previous</a>
            </li>
            <li class="page-item">
                <a class="page-link waves-effect active" href="javascript:void(0);">1</a>
            </li>
            <li class="page-item">
                <a class="page-link waves-effect" href="javascript:void(0);">2</a>
            </li>
            <li class="page-item">
                <a class="page-link waves-effect" href="javascript:void(0);">3</a>
            </li>
            <li class="page-item ">
                <a class="page-link waves-effect" href="javascript:void(0);">Next</a>
            </li>

        </ul>
    </nav>


    <!-- Modal -->
    <div class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="card">
                    <div class="card-body text-center">
                        <figure class="image"><img src="{{ url('/app-assets/img/Talentern.svg')}}"></figure>
                        <div class="text-center">
                            <div class=""></div>
                            <h4>Apakah anda akan melaporkan lowongan ini? </h4>
                            <p>Jika ya, silahkan plih salah satu alasan berikut dan tim Kepercayaan dan
                                Keamanan kami akan memeriksanya. </p>
                        </div>
                        <div class="modal-body pt-0">
                            <div class="text-center mt-3">
                                <button type="submit" class="btn btn-outline-dark waves-effect" style="width: 370px;">
                                    Ini adalah akun palsu
                                </button>
                            </div>
                            <div class="text-center mt-3">
                                <button type="submit" class="btn btn-outline-dark waves-effect" style="width: 370px;">
                                    Mereka berpura-pura menjadi perusahaan lain
                                </button>
                            </div>
                            <div class="text-center mt-3">
                                <button type="submit" class="btn btn-outline-dark waves-effect" style="width: 370px;">
                                    Mereka mencoba berbagi informasi kontak
                                </button>
                            </div>
                            <div class="text-center mt-3">
                                <button type="button" class="btn btn-outline-dark waves-effect" data-bs-toggle="modal" data-bs-target="#modalLaporan" style="width: 370px;">
                                    Lainnya
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalLaporan" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="card">
                    <div class="card-body text-center pb-0">
                        <figure class="image"><img src="{{ url('/app-assets/img/Talentern.svg')}}"></figure>
                        <div>
                            <h4 class="text-center">Laporkan PT Mencari Cinta Sejati </h4>
                            <p class="text-start">Harap tambahkan informasi tambahan dan detail pendukung agar tim Kepercayaan dan Keamanan kami dapat memeriksa laporan Anda dengan lebih baik. </p>
                        </div>
                    </div>
                    <div class="modal-body pt-0">
                        <div class="row">
                            <div class="col mb-3">
                                <label for="nameWithTitle" class="form-label">Nama Lowongan </label>
                                <input type="text" id="nameWithTitle" class="form-control" placeholder="Nama Lowongan" disabled>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col mb-0">
                                <label for="namaWithTitle" class="form-label">Nama Depan</label>
                                <input type="text" id="namaWithTitle" class="form-control" placeholder="Nama Depan">
                            </div>
                            <div class="col mb-0">
                                <label for="namaWithTitle" class="form-label">Nama Belakang</label>
                                <input type="text" id="namaWithTitle" class="form-control" placeholder="Nama Belakang">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <label for="emailWithTitle" class="form-label">Email<span class="text-danger">*</span></label>
                                <input type="email" id="emailWithTitle" class="form-control" placeholder="Email">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <label for="deskripsiWithTitle" class="form-label">Deskripsi <span class="text-danger">*</span></label>
                                <textarea id="deskripsiWithTitle" class="form-control" placeholder="Deskripsi"></textarea>
                            </div>
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-success waves-effect waves-light" style="width: 510px;">
                                Kirim
                            </button>
                        </div>
                        <div class="mb-1"></div>
                        <button type="submit" class="btn btn-secondary waves-effect waves-light" data-bs-dismiss="modal" aria-label="Close" style="width: 510px;">
                            Batal
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalbagikan" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="card">
                    <div class="card-body text-center pb-0">
                        <!-- <figure class="image"><img src="{{ url('/app-assets/img/Talentern.svg')}}"></figure> -->
                        <div class="text-start">
                            <h4>Share </h4>
                        </div>
                    </div>
                    <div class="modal-body pt-0">
                        <div class="row">
                            <div class="col-2 mb-3 text-center p-0">
                                <button type="button" class="btn rounded-pill btn-icon btn-dark waves-effect waves-light" style="width: 50px; height:50px;">
                                    <span class="ti ti-brand-tiktok" style="font-size: 40px;"></span>
                                </button>
                                <p class="mt-1">TikTok</p>
                            </div>
                            <div class="col-2 mb-3 text-center p-0">
                                <button type="button" class="btn rounded-pill btn-icon btn-success waves-effect waves-light" style="width: 50px; height:50px; background-color: #65D072 !important;">
                                    <span class="ti ti-brand-whatsapp" style="font-size: 35px;"></span>
                                </button>
                                <p class="mt-1">WhatsApp</p>
                            </div>
                            <div class="col-2 mb-3 text-center p-0">
                                <button type="button" class="btn rounded-pill btn-icon btn-primary waves-effect waves-light" style="width: 50px; height:50px; background-color: #425893 !important;">
                                    <span class="ti ti-brand-facebook" style="font-size: 30px;"></span>
                                </button>
                                <p class="mt-1">Facebook</p>
                            </div>
                            <div class="col-2 mb-3 text-center p-0">
                                <button type="button" class="btn rounded-pill btn-icon btn-info waves-effect waves-light" style="width: 50px; height:50px; background-color: #1EA1F2 !important;">
                                    <span class="ti ti-brand-twitter" style="font-size: 25px;"></span>
                                </button>
                                <p class="mt-1">Twitter</p>
                            </div>
                            <div class="col-2 mb-3 text-center p-0">
                                <button type="button" class="btn rounded-pill btn-icon btn-secondary waves-effect waves-light" style="width: 50px; height:50px;">
                                    <span class="ti ti-mail" style="font-size: 35px;"></span>
                                </button>
                                <p class="mt-1">Email</p>
                            </div>
                            <div class="col-2 mb-3 text-center p-0">
                                <button type="button" class="btn rounded-pill btn-icon btn-danger waves-effect waves-light" style="width: 50px; height:50px; background-color: #FF0000 !important;">
                                    <span class="ti ti-brand-youtube" style="font-size: 35px;"></span>
                                </button>
                                <p class="mt-1">Youtube</p>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="border" style="border-radius: 20px;">
                                <div class="row">
                                    <div class="col-10">
                                        <p class="m-2">https://youtu.be/TGxKkBC6L2k</p>
                                    </div>
                                    <div class="col-2">
                                        <button type="button" class="btn rounded-pill btn-success waves-effect waves-light" style="width: 65px; height:40px;">
                                            Copy
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('page_script')
<script>
    function changeColor(button) {
        button.classList.toggle('highlight');
    }

    document.getElementById("back").addEventListener("click", () => {
        history.back();
    });
</script>
@endsection