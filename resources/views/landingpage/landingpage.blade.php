@extends('partials.horizontal_menu')

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
            top: 50% !important;
        }

        .light-style .bootstrap-select .dropdown-toggle {
            padding-left: 0%;
        }

        .bootstrap-select.dropup .dropdown-toggle:after {
            transform: rotate(-45deg) translateY(-50%);
            height: 0.5em;
            width: 0.5em;
            right: 0px !important;
            top: 60% !important;
        }

        .input-group:focus-within {
            box-shadow: none;
        }

        .dropdown-menu {
            max-height: 250px !important;
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid px-0 flex-grow-1">
        <div style="background-image: url({{ asset('assets/images/background/Header.png') }}); background-repeat: no-repeat; background-size: cover; background-position: right; padding-bottom: 12rem;">
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
                        <form class="d-flex justify-content-start" action="{{ url('/apply-lowongan') }}" method="get">
                            <div class="d-flex" style="border-radius: 8px; border: 2px solid #4EA971; background: #FFF;">
                                <div class="flex-fill">
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i class="ti ti-search"></i></span>
                                        <input type="text" name="lowongan" class="form-control" placeholder="Lowongan Magang"/>
                                    </div>
                                </div>
                                <div class="my-auto" style="width:0.1rem;height:25px;background-color: #4EA971"></div>
                                <div class="flex-fill">
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i class="ti ti-map-pin"></i></span>
                                        <select id="lokasi" name="location" class="pe-3 selectpicker" data-style="btn-default" data-live-search="true" tabindex="null" data-allow-clear="true">
                                            <option value="" selected>Lokasi Magang</option>
                                            @foreach ($kota as $item)
                                                <option>{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="my-auto" style="width:0.1rem;height:25px;background-color: #4EA971"></div>
                                <div class="flex-fill">
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i class="ti ti-calendar-time"></i></span>
                                        <select name="jenis_magang" class="selectpicker pe-3" data-style="btn-default" data-allow-clear="true">
                                            <option value="" selected disabled>Pilih Jenis Magang</option>
                                            @foreach ($jenisMagang as $item)
                                                <option value="{{ $item->id_jenismagang }}">{{ $item->namajenis }} ({{ $item->durasimagang }})</option>
                                            @endforeach
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
            <div id="container-lowongan-magang"></div>
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
            <div id="container-mitra"></div>
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
                            <img src="{{ url('front/assets/img/surabaya.png') }}" class="img-fluid" alt="surabaya">
                        </div>
                        <div class="col-auto" style="margin-left: 1.7rem !important;">
                            <img src="{{ url('front/assets/img/medan.png') }}" class="img-fluid" alt="medan">
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

<script>
    $(document).ready(function () {
        loadData('container-lowongan-magang', 'container-mitra');
    });

    function loadData(...type) {
        $.each(type, function (key, value) {
            $.ajax({
                url: "{{ route('dashboard') }}?component=" + value,
                type: 'GET',
                success: function (response) {
                    $('#' + value).html(response);
                }
            });
        });
    }


</script>
@endsection

