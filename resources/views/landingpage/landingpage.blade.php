@extends('partials.landing_page')

@section('page_style')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">
    <style>

        .input-group> :not(:first-child):not(.dropdown-menu):not(.valid-tooltip):not(.valid-feedback):not(.invalid-tooltip):not(.invalid-feedback) {
            /* width: 220px !important; */
            height: 48px !important;
            border: none;
            border-radius: 5px;
        }

        .input-group:not(.has-validation)> :not(:last-child):not(.dropdown-toggle):not(.dropdown-menu):not(.form-floating),
        .input-group:not(.has-validation)>.dropdown-toggle:nth-last-child(n+3),
        .input-group:not(.has-validation)>.form-floating:not(:last-child)>.form-control,
        .input-group:not(.has-validation)>.form-floating:not(:last-child)>.form-select {
            border: 0;
            border-top-right-radius: 0;
            border-bottom-right-radius: 0;
        }

        .dropdown.bootstrap-select {
            max-width: 170px;
            max-height: 45px;
        }

        .bootstrap-select .dropdown-toggle:after {
            right: 5px !important;
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid px-0 flex-grow-1">
        <div style="background-image: url({{ asset('assets/images/background/header.png') }}); background-repeat: no-repeat; background-size: cover; background-position: right; padding-bottom: 12rem;">
            <div class="d-flex justify-content-start">
                <div class="col-4 mx-5 mb-4 mt-5">
                    <div class="title-box wow animate__animated animate__fadeInUp" data-wow-delay="1000ms">
                        <h1 class="mb-4 text-start" style="font-size: 40px;">Selamat Datang Di Websites → <span class="text-primary">Talentern</span></h1>
                        <p class="text-start" style="font-size: 18px; color:#4F4F4F;">Tingkatkan peluangmu dengan mencari
                            lowongan magang yang sesuai dengan passionmu dan manfaatkan kemudahan dalam melamar pekerjaan
                            magang yang kamu idamkan.
                        </p>
                    </div>
                </div>
            </div>
            <div class="row ms-5 me-5">
                <div class="col p-0">  
                    <h5>Trending Jobs keyword :</h5>
                    <div class="row mt-4">
                        <div class="col-auto"><h5 class="text-primary">Web Designer</h5></div>
                        <div class="col-auto"><h5 class="text-primary">UI/UX Designer</h5></div>
                        <div class="col-auto"><h5 class="text-primary">Frontend</h5></div>
                    </div>
                    <!-- Job Search Form -->
                    <div class="row mt-3">
                        <form class="d-flex justify-content-start" action="{{ url('/search') }}" method="post">
                            <div class="d-flex" style="border-radius: 8px; border: 2px solid #4EA971; background: #FFF;">
                                <div class="flex-fill">
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i class="ti ti-search"></i></span>
                                        <input type="text" class="form-control" placeholder="Lowongan Magang"/>
                                    </div>
                                </div>
                                <div class="my-auto" style="width:0.1rem;height:25px;background-color: #4EA971"></div>
                                <div class="flex-fill">
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i class="ti ti-map-pin"></i></span>
                                        <input type="text" class="form-control" placeholder="Lokasi Magang"/>
                                    </div>
                                </div>
                                <div class="my-auto" style="width:0.1rem;height:25px;background-color: #4EA971"></div>
                                <div class="flex-fill">
                                    <div class="input-group input-group-merge position-relative">
                                        <span class="input-group-text"><i class="ti ti-calendar-time"></i></span>
                                        <select name="jenis_magang" class="selectpicker pe-2" data-style="btn-default">
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
                            <div class="d-flex ms-3">
                                <button type="submit" class="btn btn-primary">Cari Magang</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        {{-- Lowongan Magang Untuk Kamu --}}
        <div class="d-flex flex-column">
            <div class="nav-align-top">
                <h2 class="text-center mt-3">Lowongan Magang Untuk Kamu</h2>
                <p class="text-center mt-1" style="font-size:20px;">Temukan berbagai lowongan kerja yang kamu inginkan</p>
                <ul class="nav nav-pills mt-2 mb-3 justify-content-center" role="tablist">
                    <li class="nav-item" style="font-size: large;">
                        <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-justified-terbaru" aria-controls="navs-pills-justified-terbaru" aria-selected="false"> Lowongan Terbaru</button>
                    </li>
                    <li class="nav-item" style="font-size: large;">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-justified-populer" aria-controls="navs-pills-justified-populer" aria-selected="false"> Lowongan Populer</button>
                    </li>
                </ul>
            </div>
            <div class="tab-content p-0">
                <div class="tab-pane fade show active" id="navs-pills-justified-terbaru" role="tabpanel">
                    <div class="row" style="margin-left: 10rem;margin-right: 10rem;">
                        <div class="col-4 mt-4">
                            <div class="card h-100 border">
                                <div class="card-body pb-0">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="d-flex justify-content-between" style="height: 70px;">
                                                <img class="img-fluid h-100" src="{{ asset('front/assets/img/icon_lowongan.png') }}" alt="admin.upload">
                                                <div class="clock"> 8 hari lalu </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <p class="mb-0 mt-3 text-truncate" style="font-size:18px;">PT Wing o Wings</p>
                                        </div>
                                    </div>
                                    <h2 class="mb-3 text-truncate"> Programmer</h2>
                                    <div class="location mb-3">
                                        <i class="ti ti-map-pin"></i>
                                        <span class="ps-2 text-truncate">Jakarta Selatan, Indonesia</span>
                                    </div>
                                    <div class="location mb-3">
                                        <i class="ti ti-currency-dollar"></i>
                                        <span class="ps-2 text-truncate">Rp 1.000.000 - 5.000.000</span>
                                    </div>
                                    <div class="location mb-3">
                                        <i class="ti ti-calendar-time"></i>
                                        <span class="ps-2 text-truncate">2 Semester</span>
                                    </div>
                                    
                                </div>
                                <div class="card-footer">
                                    <div class="demo-inline-spacing text-center">
                                        <a href="/apply" class="btn btn-primary">Lamar</a>
                                        <a href="/detail/lowongan/magang" class="btn btn-outline-primary">Detail</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-4 mt-4">
                            <div class="card h-100 border">
                                <div class="card-body pb-0">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="d-flex justify-content-between" style="height: 70px;">
                                                <img class="img-fluid h-100" src="{{ asset('front/assets/img/icon_lowongan.png') }}" alt="admin.upload">
                                                <div class="clock"> 8 hari lalu </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <p class="mb-0 mt-3 text-truncate" style="font-size:18px;">PT Wing o Wings</p>
                                        </div>
                                    </div>
                                    <h2 class="mb-3 text-truncate"> Programmer</h2>
                                    <div class="location mb-3">
                                        <i class="ti ti-map-pin"></i>
                                        <span class="ps-2 text-truncate">Jakarta Selatan, Indonesia</span>
                                    </div>
                                    <div class="location mb-3">
                                        <i class="ti ti-currency-dollar"></i>
                                        <span class="ps-2 text-truncate">Rp 1.000.000 - 5.000.000</span>
                                    </div>
                                    <div class="location mb-3">
                                        <i class="ti ti-calendar-time"></i>
                                        <span class="ps-2 text-truncate">2 Semester</span>
                                    </div>
                                    
                                </div>
                                <div class="card-footer">
                                    <div class="demo-inline-spacing text-center">
                                        <a href="/apply" class="btn btn-primary">Lamar</a>
                                        <a href="/detail/lowongan/magang" class="btn btn-outline-primary">Detail</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-4 mt-4">
                            <div class="card h-100 border">
                                <div class="card-body pb-0">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="d-flex justify-content-between" style="height: 70px;">
                                                <img class="img-fluid h-100" src="{{ asset('front/assets/img/icon_lowongan.png') }}" alt="admin.upload">
                                                <div class="clock"> 8 hari lalu </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <p class="mb-0 mt-3 text-truncate" style="font-size:18px;">PT Wing o Wings</p>
                                        </div>
                                    </div>
                                    <h2 class="mb-3 text-truncate"> Programmer</h2>
                                    <div class="location mb-3">
                                        <i class="ti ti-map-pin"></i>
                                        <span class="ps-2 text-truncate">Jakarta Selatan, Indonesia</span>
                                    </div>
                                    <div class="location mb-3">
                                        <i class="ti ti-currency-dollar"></i>
                                        <span class="ps-2 text-truncate">Rp 1.000.000 - 5.000.000</span>
                                    </div>
                                    <div class="location mb-3">
                                        <i class="ti ti-calendar-time"></i>
                                        <span class="ps-2 text-truncate">2 Semester</span>
                                    </div>
                                    
                                </div>
                                <div class="card-footer">
                                    <div class="demo-inline-spacing text-center">
                                        <a href="/apply" class="btn btn-primary">Lamar</a>
                                        <a href="/detail/lowongan/magang" class="btn btn-outline-primary">Detail</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-4 mt-4">
                            <div class="card h-100 border">
                                <div class="card-body pb-0">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="d-flex justify-content-between" style="height: 70px;">
                                                <img class="img-fluid h-100" src="{{ asset('front/assets/img/icon_lowongan.png') }}" alt="admin.upload">
                                                <div class="clock"> 8 hari lalu </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <p class="mb-0 mt-3 text-truncate" style="font-size:18px;">PT Wing o Wings</p>
                                        </div>
                                    </div>
                                    <h2 class="mb-3 text-truncate"> Programmer</h2>
                                    <div class="location mb-3">
                                        <i class="ti ti-map-pin"></i>
                                        <span class="ps-2 text-truncate">Jakarta Selatan, Indonesia</span>
                                    </div>
                                    <div class="location mb-3">
                                        <i class="ti ti-currency-dollar"></i>
                                        <span class="ps-2 text-truncate">Rp 1.000.000 - 5.000.000</span>
                                    </div>
                                    <div class="location mb-3">
                                        <i class="ti ti-calendar-time"></i>
                                        <span class="ps-2 text-truncate">2 Semester</span>
                                    </div>
                                    
                                </div>
                                <div class="card-footer">
                                    <div class="demo-inline-spacing text-center">
                                        <a href="/apply" class="btn btn-primary">Lamar</a>
                                        <a href="/detail/lowongan/magang" class="btn btn-outline-primary">Detail</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-4 mt-4">
                            <div class="card h-100 border">
                                <div class="card-body pb-0">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="d-flex justify-content-between" style="height: 70px;">
                                                <img class="img-fluid h-100" src="{{ asset('front/assets/img/icon_lowongan.png') }}" alt="admin.upload">
                                                <div class="clock"> 8 hari lalu </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <p class="mb-0 mt-3 text-truncate" style="font-size:18px;">PT Wing o Wings</p>
                                        </div>
                                    </div>
                                    <h2 class="mb-3 text-truncate"> Programmer</h2>
                                    <div class="location mb-3">
                                        <i class="ti ti-map-pin"></i>
                                        <span class="ps-2 text-truncate">Jakarta Selatan, Indonesia</span>
                                    </div>
                                    <div class="location mb-3">
                                        <i class="ti ti-currency-dollar"></i>
                                        <span class="ps-2 text-truncate">Rp 1.000.000 - 5.000.000</span>
                                    </div>
                                    <div class="location mb-3">
                                        <i class="ti ti-calendar-time"></i>
                                        <span class="ps-2 text-truncate">2 Semester</span>
                                    </div>
                                    
                                </div>
                                <div class="card-footer">
                                    <div class="demo-inline-spacing text-center">
                                        <a href="/apply" class="btn btn-primary">Lamar</a>
                                        <a href="/detail/lowongan/magang" class="btn btn-outline-primary">Detail</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade show" id="navs-pills-justified-populer" role="tabpanel">
                    <div class="row" style="margin-left: 10rem;margin-right: 10rem;">
                        <div class="col-4 mt-4">
                            <div class="card h-100 border">
                                <div class="card-body pb-0">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="d-flex justify-content-between" style="height: 70px;">
                                                <img class="img-fluid h-100" src="{{ asset('front/assets/img/icon_lowongan.png') }}" alt="admin.upload">
                                                <div class="clock"> 8 hari lalu </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <p class="mb-0 mt-3 text-truncate" style="font-size:18px;">PT Wing o Wings</p>
                                        </div>
                                    </div>
                                    <h2 class="mb-3 text-truncate"> Programmer</h2>
                                    <div class="location mb-3">
                                        <i class="ti ti-map-pin"></i>
                                        <span class="ps-2 text-truncate">Jakarta Selatan, Indonesia</span>
                                    </div>
                                    <div class="location mb-3">
                                        <i class="ti ti-currency-dollar"></i>
                                        <span class="ps-2 text-truncate">Rp 1.000.000 - 5.000.000</span>
                                    </div>
                                    <div class="location mb-3">
                                        <i class="ti ti-calendar-time"></i>
                                        <span class="ps-2 text-truncate">2 Semester</span>
                                    </div>
                                    
                                </div>
                                <div class="card-footer">
                                    <div class="demo-inline-spacing text-center">
                                        <a href="/apply" class="btn btn-primary">Lamar</a>
                                        <a href="/detail/lowongan/magang" class="btn btn-outline-primary">Detail</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-4 mt-4">
                            <div class="card h-100 border">
                                <div class="card-body pb-0">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="d-flex justify-content-between" style="height: 70px;">
                                                <img class="img-fluid h-100" src="{{ asset('front/assets/img/icon_lowongan.png') }}" alt="admin.upload">
                                                <div class="clock"> 8 hari lalu </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <p class="mb-0 mt-3 text-truncate" style="font-size:18px;">PT Wing o Wings</p>
                                        </div>
                                    </div>
                                    <h2 class="mb-3 text-truncate"> Programmer</h2>
                                    <div class="location mb-3">
                                        <i class="ti ti-map-pin"></i>
                                        <span class="ps-2 text-truncate">Jakarta Selatan, Indonesia</span>
                                    </div>
                                    <div class="location mb-3">
                                        <i class="ti ti-currency-dollar"></i>
                                        <span class="ps-2 text-truncate">Rp 1.000.000 - 5.000.000</span>
                                    </div>
                                    <div class="location mb-3">
                                        <i class="ti ti-calendar-time"></i>
                                        <span class="ps-2 text-truncate">2 Semester</span>
                                    </div>
                                    
                                </div>
                                <div class="card-footer">
                                    <div class="demo-inline-spacing text-center">
                                        <a href="/apply" class="btn btn-primary">Lamar</a>
                                        <a href="/detail/lowongan/magang" class="btn btn-outline-primary">Detail</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-4 mt-4">
                            <div class="card h-100 border">
                                <div class="card-body pb-0">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="d-flex justify-content-between" style="height: 70px;">
                                                <img class="img-fluid h-100" src="{{ asset('front/assets/img/icon_lowongan.png') }}" alt="admin.upload">
                                                <div class="clock"> 8 hari lalu </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <p class="mb-0 mt-3 text-truncate" style="font-size:18px;">PT Wing o Wings</p>
                                        </div>
                                    </div>
                                    <h2 class="mb-3 text-truncate"> Programmer</h2>
                                    <div class="location mb-3">
                                        <i class="ti ti-map-pin"></i>
                                        <span class="ps-2 text-truncate">Jakarta Selatan, Indonesia</span>
                                    </div>
                                    <div class="location mb-3">
                                        <i class="ti ti-currency-dollar"></i>
                                        <span class="ps-2 text-truncate">Rp 1.000.000 - 5.000.000</span>
                                    </div>
                                    <div class="location mb-3">
                                        <i class="ti ti-calendar-time"></i>
                                        <span class="ps-2 text-truncate">2 Semester</span>
                                    </div>
                                    
                                </div>
                                <div class="card-footer">
                                    <div class="demo-inline-spacing text-center">
                                        <a href="/apply" class="btn btn-primary">Lamar</a>
                                        <a href="/detail/lowongan/magang" class="btn btn-outline-primary">Detail</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-4 mt-4">
                            <div class="card h-100 border">
                                <div class="card-body pb-0">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="d-flex justify-content-between" style="height: 70px;">
                                                <img class="img-fluid h-100" src="{{ asset('front/assets/img/icon_lowongan.png') }}" alt="admin.upload">
                                                <div class="clock"> 8 hari lalu </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <p class="mb-0 mt-3 text-truncate" style="font-size:18px;">PT Wing o Wings</p>
                                        </div>
                                    </div>
                                    <h2 class="mb-3 text-truncate"> Programmer</h2>
                                    <div class="location mb-3">
                                        <i class="ti ti-map-pin"></i>
                                        <span class="ps-2 text-truncate">Jakarta Selatan, Indonesia</span>
                                    </div>
                                    <div class="location mb-3">
                                        <i class="ti ti-currency-dollar"></i>
                                        <span class="ps-2 text-truncate">Rp 1.000.000 - 5.000.000</span>
                                    </div>
                                    <div class="location mb-3">
                                        <i class="ti ti-calendar-time"></i>
                                        <span class="ps-2 text-truncate">2 Semester</span>
                                    </div>
                                    
                                </div>
                                <div class="card-footer">
                                    <div class="demo-inline-spacing text-center">
                                        <a href="/apply" class="btn btn-primary">Lamar</a>
                                        <a href="/detail/lowongan/magang" class="btn btn-outline-primary">Detail</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-4 mt-4">
                            <div class="card h-100 border">
                                <div class="card-body pb-0">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="d-flex justify-content-between" style="height: 70px;">
                                                <img class="img-fluid h-100" src="{{ asset('front/assets/img/icon_lowongan.png') }}" alt="admin.upload">
                                                <div class="clock"> 8 hari lalu </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <p class="mb-0 mt-3 text-truncate" style="font-size:18px;">PT Wing o Wings</p>
                                        </div>
                                    </div>
                                    <h2 class="mb-3 text-truncate"> Programmer</h2>
                                    <div class="location mb-3">
                                        <i class="ti ti-map-pin"></i>
                                        <span class="ps-2 text-truncate">Jakarta Selatan, Indonesia</span>
                                    </div>
                                    <div class="location mb-3">
                                        <i class="ti ti-currency-dollar"></i>
                                        <span class="ps-2 text-truncate">Rp 1.000.000 - 5.000.000</span>
                                    </div>
                                    <div class="location mb-3">
                                        <i class="ti ti-calendar-time"></i>
                                        <span class="ps-2 text-truncate">2 Semester</span>
                                    </div>
                                    
                                </div>
                                <div class="card-footer">
                                    <div class="demo-inline-spacing text-center">
                                        <a href="/apply" class="btn btn-primary">Lamar</a>
                                        <a href="/detail/lowongan/magang" class="btn btn-outline-primary">Detail</a>
                                    </div>
                                </div>
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

        {{-- Cari Kemampuanmu Lewat Kategori --}}
        <div style="background-image: url({{ asset('front/assets/landing/images/background/Section.png') }});background-size: cover; background-repeat: no-repeat;background-position: center;">
            <header class="section-header">
                <div class="sec-title text-center">
                    <h2 style="color: white; padding-top:50px;">Cari Kemampuanmu Lewat Kategori</h2>
                    <p style="color: white; font-size:20px; padding-bottom:20px;">Facilisis in elementum quam orci, nunc velit. Id et ultrices rhoncus gravida. Facilisis eget nunc, euismod odio.</p>
                </div>
            </header>
            <div class="d-flex mx-auto" style="width: 85%;">
                <div class="col-4">
                    <div class="bg-white" style="margin: 15px; border-radius: 15px; border-top: 10px solid #4EA971">
                        <div class="text-center p-4">
                            <h5 class="font-weight-semibold">Development & IT</h5>
                            <div class="row text-center mt-3">
                                <div class="col-6">
                                    <i class="icon ti ti-map-pin"></i>
                                    <span class="ps-2">24 lokasi</span>
                                </div>
                                <div class="col-6">
                                    <i class="icon ti ti-report"></i>
                                    <span class="ps-2">70 Lowongan</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="bg-white" style="margin: 15px; border-radius: 15px; border-top: 10px solid #4EA971">
                        <div class="text-center p-4">
                            <h5 class="font-weight-semibold">Development & IT</h5>
                            <div class="row text-center mt-3">
                                <div class="col-6">
                                    <i class="icon ti ti-map-pin"></i>
                                    <span class="ps-2">24 lokasi</span>
                                </div>
                                <div class="col-6">
                                    <i class="icon ti ti-report"></i>
                                    <span class="ps-2">70 Lowongan</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="bg-white" style="margin: 15px; border-radius: 15px; border-top: 10px solid #4EA971">
                        <div class="text-center p-4">
                            <h5 class="font-weight-semibold">Development & IT</h5>
                            <div class="row text-center mt-3">
                                <div class="col-6">
                                    <i class="icon ti ti-map-pin"></i>
                                    <span class="ps-2">24 lokasi</span>
                                </div>
                                <div class="col-6">
                                    <i class="icon ti ti-report"></i>
                                    <span class="ps-2">70 Lowongan</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class=" text-center">
                <a class="mb-5 mt-5" type="button" class="btn btn-outline-success"
                    style="color:#ffff; font-size:20px; margin: 20px">
                    Lihat Kemampuan Lainnya<span class="ti ti-chevron-right" style="margin-bottom:5px;"></span>
                </a>
            </div>
        </div>

        {{-- Mitra Perusahaan --}}
        <div class="d-flex flex-column">
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
                                    <img style="border-radius: 0%;" src="{{ asset('front/assets/img/icon_lowongan.png') }}" alt="admin.upload">
                                </figure>
                                <h4
                                    style="text-align: left !important; -webkit-line-clamp: 1;text-overflow: ellipsis; overflow: hidden; display: -webkit-box; -webkit-box-orient: vertical; word-break: break-word; margin: top 100px;">
                                    PT Wings Surya</h4>
                                <div class="location"
                                    style="-webkit-line-clamp: 3;text-overflow: ellipsis; overflow: hidden; display: -webkit-box; -webkit-box-orient: vertical; word-break: break-word; margin: top 100px;">
                                    PT Fast Retailing Indonesia South Quarter Tower C, 17th Floor, Jl. R.A. Kartini Kav. 8
                                    Cilandak, Jakarta Selatan, 12430.
                                    PT Fast Retailing Indonesia South Quarter Tower C, 17th Floor, Jl. R.A. Kartini Kav. 8
                                    Cilandak, Jakarta Selatan, 12430.
                                </div>
                                <div class="button-container">
                                    <a href="/detail_perusahaan" class="btn btn-outline-primary mt-3">Lihat Perusahaan</a>
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
                                    <img style="border-radius: 0%;"
                                        src="{{ asset('front/assets/img/lowongan_uniqlo.png') }}" alt="admin.upload">
                                </figure>
                                <h4
                                    style="text-align: left !important; -webkit-line-clamp: 1;text-overflow: ellipsis; overflow: hidden; display: -webkit-box; -webkit-box-orient: vertical; word-break: break-word; margin: top 100px;">
                                    Uniqlo Co., Ltd</h4>
                                <div class="location"
                                    style="-webkit-line-clamp: 3;text-overflow: ellipsis; overflow: hidden; display: -webkit-box; -webkit-box-orient: vertical; word-break: break-word; margin: top 100px;">
                                    PT Fast Retailing Indonesia South Quarter Tower C, 17th Floor, Jl. R.A. Kartini Kav. 8
                                    Cilandak, Jakarta Selatan, 12430.
                                </div>
                                <div class="button-container">
                                    <a href="#" class="btn btn-outline-primary mt-3">Lihat Perusahaan</a>
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
                                    <img style="border-radius: 0%;" src="{{ asset('front/assets/img/lazada.png') }}"
                                        alt="admin.upload">
                                </figure>
                                <h4
                                    style="text-align: left !important; -webkit-line-clamp: 1;text-overflow: ellipsis; overflow: hidden; display: -webkit-box; -webkit-box-orient: vertical; word-break: break-word; margin: top 100px;">
                                    Lazada Group</h4>
                                <div class="location"
                                    style="-webkit-line-clamp: 3;text-overflow: ellipsis; overflow: hidden; display: -webkit-box; -webkit-box-orient: vertical; word-break: break-word; margin: top 100px;">
                                    PT Fast Retailing Indonesia South Quarter Tower C, 17th Floor, Jl. R.A. Kartini Kav. 8
                                    Cilandak, Jakarta Selatan, 12430.
                                </div>
                                <div class="button-container">
                                    <a href="#" class="btn btn-outline-primary mt-3">Lihat Perusahaan</a>
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
                                    <img style="border-radius: 0%;" src="{{ asset('front/assets/img/bca.png') }}"
                                        alt="admin.upload">
                                </figure>
                                <h4
                                    style="text-align: left !important; -webkit-line-clamp: 1;text-overflow: ellipsis; overflow: hidden; display: -webkit-box; -webkit-box-orient: vertical; word-break: break-word; margin: top 100px;">
                                    PT Bank Central Asia Tbk</h4>
                                <div class="location"
                                    style="-webkit-line-clamp: 3;text-overflow: ellipsis; overflow: hidden; display: -webkit-box; -webkit-box-orient: vertical; word-break: break-word; margin: top 100px;">
                                    PT Fast Retailing Indonesia South Quarter Tower C, 17th Floor, Jl. R.A. Kartini Kav. 8
                                    Cilandak, Jakarta Selatan, 12430.
                                </div>
                                <div class="button-container">
                                    <a href="#" class="btn btn-outline-primary mt-3">Lihat Perusahaan</a>
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
                                    <img style="border-radius: 0%;" src="{{ asset('front/assets/img/Nestle.png') }}"
                                        alt="admin.upload">
                                </figure>
                                <h4
                                    style="text-align: left !important; -webkit-line-clamp: 1;text-overflow: ellipsis; overflow: hidden; display: -webkit-box; -webkit-box-orient: vertical; word-break: break-word; margin: top 100px;">
                                    Nestle SA</h4>
                                <div class="location"
                                    style="-webkit-line-clamp: 3;text-overflow: ellipsis; overflow: hidden; display: -webkit-box; -webkit-box-orient: vertical; word-break: break-word; margin: top 100px;">
                                    PT Fast Retailing Indonesia South Quarter Tower C, 17th Floor, Jl. R.A. Kartini Kav. 8
                                    Cilandak, Jakarta Selatan, 12430.
                                </div>
                                <div class="button-container">
                                    <a href="#" class="btn btn-outline-primary mt-3">Lihat Perusahaan</a>
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
                                    <img style="border-radius: 0%;" src="{{ asset('front/assets/img/mayapada.png') }}"
                                        alt="admin.upload">
                                </figure>
                                <h4
                                    style="text-align: left !important; -webkit-line-clamp: 1;text-overflow: ellipsis; overflow: hidden; display: -webkit-box; -webkit-box-orient: vertical; word-break: break-word; margin: top 100px;">
                                    PT Sejahteraraya Anugerahjaya</h4>
                                <div class="location"
                                    style="-webkit-line-clamp: 3;text-overflow: ellipsis; overflow: hidden; display: -webkit-box; -webkit-box-orient: vertical; word-break: break-word; margin: top 100px;">
                                    PT Fast Retailing Indonesia South Quarter Tower C, 17th Floor, Jl. R.A. Kartini Kav. 8
                                    Cilandak, Jakarta Selatan, 12430.
                                </div>
                                <div class="button-container">
                                    <a href="#" class="btn btn-outline-primary mt-3">Lihat Perusahaan</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center">
                <a class="mb-5 mt-5" type="button" class="btn btn-outline-success"
                    style="color:#4EA971;; font-size:20px; margin: 20px;">Lihat Perusahaan Lainnya<span
                        class="ti ti-chevron-right" style="margin-bottom:5px;"></span></a>
            </div>
        </div>

        {{-- Lowongan Magang Terbaik di Kota Besar --}}
        <div style="background-image: url({{ url('front/assets/landing/images/background/blue.png') }});background-size: cover; background-repeat: no-repeat; min-width:100%;">
            <header class="section-header">
                <div class="sec-title text-center">
                    <h2 style="color: white; padding-top:50px;">Lowongan Magang Terbaik di Kota Besar</h2>
                    <p style="color: white; font-size:20px; padding-bottom:20px;">Temukan peluang karir anda di kota - kota besar</p>
                </div>
            </header>
            <div class="d-flex justify-content-center">
                <div class="row mx-2">
                    <div class="d-flex flex-column">
                        <div class="col-auto">
                            <img src="{{ url('front/assets/img/Bandung.png') }}" class="img-fluid" alt="bandung">
                        </div>
                        <div class="col-auto" style="margin-top:1.7rem !important;">
                            <img src="{{ url('front/assets/img/Jakarta.png') }}" class="img-fluid" alt="jakarta">
                        </div>
                    </div>
                </div>
                <div class="row mx-2">
                    <img src="{{ url('front/assets/img/Bali.png') }}" class="img-fluid" alt="bali" style="height: 98%;">
                </div>
                <div class="d-flex flex-column mx-2">
                    <div class="d-flex justify-content-start">
                        <div class="col-auto mx-2">
                            <img src="{{ url('front/assets/img/Yogya.png') }}" class="img-fluid" alt="yogya">
                        </div>
                    </div>
                    <div class="d-flex justify-content-start" style="margin-top:1.7rem !important;">
                        <div class="col-auto mx-2">
                            <img src="{{ url('front/assets/img/Surabaya.png') }}" class="img-fluid" alt="surabaya">
                        </div>
                        <div class="col-auto" style="margin-left: 1.7rem !important;">
                            <img src="{{ url('front/assets/img/Medan.png') }}" class="img-fluid" alt="medan">
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center">
                <a class="mb-5 mt-5" type="button" style="color:white; font-size:20px; margin: 20px;">Lihat Semua Wilayah <span class="ti ti-chevron-right" style="margin-bottom:5px;"></span></a>
            </div>
        </div>

        {{-- Cara Melamar Pekerjaan --}}
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
                                Sodales mauris quam faucibus scelerisque risus malesuada nulla. Cursus enim
                                quis elementum feugiat ut. Phasellus a viverra facilisis eu purus. Et risus
                                magna dis nisl nulla sed diam.</p>
                            <button type="button" class="btn btn-success mb-5">Cari Lowongan
                                Sekarang</button>
                            <div class="big-column">
                                <div class="footer-column about-widget">
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div style="margin-top: 25px; margin-bottom: 30px; margin-right:100px;">
                                <img src="{{ asset('front/assets/img/background_pekerjaan.svg') }}"
                                    class="img-fluid" alt=""
                                    style="height: 500px; margin-left: 130px; width:700px ;">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="row" style="margin-left: 150px; margin-right: 168px;">
                        <div class="col-6">
                            <div style="margin-top: 25px; margin-bottom: 30px; margin-right:100px;">
                                <img src="{{ asset('front/assets/img/background_perusahaan.svg') }}"
                                    class="img-fluid" alt=""
                                    style="height: 500px; margin-right: 130px; width:700px ;">
                            </div>
                        </div>
                        <div class="col-6">
                            <h2 style="margin-top: 100px; color: #4EA971; ">Bagaimana Cara Talentern
                                Membantu Perusahaan?</h2>
                            <h1 style="color: #4F4F44; ">5 Langkah Talentern Membantu Perusahaan</h1>
                            <p style="font-size: 16px;">
                                Sodales mauris quam faucibus scelerisque risus malesuada nulla. Cursus enim
                                quis elementum feugiat ut. Phasellus a viverra facilisis eu purus. Et risus
                                magna dis nisl nulla sed diam.</p>
                            <button type="button" class="btn btn-primary mb-5">Cari Lowongan Sekarang</button>
                            {{-- <div class="big-column">
                                <div class="footer-column about-widget"></div>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExample-cf" role="button"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExample-cf" role="button"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </a>
        </div>
    </d>
@endsection

@section('page_script')
    <script src=" https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
@endsection
