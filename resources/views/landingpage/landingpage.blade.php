@extends('partials_mahasiswa.template')

@section('page_style')
<link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">
<style>
    .btn-success {
        color: #fff;
        background-color: #4EA971 !important;
        border-color: #4EA971 !important;
    }

    .input-group> :not(:first-child):not(.dropdown-menu):not(.valid-tooltip):not(.valid-feedback):not(.invalid-tooltip):not(.invalid-feedback) {
        margin-left: -1px;
        border: 0;
        width: 220px !important;
        height: 48px !important;
    }

    .input-group> :not(:first-child):not(.dropdown-menu):not(.valid-tooltip):not(.valid-feedback):not(.invalid-tooltip):not(.invalid-feedback) {
        margin-left: -1px;
        border-top-right-radius: 5px;
        border-bottom-right-radius: 5px;
    }

    .input-group:not(.has-validation)> :not(:last-child):not(.dropdown-toggle):not(.dropdown-menu):not(.form-floating),
    .input-group:not(.has-validation)>.dropdown-toggle:nth-last-child(n+3),
    .input-group:not(.has-validation)>.form-floating:not(:last-child)>.form-control,
    .input-group:not(.has-validation)>.form-floating:not(:last-child)>.form-select {
        border-top-right-radius: 0;
        border-bottom-right-radius: 0;
        border-top: 0;
        border-bottom: 0;
        border-right: 0;
    }

    button.btn.dropdown-toggle.bs-placeholder.btn-default {
        border-left: 0;
        border-top-left-radius: 0;
        border-bottom-left-radius: 0;
        border-top: 0;
        border-bottom: 0;
        height: 46px;
        border-right: 0;
    }

    button.btn.dropdown-toggle.bs-placeholder.btn-default {
        border-left: 0;
        border-top-left-radius: 0;
        border-bottom-left-radius: 0;
    }

    .filter-option-inner-inner {
        margin-top: 6px;
    }

    .light-style .bootstrap-select .dropdown-toggle {
        border-radius: 0;
        border: 0;
    }

    .input-group:focus-within .form-control,
    .input-group:focus-within .input-group-text {
        border-color: #fff !important;
    }

    .bootstrap-select .dropdown-menu a:not([href]):not(.active):not(:active):not(.selected):hover {
        color: #4EA971 !important;
    }

    .layout-page {
        padding-top: 40px !important;
    }

    .dropdown.bootstrap-select.w-100 {
        max-width: 145px;
        max-height: 45px;
    }

    .bootstrap-select .dropdown-toggle:after {
        right: 7px !important;
    }

    .carousel-indicators [data-bs-target] {
        border-radius: 0.375rem;
        background-color: #4EA971 !important;
    }

    .carousel-control-prev-icon {
        background-image: url("{{ asset('assets/images/background/chevron-left.png') }}") !important;
    }

    .carousel-control-next-icon {
        background-image: url("{{ asset('assets/images/background/chevron-right.png') }}") !important;
    }
</style>
@endsection

@section('main')
<main class="main-content" style="background-color: #fff;">
    <div class="auto-container mt-4 mt-lg-0" style="background-image: url({{asset('assets/images/background/header.png')}}); background-repeat: no-repeat; background-size: cover; background-position: right; padding-bottom: 12rem;">
        <div class="row">
            <div class="col-4 ms-5 me-5 mb-4 " style="margin-top: 50px;">
                <div class="title-box wow animate__animated animate__fadeInUp" data-wow-delay="1000ms">
                    <h1 class="mb-4 text-start" style="font-size: 40px;">Selamat Datang Di Websites → <a style="color: #4EA971;">Talentern</a></h1>
                    <p class="text-start" style="font-size: 18px; color:#4F4F4F;">Tingkatkan peluangmu dengan mencari
                        lowongan magang yang sesuai dengan passionmu dan manfaatkan kemudahan dalam melamar pekerjaan
                        magang yang kamu idamkan.
                    </p>
                </div>
            </div>
            <div class="col-7"></div>
        </div>
        <div class="row ms-5 me-5">
            <div class="col-8 p-0">
                <h5>Trending Jobs keyword :</h5>
                <div class="row mt-4">
                    <div class="col-2">
                        <h5 style="color: #4EA971;">Web Designer</h5>
                    </div>
                    <div class="col-2">
                        <h5 style="color: #4EA971;">UI/UX Designer</h5>
                    </div>
                    <div class="col-2">
                        <h5 style="color: #4EA971;">Frontend</h5>
                    </div>
                    <div class="col-6"></div>
                </div>
                <!-- Job Search Form -->
                <div class="row mt-3" style="margin-left: -3px;">
                    <div class="job-search-form mb-lg-3" style="border-radius: 8px; border: 2px solid #4EA971; background: #FFF; height: 47px; width: 600px;">
                        <form method="post" action="{{url('/search')}}" class="p-0">

                            <div class="row">
                                <div class="col-lg-4 col-sm-3 p-0">
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon11"><i class="ti ti-search"></i></span>
                                        <input type="text" class="form-control" placeholder="Lowongan Magang" aria-label="Username" aria-describedby="basic-addon11" style="max-width:150px; max-height:45px; padding-right:0px;" />
                                    </div>
                                </div>

                                <div class="col-lg-4 col-sm-3 p-0">
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon11"><i class="ti ti-map-pin"></i></span>
                                        <input type="text" class="form-control" placeholder="Lokasi Magang" aria-label="Username" aria-describedby="basic-addon11" style="max-width:150px; max-height:45px;" />
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-3 p-0">
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="ti ti-calendar-time"></i></span>
                                        <select id="selectpickerBasic" class="selectpicker w-100" data-style="btn-default">
                                            <option value="">Jenis Magang</option>
                                            <option value="44">Magang 1 Semester</option>
                                            <option value="106">Magang 2 Semester</option>
                                            <option value="46">Magang Kerja</option>
                                            <option value="48">Magang StartUp</option>
                                            <option value="47">Magang Mandiri</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="form-group col-3">
                        <button type="submit" class="btn btn-success" style="height:47px; border-radius:8px;">Cari
                            Magang</button>
                    </div>
                </div>
            </div>
            <div class="col-3"></div>
        </div>
    </div>

    {{--Lowongan Magang Untuk Kamu--}}
    <div class="auto-container">
        <div class="sec-title text-center">
            <h2 style="padding-top:50px;">Lowongan Magang Untuk Kamu</h2>
            <p style="font-size:20px; padding-bottom:15px;">Temukan berbagai lowongan kerja yang kamu inginkan</p>
            <div class="btn mb-3">
                <button id="btnTerbaru" class="btn btn-success me-2 ml-2" type="button">Lowongan
                    Terbaru</button>
                <button id="btnPopuler" class="btn btn-outline-success me-2 ml-2" type="button">Lowongan
                    Populer</button>
            </div>
        </div>
        <div class="row" style="margin-left:150px; margin-right:80px">
            <div class="col-4 mt-4">
                <div class="card border" style="width: 100%;">
                    <div class="card-body" style="display: flex;  height: auto; flex-direction: column; flex-shrink: 0;">
                        <div class="row">
                            <div class="col-12">
                                <div class="d-flex justify-content-between">
                                    <figure class="image" style="border-radius: 0%;"><img style="border-radius: 0%;" src="{{ asset('front/assets/img/icon_lowongan.png')}}" alt="admin.upload">
                                    </figure>
                                    <div class="clock ps-5 ps-sm-0"> 8 hari lalu </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <p style="text-align: left !important; font-size:18px; margin-bottom: 0px;">PT Wings
                                    Surya</p>
                            </div>
                        </div>
                        <h2 class="mb-3" style="text-align: left !important; -webkit-line-clamp: 1;text-overflow: ellipsis; overflow: hidden; display: -webkit-box; -webkit-box-orient: vertical; word-break: break-word; margin: top 100px;">
                            Human Resources</h2>
                        <div class="location mb-3"><i class="ti ti-map-pin" style="padding-right :5px; padding-bottom:5px;"></i>Jakarta Selatan, Indonesia</div>
                        <div class="location mb-3"><i class="ti ti-currency-dollar" style="padding-right :5px; padding-bottom:5px;"></i>Berbayar
                        </div>
                        <div class="location mb-3"><i class="ti ti-calendar-time" style="padding-right :5px; padding-bottom:5px;" style="padding-right :5px; padding-bottom:5px;"></i>2 Semester</div>
                        <div class="demo-inline-spacing text-center">
                            <a href="/apply" class="btn btn-success text-white">Lamar</a>
                            <a href="/detail/lowongan/magang" class="btn btn-outline-success" style="color:#4EA971;">Detail</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4 mt-4">
                <div class="card border" style="width: 100%;">
                    <div class="card-body" style="display: flex;  height: auto; flex-direction: column; flex-shrink: 0; f">
                        <div class="row">
                            <div class="col-12">
                                <div class="d-flex justify-content-between">
                                    <figure class="image" style="border-radius: 0%;"><img style="border-radius: 0%;" src="{{ asset('front/assets/img/lowongan_uniqlo.png')}}" alt="admin.upload">
                                    </figure>
                                    <div class="clock ps-5 ps-sm-0"> 8 hari lalu </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <p class="m-0" style="text-align: left !important; -webkit-line-clamp: 1; text-overflow: ellipsis; overflow: hidden; display: -webkit-box; -webkit-box-orient: vertical; word-break: break-word; font-size: 18px;">Uniqlo Co.,Ltd</p>
                            </div>
                        </div>
                        <h2 class="mb-3" style="text-align: left !important; -webkit-line-clamp: 1;text-overflow: ellipsis; overflow: hidden; display: -webkit-box; -webkit-box-orient: vertical; word-break: break-word; margin: top 100px;">
                            Marketing Intern</h2>
                        <div class="location mb-3"><i class="ti ti-map-pin" style="padding-right :5px; padding-bottom:5px;"></i>Jakarta Selatan, Indonesia</div>
                        <div class="location mb-3"><i class="ti ti-currency-dollar" style="padding-right :5px; padding-bottom:5px;"></i>Berbayar
                        </div>
                        <div class="location mb-3"><i class="ti ti-calendar-time" style="padding-right :5px; padding-bottom:5px;" style="padding-right :5px; padding-bottom:5px;"></i>2 Semester</div>
                        <div class="demo-inline-spacing text-center">
                            <a href="/apply" class="btn btn-success text-white">Lamar</a>
                            <a href="/detail/lowongan/magang" class="btn btn-outline-success" style="color:#4EA971;">Detail</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4 mt-4">
                <div class="card border" style="width: 100%;">
                    <div class="card-body" style="display: flex;  height: auto; flex-direction: column; flex-shrink: 0;">
                        <div class="row">
                            <div class="col-12">
                                <div class="d-flex justify-content-between">
                                    <figure class="image" style="border-radius: 0%; height:60px"><img style="border-radius: 0%;" src="{{ asset('front/assets/img/Nestle.png')}}" alt="admin.upload">
                                    </figure>
                                    <div class="clock ps-5 ps-sm-0"> 8 hari lalu </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <p class="m-0" style="text-align: left !important; -webkit-line-clamp: 1; text-overflow: ellipsis; overflow: hidden; display: -webkit-box; -webkit-box-orient: vertical; word-break: break-word; font-size: 18px;">Nestle SA
                                </p>
                            </div>
                        </div>
                        <h2 class="mb-3" style="text-align: left !important; -webkit-line-clamp: 1;text-overflow: ellipsis; overflow: hidden; display: -webkit-box; -webkit-box-orient: vertical; word-break: break-word; margin: top 100px;">
                            Quality Assurance</h2>
                        <div class="location mb-3"><i class="ti ti-map-pin" style="padding-right :5px; padding-bottom:5px;"></i>Jakarta Selatan, Indonesia</div>
                        <div class="location mb-3"><i class="ti ti-currency-dollar" style="padding-right :5px; padding-bottom:5px;"></i>Berbayar
                        </div>
                        <div class="location mb-3"><i class="ti ti-calendar-time" style="padding-right :5px; padding-bottom:5px;" style="padding-right :5px; padding-bottom:5px;"></i>2 Semester</div>
                        <div class="demo-inline-spacing text-center">
                            <a href="/apply" class="btn btn-success text-white">Lamar</a>
                            <a href="/detail/lowongan/magang" class="btn btn-outline-success" style="color:#4EA971;">Detail</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" style="margin-left:150px; margin-right:80px">
            <div class="col-4 mt-4">
                <div class="card border" style="width: 100%;">
                    <div class="card-body" style="display: flex;  height: auto; flex-direction: column; flex-shrink: 0;">
                        <div class="row">
                            <div class="col-12">
                                <div class="d-flex justify-content-between">
                                    <figure class="image" style="border-radius: 0%; height:55px;"><img style="width: 125px;" src="{{ asset('front/assets/img/lazada.png')}}" alt="admin.upload">
                                    </figure>
                                    <div class="clock ps-5 ps-sm-0"> 8 hari lalu </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <p class="m-0" style="text-align: left !important; -webkit-line-clamp: 1; text-overflow: ellipsis; overflow: hidden; display: -webkit-box; -webkit-box-orient: vertical; word-break: break-word; font-size: 18px;">Lazada Group
                                </p>
                            </div>
                        </div>
                        <h2 class="mb-3" style="text-align: left !important; -webkit-line-clamp: 1;text-overflow: ellipsis; overflow: hidden; display: -webkit-box; -webkit-box-orient: vertical; word-break: break-word; margin: top 100px;">
                            Business Analyst</h2>
                        <div class="location mb-3"><i class="ti ti-map-pin" style="padding-right :5px; padding-bottom:5px;"></i>Jakarta Selatan, Indonesia</div>
                        <div class="location mb-3"><i class="ti ti-currency-dollar" style="padding-right :5px; padding-bottom:5px;"></i>Berbayar
                        </div>
                        <div class="location mb-3"><i class="ti ti-calendar-time" style="padding-right :5px; padding-bottom:5px;" style="padding-right :5px; padding-bottom:5px;"></i>2 Semester</div>
                        <div class="demo-inline-spacing text-center">
                            <a href="/apply" class="btn btn-success text-white">Lamar</a>
                            <a href="/detail/lowongan/magang" class="btn btn-outline-success" style="color:#4EA971;">Detail</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4 mt-4">
                <div class="card border" style="width: 100%;">
                    <div class="card-body" style="display: flex;  height: auto; flex-direction: column; flex-shrink: 0;">
                        <div class="row">
                            <div class="col-12">
                                <div class="d-flex justify-content-between">
                                    <figure class="image" style="border-radius: 0%; height:55px;"><img style="width: 125px;" src="{{ asset('front/assets/img/bca.png')}}" alt="admin.upload">
                                    </figure>
                                    <div class="clock ps-5 ps-sm-0"> 8 hari lalu </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <p class="m-0" style="text-align: left !important; -webkit-line-clamp: 1; text-overflow: ellipsis; overflow: hidden; display: -webkit-box; -webkit-box-orient: vertical; word-break: break-word; font-size: 18px;">PT Bank
                                    Central Asia Tbk</p>
                            </div>
                        </div>
                        <h2 class="mb-3" style="text-align: left !important; -webkit-line-clamp: 1;text-overflow: ellipsis; overflow: hidden; display: -webkit-box; -webkit-box-orient: vertical; word-break: break-word; margin: top 100px;">
                            Teller</h2>
                        <div class="location mb-3"><i class="ti ti-map-pin" style="padding-right :5px; padding-bottom:5px;"></i>Jakarta Selatan, Indonesia</div>
                        <div class="location mb-3"><i class="ti ti-currency-dollar" style="padding-right :5px; padding-bottom:5px;"></i>Berbayar
                        </div>
                        <div class="location mb-3"><i class="ti ti-calendar-time" style="padding-right :5px; padding-bottom:5px;" style="padding-right :5px; padding-bottom:5px;"></i>2 Semester</div>
                        <div class="demo-inline-spacing text-center">
                            <a href="/apply" class="btn btn-success text-white">Lamar</a>
                            <a href="/detail/lowongan/magang" class="btn btn-outline-success" style="color:#4EA971;">Detail</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4 mt-4">
                <div class="card border" style="width: 100%;">
                    <div class="card-body" style="display: flex;  height: auto; flex-direction: column; flex-shrink: 0;">
                        <div class="row">
                            <div class="col-12">
                                <div class="d-flex justify-content-between">
                                    <figure class="image" style="border-radius: 0%; height:55px;"><img style="width: 125px;" src="{{ asset('front/assets/img/mayapada.png')}}" alt="admin.upload">
                                    </figure>
                                    <div class="clock ps-5 ps-sm-0"> 8 hari lalu </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <p class="m-0" style="text-align: left !important; -webkit-line-clamp: 1; text-overflow: ellipsis; overflow: hidden; display: -webkit-box; -webkit-box-orient: vertical; word-break: break-word; font-size: 18px;">PT
                                    Sejahteraraya Anugerahjaya</p>
                            </div>
                        </div>
                        <h2 class="mb-3" style="text-align: left !important; -webkit-line-clamp: 1;text-overflow: ellipsis; overflow: hidden; display: -webkit-box; -webkit-box-orient: vertical; word-break: break-word; margin: top 100px;">
                            Resepsionis</h2>
                        <div class="location mb-3"><i class="ti ti-map-pin" style="padding-right :5px; padding-bottom:5px;"></i>Jakarta Selatan, Indonesia</div>
                        <div class="location mb-3"><i class="ti ti-currency-dollar" style="padding-right :5px; padding-bottom:5px;"></i>Berbayar
                        </div>
                        <div class="location mb-3"><i class="ti ti-calendar-time" style="padding-right :5px; padding-bottom:5px;" style="padding-right :5px; padding-bottom:5px;"></i>2 Semester</div>
                        <div class="demo-inline-spacing text-center">
                            <a href="/apply" class="btn btn-success text-white">Lamar</a>
                            <a href="/detail/lowongan/magang" class="btn btn-outline-success" style="color:#4EA971;">Detail</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center">
            <a class="mb-5 mt-5" type="button" class="btn btn-outline-success" style="color:#4EA971;; font-size:20px; margin: 20px;">Lihat
                Semua Lowongan <span class="ti ti-chevron-right" style="margin-bottom:5px;"></span></a>
        </div>
    </div>
    {{--Cari Kemampuanmu Lewat Kategori--}}
    <div class="auto-container" style="background-image: url({{asset('front/assets/landing/images/background/Section.png')}});background-size: cover; background-repeat: no-repeat;">
        <header class="section-header">
            <div class="sec-title text-center">
                <h2 style="color: white; padding-top:50px;">Cari Kemampuanmu Lewat Kategori</h2>
                <p style="color: white; font-size:20px; padding-bottom:20px;">Facilisis in elementum quam orci, nunc
                    velit. Id et ultrices rhoncus
                    gravida. Facilisis eget nunc, euismod odio.</p>
            </div>
        </header>
        <div class="row text-center" style="margin-left: 150px;">
            <div class="col-4" style="width: 28%;">
                <div class="bg-white" style="margin: 15px; width: 100%; border-radius: 15px; border-top: 10px solid #4EA971">
                    <div class="text-center p-4">
                        <h5 class="font-weight-semibold">Development & IT</h5>
                        <div class="row text-center mt-3">
                            <div class="col-6">
                                <span class="icon ti ti-map-pin"> 24 lokasi</span>
                            </div>
                            <div class="col-6">
                                <span class="icon ti ti-report" style="padding-right :5px; padding-bottom:5px;" style="padding-right :5px; padding-bottom:5px;"> 70 Lowongan</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4" style="width: 28%;">
                <div class="bg-white" style="margin: 15px; width: 100%; border-radius: 15px; border-top: 10px solid #4EA971">
                    <div class="text-center p-4">
                        <h5 class="font-weight-semibold">Design & Creatives</h5>
                        <div class="row text-center mt-3">
                            <div class="col-6">
                                <span class="icon ti ti-map-pin"> 34 lokasi</span>
                            </div>
                            <div class="col-6">
                                <span class="icon ti ti-report" style="padding-right :5px; padding-bottom:5px;" style="padding-right :5px; padding-bottom:5px;"> 56 Lowongan</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4" style="width: 28%;">
                <div class="bg-white" style="margin: 15px; width: 100%; border-radius: 15px; border-top: 10px solid #4EA971">
                    <div class="text-center p-4">
                        <h5 class="font-weight-semibold">Finance & Accounting</h5>
                        <div class="row text-center mt-3">
                            <div class="col-6">
                                <span class="icon ti ti-map-pin"> 14 lokasi</span>
                            </div>
                            <div class="col-6">
                                <span class="icon ti ti-report" style="padding-right :5px; padding-bottom:5px;" style="padding-right :5px; padding-bottom:5px;"> 36 Lowongan</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class=" row text-center justify-content-center">
            <div class="col-4" style="width: 28%;">
                <div class="bg-white" style="margin: 15px; width: 100%; border-radius: 15px; border-top: 10px solid #4EA971">
                    <div class="text-center p-4">
                        <h5 class="font-weight-semibold">Writing & Editor</h5>
                        <div class="row text-center mt-3">
                            <div class="col-6 ps-sm-4 pe-sm-4">
                                <span class="icon ti ti-map-pin"> 30 lokasi</span>
                            </div>
                            <div class="col-6">
                                <span class="icon ti ti-report" style="padding-right :5px; padding-bottom:5px;" style="padding-right :5px; padding-bottom:5px;"> 56 Lowongan</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class=" col-4" style="width: 28%;">
                <div class="bg-white" style="margin: 15px; width: 100%; border-radius: 15px; border-top: 10px solid #4EA971">
                    <div class="text-center p-4">
                        <h5 class="font-weight-semibold">Business & Sales</h5>
                        <div class="row text-center mt-3">
                            <div class="col-6 ps-sm-4 pe-sm-4">
                                <span class="icon ti ti-map-pin"> 34 lokasi</span>
                            </div>
                            <div class="col-6">
                                <span class="icon ti ti-report" style="padding-right :5px; padding-bottom:5px;" style="padding-right :5px; padding-bottom:5px;"> 56 Lowongan</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class=" text-center">
            <a class="mb-5 mt-4" type="button" class="btn btn-outline-success" style="color:#ffff; font-size:20px; margin: 20px">
            Lihat Kemampuan Lainnya<span class="ti ti-chevron-right"style="margin-bottom:5px;"></span>
            </a>
        </div>
    </div>

    {{--Mitra Perusahaan--}}
    <div class="auto-container">
        <div class="sec-title text-center mt-5">
            <h2>Mitra Perusahaan</h2>
            <div class="text" style="font-size:20px;">Talentern menjalin kerjasama dengan 500+ perusahaan nasional dan multinasional</div>
        </div>
        <div class="row mx-5">
            <div class="col-4 mt-5">
                <div class="card">
                    <div class="card-body" style="text-align: left; border-radius: 4px; flex-shrink: 0;">
                    <div>
                        <figure class="image" style="border-radius: 0%; margin-left:0px;">
                        <img style="border-radius: 0%;" src="{{ asset('front/assets/img/icon_lowongan.png')}}" alt="admin.upload"></figure>
                        <h4 style="text-align: left !important; -webkit-line-clamp: 1;text-overflow: ellipsis; overflow: hidden; display: -webkit-box; -webkit-box-orient: vertical; word-break: break-word; margin: top 100px;">PT Wings Surya</h4>
                        <div class="location" style="-webkit-line-clamp: 3;text-overflow: ellipsis; overflow: hidden; display: -webkit-box; -webkit-box-orient: vertical; word-break: break-word; margin: top 100px;">PT Fast Retailing Indonesia South Quarter Tower C, 17th Floor, Jl. R.A. Kartini Kav. 8 Cilandak, Jakarta Selatan, 12430.
                        </div>
                        <div class="button-container">
                        <a href="/detail_perusahaan" class="btn btn-outline-success mt-3" style="color:#4EA971; opacity:0.7!important;">Lihat Perusahaan</a>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
            <div class="col-4 mt-5">
                <div class="card">
                    <div class="card-body" style="text-align: left; border-radius: 4px;   flex-shrink: 0;">
                    <div>
                        <figure class="image" style="border-radius: 0%; margin-left:0px;">
                        <img style="border-radius: 0%;" src="{{ asset('front/assets/img/lowongan_uniqlo.png')}}" alt="admin.upload"></figure>
                        <h4 style="text-align: left !important; -webkit-line-clamp: 1;text-overflow: ellipsis; overflow: hidden; display: -webkit-box; -webkit-box-orient: vertical; word-break: break-word; margin: top 100px;">Uniqlo Co., Ltd</h4>
                        <div class="location" style="-webkit-line-clamp: 3;text-overflow: ellipsis; overflow: hidden; display: -webkit-box; -webkit-box-orient: vertical; word-break: break-word; margin: top 100px;">PT Fast Retailing Indonesia South Quarter Tower C, 17th Floor, Jl. R.A. Kartini Kav. 8 Cilandak, Jakarta Selatan, 12430.
                        </div>
                        <div class="button-container">
                            <a class="btn btn-outline-success mt-3" style="color:#4EA971;">Lihat Perusahaan</a>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
            <div class="col-4 mt-5">
                <div class="card">
                    <div class="card-body" style="text-align: left; border-radius: 4px;   flex-shrink: 0;">
                    <div>
                        <figure class="image" style="border-radius: 0%; margin-left:0px; height:55px;">
                        <img style="border-radius: 0%;" src="{{ asset('front/assets/img/lazada.png')}}" alt="admin.upload"></figure>
                        <h4 style="text-align: left !important; -webkit-line-clamp: 1;text-overflow: ellipsis; overflow: hidden; display: -webkit-box; -webkit-box-orient: vertical; word-break: break-word; margin: top 100px;">Lazada Group</h4>
                        <div class="location" style="-webkit-line-clamp: 3;text-overflow: ellipsis; overflow: hidden; display: -webkit-box; -webkit-box-orient: vertical; word-break: break-word; margin: top 100px;">PT Fast Retailing Indonesia South Quarter Tower C, 17th Floor, Jl. R.A. Kartini Kav. 8 Cilandak, Jakarta Selatan, 12430.
                        </div>
                        <div class="button-container">
                            <a class="btn btn-outline-success mt-3" style="color:#4EA971;">Lihat Perusahaan</a>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
            <div class="col-4 mt-5">
                <div class="card">
                    <div class="card-body" style="text-align: left; border-radius: 4px; flex-shrink: 0;">
                    <div>
                        <figure class="image" style="border-radius: 0%; margin-left:0px; height:55px;">
                        <img style="border-radius: 0%;" src="{{ asset('front/assets/img/bca.png')}}" alt="admin.upload"></figure>
                        <h4 style="text-align: left !important; -webkit-line-clamp: 1;text-overflow: ellipsis; overflow: hidden; display: -webkit-box; -webkit-box-orient: vertical; word-break: break-word; margin: top 100px;">PT Bank Central Asia Tbk</h4>
                        <div class="location" style="-webkit-line-clamp: 3;text-overflow: ellipsis; overflow: hidden; display: -webkit-box; -webkit-box-orient: vertical; word-break: break-word; margin: top 100px;">PT Fast Retailing Indonesia South Quarter Tower C, 17th Floor, Jl. R.A. Kartini Kav. 8 Cilandak, Jakarta Selatan, 12430.
                        </div>
                        <div class="button-container">
                            <a class="btn btn-outline-success mt-3" style="color:#4EA971;">Lihat Perusahaan</a>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
            <div class="col-4 mt-5">
                <div class="card">
                    <div class="card-body" style="text-align: left; border-radius: 4px;  flex-shrink: 0;">
                    <div>
                        <figure class="image" style="border-radius: 0%; margin-left:0px; height:55px;">
                        <img style="border-radius: 0%;" src="{{ asset('front/assets/img/Nestle.png')}}" alt="admin.upload"></figure>
                        <h4 style="text-align: left !important; -webkit-line-clamp: 1;text-overflow: ellipsis; overflow: hidden; display: -webkit-box; -webkit-box-orient: vertical; word-break: break-word; margin: top 100px;">Nestle SA</h4>
                        <div class="location" style="-webkit-line-clamp: 3;text-overflow: ellipsis; overflow: hidden; display: -webkit-box; -webkit-box-orient: vertical; word-break: break-word; margin: top 100px;">PT Fast Retailing Indonesia South Quarter Tower C, 17th Floor, Jl. R.A. Kartini Kav. 8 Cilandak,  Jakarta Selatan, 12430.
                        </div>
                        <div class="button-container">
                            <a class="btn btn-outline-success mt-3" style="color:#4EA971;">Lihat Perusahaan</a>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
            <div class="col-4 mt-5">
                <div class="card">
                    <div class="card-body" style="text-align: left; border-radius: 4px;  flex-shrink: 0;">
                    <div>
                        <figure class="image" style="border-radius: 0%; margin-left:0px; height:55px;">
                        <img style="border-radius: 0%;" src="{{ asset('front/assets/img/mayapada.png')}}" alt="admin.upload"></figure>
                        <h4 style="text-align: left !important; -webkit-line-clamp: 1;text-overflow: ellipsis; overflow: hidden; display: -webkit-box; -webkit-box-orient: vertical; word-break: break-word; margin: top 100px;">PT Sejahteraraya Anugerahjaya</h4>
                        <div class="location" style="-webkit-line-clamp: 3;text-overflow: ellipsis; overflow: hidden; display: -webkit-box; -webkit-box-orient: vertical; word-break: break-word; margin: top 100px;">PT Fast Retailing Indonesia South Quarter Tower C, 17th Floor, Jl. R.A. Kartini Kav. 8 Cilandak, Jakarta Selatan, 12430.
                        </div>
                        <div class="button-container">
                            <a class="btn btn-outline-success mt-3" style="color:#4EA971;">Lihat Perusahaan</a>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center">
            <a class="mb-5 mt-5" type="button" class="btn btn-outline-success" style="color:#4EA971;; font-size:20px; margin: 20px;">Lihat Perusahaan Lainnya<span class="ti ti-chevron-right" style="margin-bottom:5px;"></span></a>
        </div>
    </div>

    {{--Lowongan Magang Terbaik di Kota Besar--}}
    <div class="auto-container" style="background-image: url({{asset('front/assets/landing/images/background/blue.png')}});background-size: cover; background-repeat: no-repeat; min-width:100%;">
        <header class="section-header">
            <div class="sec-title text-center">
                <h2 style="color: white; padding-top:50px;">Lowongan Magang Terbaik di Kota Besar</h2>
                <p style="color: white; font-size:20px; padding-bottom:20px;">Temukan peluang karir anda di kota - kota besar</p>
            </div>
        </header>
        <div class="image" style="margin-left: 150px; margin-right: 150px;">
            <div class="row">
                <div class="col-3">
                    <div class="row">
                        <div class="col-12 mb-4 mb-sm-1">
                            <img src="{{ asset('front/assets/img/Bandung.png') }}" class="img-fluid" alt="bandung">
                        </div>
                        <div class="col-12 mt-3">
                            <img src="{{ asset('front/assets/img/Jakarta.png') }}" class="img-fluid" alt="jakarta">
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <img src="{{ asset('front/assets/img/Bali.png') }}" class="img-fluid" alt="bali" style="height: 98%;">
                </div>
                <div class="col-6">
                    <div class="row">
                        <div class="col-12 mb-4 mb-sm-1">
                            <img src="{{ asset('front/assets/img/Yogya.png') }}" class="img-fluid" alt="yogya">
                        </div>
                        <div class="col-6 mt-3">
                            <img src="{{ asset('front/assets/img/Surabaya.png') }}" class="img-fluid" alt="surabaya">
                        </div>
                        <div class="col-6 mt-3">
                            <img src="{{ asset('front/assets/img/Medan.png') }}" class="img-fluid" alt="medan">
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center">
                <a class="mb-5" type="button" class="btn btn-outline-success" style="color:white; font-size:20px; margin: 20px;">Lihat Semua Wilayah <span class="ti ti-chevron-right" style="margin-bottom:5px;"></span></a>
            </div>
        </div>
    </div>

    {{-- Cara Melamar Pekerjaan--}}
    <div class="auto-container mt-5 mb-5">
        <div class="widgets-section">
            <div class="row">
                <div class="col-12">
                    <div id="carouselExample-cf" class="carousel slide" data-bs-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-bs-target="#carouselExample-cf" data-bs-slide-to="0" class="active"></li>
                            <li data-bs-target="#carouselExample-cf" data-bs-slide-to="1"></li>
                        </ol>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <div class="row" style="margin-left: 150px; margin-right: 168px;">
                                    <div class="col-6">
                                        <h2 style="margin-top: 100px; color: #4EA971; ">Bagaimana Cara Melamar Pekerjaan di Talentern?</h2>
                                        <h1 style="color: #4F4F44; ">5 Langkah Melamar <br> Pekerjaan di Talentern</h1>
                                        <p style="font-size: 16px;">
                                        Sodales mauris quam faucibus scelerisque risus malesuada nulla. Cursus enim quis elementum feugiat ut. Phasellus a viverra facilisis eu purus. Et risus magna dis nisl nulla sed diam.</p>
                                        <button type="button" class="btn btn-success mb-5">Cari Lowongan Sekarang</button>
                                        <div class="big-column">
                                            <div class="footer-column about-widget">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div style="margin-top: 25px; margin-bottom: 30px; margin-right:100px;">
                                        <img src="{{ asset('front/assets/img/background_pekerjaan.svg') }}" class="img-fluid" alt="" style="height: 500px; margin-left: 130px; width:700px ;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class="row" style="margin-left: 150px; margin-right: 168px;">
                                    <div class="col-6">
                                        <div style="margin-top: 25px; margin-bottom: 30px; margin-right:100px;">
                                        <img src="{{ asset('front/assets/img/background_perusahaan.svg') }}" class="img-fluid" alt="" style="height: 500px; margin-right: 130px; width:700px ;">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <h2 style="margin-top: 100px; color: #4EA971; ">Bagaimana Cara Talentern Membantu Perusahaan?</h2>
                                        <h1 style="color: #4F4F44; ">5 Langkah Talentern Membantu Perusahaan</h1>
                                        <p style="font-size: 16px;">
                                        Sodales mauris quam faucibus scelerisque risus malesuada nulla. Cursus enim quis elementum feugiat ut. Phasellus a viverra facilisis eu purus. Et risus magna dis nisl nulla sed diam.</p>
                                        <button type="button" class="btn btn-success mb-5">Cari Lowongan Sekarang</button>
                                        <div class="big-column">
                                            <div class="footer-column about-widget">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#carouselExample-cf" role="button" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExample-cf" role="button" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@section('page_script')
<script src=" https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
                                    @endsection