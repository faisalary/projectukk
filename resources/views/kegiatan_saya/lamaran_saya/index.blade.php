@extends('partials_mahasiswa.template')
@section('meta_header')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('page_style')
    <link rel="stylesheet" href="{{ asset('app-assets/vendor/libs/sweetalert2/sweetalert2.css') }}" />
    <style>

    </style>
@endsection

@section('page_style')
    <style>
        .nav~.tab-content {
            background: none !important;
        }

        .nav-pills .nav-link.active,
        .nav-pills .nav-link.active:hover,
        .nav-pills .nav-link.active:focus {
            background-color: #4EA971 !important;
            color: #fff;
        }

        .nav-pills .nav-link:not(.active):hover,
        .nav-pills .nav-link:not(.active):focus {
            color: #4EA971 !important;
        }

        .btn-success {
            color: #fff;
            background-color: #4EA971 !important;
            border-color: #4EA971 !important;
        }
    </style>
@endsection

@section('main')
    @include('kegiatan_saya.lamaran_saya.modal')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="col-md-12 col-12 mt-3">
            <h4 class="fw-bold"><span class="text-muted fw-light">Kegiatan Saya /</span> Status Lamaran Magang</h4>
        </div>

        <div class="row ps-3">
            <ul class="nav nav-pills mb-3 " role="tablist">
                <li class="nav-item" style="font-size: 15px;">
                    <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                        data-bs-target="#navs-pills-justified-magang-fakultas"
                        aria-controls="navs-pills-justified-magang-fakultas" aria-selected="false">
                        Magang Fakultas
                    </button>
                </li>
                <li class="nav-item" style="font-size: 15px;">
                    <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                        data-bs-target="#navs-pills-justified-magang-mandiri"
                        aria-controls="navs-pills-justified-magang-mandiri" aria-selected="false">
                        Magang Mandiri
                    </button>
                </li>
            </ul>

            <div class="tab-content p-0">
                <!-- Magang Fakultas -->
                <div class="tab-pane fade show active" id="navs-pills-justified-magang-fakultas" role="tabpanel">
                    <div class="row mt-2" style="padding-left: 12px;">
                        <ul class="nav nav-pills mb-3 " role="tablist">
                            <li class="nav-item" style="font-size: 15px;">
                                <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                                    data-bs-target="#navs-pills-justified-proses-seleksi"
                                    aria-controls="navs-pills-justified-proses-seleksi" aria-selected="false">
                                    <i class="ti ti-presentation-analytics pe-1"></i> Proses Seleksi
                                </button>
                            </li>
                            <li class="nav-item" style="font-size: 15px;">
                                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                                    data-bs-target="#navs-pills-justified-penawaran"
                                    aria-controls="navs-pills-justified-penawaran" aria-selected="false">
                                    <i class="ti ti-speakerphone pe-1"></i> Penawaran
                                </button>
                            </li>
                            <li class="nav-item" style="font-size: 15px;">
                                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                                    data-bs-target="#navs-pills-justified-terima" aria-controls="
              "
                                    aria-selected="false">
                                    <i class="ti ti-clipboard-check pe-1"></i> Terima Tawaran
                                </button>
                            </li>
                            <li class="nav-item" style="font-size: 15px;">
                                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                                    data-bs-target="#navs-pills-justified-tolak" aria-controls="navs-pills-justified-tolak"
                                    aria-selected="false">
                                    <i class="ti ti-clipboard-x pe-1"></i> Tolak Tawaran
                                </button>
                            </li>
                        </ul>

                        <div class="cnt">
                            <div id="div2" class="col-1 targetDiv" style="display: none;">
                                <div class="col-md-4 col-12 mb-3 d-flex align-items-center justify-content-between">
                                    <select class="select2 form-select" data-placeholder="Ubah Status Kandidat">
                                    </select>
                                    <button class="btn btn-success waves-effect waves-light" data-bs-toggle="offcanvas"
                                        data-bs-target="#modalSlide" style="min-width: 142px;"><i
                                            class="tf-icons ti ti-checks">
                                            Terapkan</i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="tab-content p-0">
                            <div class="tab-pane fade show active" id="navs-pills-justified-proses-seleksi" role="tabpanel">
                                <div class="card mt-2">
                                    <div class="card-body">
                                        <a href="/kegiatan_saya/lamaran_saya/status" style="color:#4B4B4B">
                                            <div class="row mb-2">
                                                <div class="col-2">
                                                    <figure class="image" style="border-radius: 0%;"><img
                                                            style="border-radius: 0%;"
                                                            src="{{ asset('front/assets/img/icon_lowongan.png') }}"
                                                            alt="admin.upload">
                                                    </figure>
                                                </div>
                                                <div class="col-10 d-flex justify-content-between">
                                                    <div>
                                                        <h5>Human Resources</h5>
                                                        <p>PT Wings Surya</p>
                                                    </div>
                                                    <div>
                                                        <span
                                                            class="badge bg-label-secondary me-1 text-end">Penawaran</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text-left mb-2">
                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut ac risus sem.
                                                    Sed sapien purus, consectetur ac elit non, iaculis bibendum quam. In sed
                                                    risus quis urna molestie interdum in eu quam. Mauris id dolor semper,
                                                    fermentum mi non, consectetur ex. Duis aliquam, tortor ut dictum
                                                    sodales, mauris erat imperdiet lorem, in eleifend purus nisi vitae
                                                    sapien. Suspendisse eget viverra ex. Sed malesuada elit ut magna
                                                    interdum finibus. Nulla volutpat posuere felis, ac tempor turpis
                                                    hendrerit pretium. Duis dictum posuere augue vel aliquet. </p>
                                            </div>
                                        </a>
                                        <hr />
                                        <div class="row mt-2">
                                            <div class="col-12 d-flex justify-content-between">
                                                <div class="col-6">
                                                    <span> <i class="ti ti-map-pin" style="font-size: medium;"></i>
                                                        Jakarta Selatan, Indonesia</span>
                                                    <span> <i class="ti ti-currency-dollar ms-3"
                                                            style="font-size: medium;"></i> Berbayar</span>
                                                    <span> <i class="ti ti-calendar-time ms-3"
                                                            style="font-size: medium;"></i> 2 Semester</span>
                                                    <span> <i class="ti ti-users ms-3" style="font-size: medium;"></i> 5
                                                        Kuota Penerimaan</span>
                                                </div>
                                                <div class="col-6">
                                                    <div class="text-end" style="font-size: medium; color : #4EA971">
                                                        Lamaran terkirim pada 15 juni 2023</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card mt-4">
                                    <div class="card-body">
                                        <a href="/kegiatan_saya/lamaran_saya/status" style="color:#4B4B4B">
                                            <div class="row mb-2">
                                                <div class="col-2">
                                                    <figure class="image" style="border-radius: 0%;"><img
                                                            style="border-radius: 0%;"
                                                            src="{{ asset('front/assets/img/icon_lowongan.png') }}"
                                                            alt="admin.upload">
                                                    </figure>
                                                </div>
                                                <div class="col-10 d-flex justify-content-between">
                                                    <div>
                                                        <h5>Human Resources</h5>
                                                        <p>PT Wings Surya</p>
                                                    </div>
                                                    <div>
                                                        <span class="badge bg-label-info me-1 text-end">Seleksi Tahap
                                                            1</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text-left mb-2">
                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut ac risus sem.
                                                    Sed sapien purus, consectetur ac elit non, iaculis bibendum quam. In sed
                                                    risus quis urna molestie interdum in eu quam. Mauris id dolor semper,
                                                    fermentum mi non, consectetur ex. Duis aliquam, tortor ut dictum
                                                    sodales, mauris erat imperdiet lorem, in eleifend purus nisi vitae
                                                    sapien. Suspendisse eget viverra ex. Sed malesuada elit ut magna
                                                    interdum finibus. Nulla volutpat posuere felis, ac tempor turpis
                                                    hendrerit pretium. Duis dictum posuere augue vel aliquet. </p>
                                            </div>
                                        </a>
                                        <hr />
                                        <div class="row mt-2">
                                            <div class="col-12 d-flex justify-content-between">
                                                <div class="col-6">
                                                    <span> <i class="ti ti-map-pin" style="font-size: medium;"></i>
                                                        Jakarta Selatan, Indonesia</span>
                                                    <span> <i class="ti ti-currency-dollar ms-3"
                                                            style="font-size: medium;"></i> Berbayar</span>
                                                    <span> <i class="ti ti-calendar-time ms-3"
                                                            style="font-size: medium;"></i> 2 Semester</span>
                                                    <span> <i class="ti ti-users ms-3" style="font-size: medium;"></i> 5
                                                        Kuota Penerimaan</span>
                                                </div>
                                                <div class="col-6">
                                                    <div class="text-end" style="font-size: medium; color : #4EA971">
                                                        Lamaran terkirim pada 15 juni 2023</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade show" id="navs-pills-justified-penawaran" role="tabpanel">
                                <div class="card mt-2">
                                    <div class="card-body">
                                        <div class="alert alert-danger alert-dismissible" role="alert">
                                            Lakukan konfirmasi penerimaan sebelum tanggal 28 Juli 2023!
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                aria-label="Close"></button>
                                        </div>
                                        <a href="/kegiatan_saya/lamaran_saya/status" style="color:#4B4B4B">
                                            <div class="row mb-2">
                                                <div class="col-2">
                                                    <figure class="image" style="border-radius: 0%;"><img
                                                            style="border-radius: 0%;"
                                                            src="{{ asset('front/assets/img/icon_lowongan.png') }}"
                                                            alt="admin.upload">
                                                    </figure>
                                                </div>
                                                <div class="col-10 d-flex justify-content-between">
                                                    <div>
                                                        <h5>Human Resources</h5>
                                                        <p>PT Wings Surya</p>
                                                    </div>
                                                    <div>
                                                        <span
                                                            class="badge bg-label-secondary me-1 text-end">Penawaran</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text-left mb-2">
                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut ac risus sem.
                                                    Sed sapien purus, consectetur ac elit non, iaculis bibendum quam. In sed
                                                    risus quis urna molestie interdum in eu quam. Mauris id dolor semper,
                                                    fermentum mi non, consectetur ex. Duis aliquam, tortor ut dictum
                                                    sodales, mauris erat imperdiet lorem, in eleifend purus nisi vitae
                                                    sapien. Suspendisse eget viverra ex. Sed malesuada elit ut magna
                                                    interdum finibus. Nulla volutpat posuere felis, ac tempor turpis
                                                    hendrerit pretium. Duis dictum posuere augue vel aliquet. </p>
                                            </div>
                                        </a>
                                        <div class="text-left">
                                            <button type="button" class="btn btn-success waves-effect me-2"
                                                data-bs-toggle="modal" data-bs-target="">Ambil Tawaran
                                            </button>
                                            <button type="button" class="btn btn-danger waves-effect"
                                                data-bs-toggle="modal" data-bs-target="">Tolak Tawaran
                                            </button>
                                        </div>
                                        <hr />
                                        <div class="row mt-2">
                                            <div class="col-12 d-flex justify-content-between">
                                                <div class="col-6">
                                                    <span> <i class="ti ti-map-pin" style="font-size: medium;"></i>
                                                        Jakarta Selatan, Indonesia</span>
                                                    <span> <i class="ti ti-currency-dollar ms-3"
                                                            style="font-size: medium;"></i> Berbayar</span>
                                                    <span> <i class="ti ti-calendar-time ms-3"
                                                            style="font-size: medium;"></i> 2 Semester</span>
                                                    <span> <i class="ti ti-users ms-3" style="font-size: medium;"></i> 5
                                                        Kuota Penerimaan</span>
                                                </div>
                                                <div class="col-6">
                                                    <div class="text-end" style="font-size: medium; color : #4EA971">
                                                        Lamaran terkirim pada 15 juni 2023</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card mt-4">
                                    <div class="card-body">
                                        <div class="alert alert-danger alert-dismissible" role="alert">
                                            Lakukan konfirmasi penerimaan sebelum tanggal 28 Juli 2023!
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                aria-label="Close"></button>
                                        </div>
                                        <a href="/kegiatan_saya/lamaran_saya/status" style="color:#4B4B4B">
                                            <div class="row mb-2">
                                                <div class="col-2">
                                                    <figure class="image" style="border-radius: 0%;"><img
                                                            style="border-radius: 0%;"
                                                            src="{{ asset('front/assets/img/icon_lowongan.png') }}"
                                                            alt="admin.upload">
                                                    </figure>
                                                </div>
                                                <div class="col-10 d-flex justify-content-between">
                                                    <div>
                                                        <h5>Human Resources</h5>
                                                        <p>PT Wings Surya</p>
                                                    </div>
                                                    <div>
                                                        <span
                                                            class="badge bg-label-secondary me-1 text-end">Penawaran</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text-left mb-2">
                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut ac risus sem.
                                                    Sed sapien purus, consectetur ac elit non, iaculis bibendum quam. In sed
                                                    risus quis urna molestie interdum in eu quam. Mauris id dolor semper,
                                                    fermentum mi non, consectetur ex. Duis aliquam, tortor ut dictum
                                                    sodales, mauris erat imperdiet lorem, in eleifend purus nisi vitae
                                                    sapien. Suspendisse eget viverra ex. Sed malesuada elit ut magna
                                                    interdum finibus. Nulla volutpat posuere felis, ac tempor turpis
                                                    hendrerit pretium. Duis dictum posuere augue vel aliquet. </p>
                                            </div>
                                        </a>
                                        <div class="text-left">
                                            <button type="button" class="btn btn-success waves-effect me-2"
                                                data-bs-toggle="modal" data-bs-target="#modalalert">Ambil Tawaran
                                            </button>
                                            <button type="button" class="btn btn-danger waves-effect"
                                                data-bs-toggle="modal" data-bs-target="#modalalertterima">Tolak Tawaran
                                            </button>
                                        </div>
                                        <hr />
                                        <div class="row mt-2">
                                            <div class="col-12 d-flex justify-content-between">
                                                <div class="col-6">
                                                    <span> <i class="ti ti-map-pin" style="font-size: medium;"></i>
                                                        Jakarta Selatan, Indonesia</span>
                                                    <span> <i class="ti ti-currency-dollar ms-3"
                                                            style="font-size: medium;"></i> Berbayar</span>
                                                    <span> <i class="ti ti-calendar-time ms-3"
                                                            style="font-size: medium;"></i> 2 Semester</span>
                                                    <span> <i class="ti ti-users ms-3" style="font-size: medium;"></i> 5
                                                        Kuota Penerimaan</span>
                                                </div>
                                                <div class="col-6">
                                                    <div class="text-end" style="font-size: medium; color : #4EA971">
                                                        Lamaran terkirim pada 15 juni 2023</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade show" id="navs-pills-justified-terima" role="tabpanel">
                                <div class="card mt-2">
                                    <div class="card-body">
                                        <a href="/kegiatan_saya/lamaran_saya/status" style="color:#4B4B4B">
                                            <div class="row mb-2">
                                                <div class="col-2">
                                                    <figure class="image" style="border-radius: 0%;"><img
                                                            style="border-radius: 0%;"
                                                            src="{{ asset('front/assets/img/icon_lowongan.png') }}"
                                                            alt="admin.upload">
                                                    </figure>
                                                </div>
                                                <div class="col-10 d-flex justify-content-between">
                                                    <div>
                                                        <h5>Human Resources</h5>
                                                        <p>PT Wings Surya</p>
                                                    </div>
                                                    <div>
                                                        <span class="badge bg-label-success me-1 text-end">Menerima
                                                            Tawaran</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text-left mb-2">
                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut ac risus sem.
                                                    Sed sapien purus, consectetur ac elit non, iaculis bibendum quam. In sed
                                                    risus quis urna molestie interdum in eu quam. Mauris id dolor semper,
                                                    fermentum mi non, consectetur ex. Duis aliquam, tortor ut dictum
                                                    sodales, mauris erat imperdiet lorem, in eleifend purus nisi vitae
                                                    sapien. Suspendisse eget viverra ex. Sed malesuada elit ut magna
                                                    interdum finibus. Nulla volutpat posuere felis, ac tempor turpis
                                                    hendrerit pretium. Duis dictum posuere augue vel aliquet. </p>
                                            </div>
                                        </a>
                                        <div class="text-left">
                                            <button type="button" class="btn btn-danger waves-effect"
                                                data-bs-toggle="modal" data-bs-target="">Mengundurkan Diri
                                            </button>
                                        </div>
                                        <hr />
                                        <div class="row mt-2">
                                            <div class="col-12 d-flex justify-content-between">
                                                <div class="col-6">
                                                    <span> <i class="ti ti-map-pin" style="font-size: medium;"></i>
                                                        Jakarta Selatan, Indonesia</span>
                                                    <span> <i class="ti ti-currency-dollar ms-3"
                                                            style="font-size: medium;"></i> Berbayar</span>
                                                    <span> <i class="ti ti-calendar-time ms-3"
                                                            style="font-size: medium;"></i> 2 Semester</span>
                                                    <span> <i class="ti ti-users ms-3" style="font-size: medium;"></i> 5
                                                        Kuota Penerimaan</span>
                                                </div>
                                                <div class="col-6">
                                                    <div class="text-end" style="font-size: medium; color : #4EA971">
                                                        Lamaran terkirim pada 15 juni 2023</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade show" id="navs-pills-justified-tolak" role="tabpanel">
                                <div class="card mt-2">
                                    <div class="card-body">
                                        <a href="/kegiatan_saya/lamaran_saya/status" style="color:#4B4B4B">
                                            <div class="row mb-2">
                                                <div class="col-2">
                                                    <figure class="image" style="border-radius: 0%;"><img
                                                            style="border-radius: 0%;"
                                                            src="{{ asset('front/assets/img/icon_lowongan.png') }}"
                                                            alt="admin.upload">
                                                    </figure>
                                                </div>
                                                <div class="col-10 d-flex justify-content-between">
                                                    <div>
                                                        <h5>Human Resources</h5>
                                                        <p>PT Wings Surya</p>
                                                    </div>
                                                    <div>
                                                        <span class="badge bg-label-danger me-1 text-end">Menolak
                                                            Tawaran</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text-left mb-2">
                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut ac risus sem.
                                                    Sed sapien purus, consectetur ac elit non, iaculis bibendum quam. In sed
                                                    risus quis urna molestie interdum in eu quam. Mauris id dolor semper,
                                                    fermentum mi non, consectetur ex. Duis aliquam, tortor ut dictum
                                                    sodales, mauris erat imperdiet lorem, in eleifend purus nisi vitae
                                                    sapien. Suspendisse eget viverra ex. Sed malesuada elit ut magna
                                                    interdum finibus. Nulla volutpat posuere felis, ac tempor turpis
                                                    hendrerit pretium. Duis dictum posuere augue vel aliquet. </p>
                                            </div>
                                        </a>
                                        <hr />
                                        <div class="row mt-2">
                                            <div class="col-12 d-flex justify-content-between">
                                                <div class="col-6">
                                                    <span> <i class="ti ti-map-pin" style="font-size: medium;"></i>
                                                        Jakarta Selatan, Indonesia</span>
                                                    <span> <i class="ti ti-currency-dollar ms-3"
                                                            style="font-size: medium;"></i> Berbayar</span>
                                                    <span> <i class="ti ti-calendar-time ms-3"
                                                            style="font-size: medium;"></i> 2 Semester</span>
                                                    <span> <i class="ti ti-users ms-3" style="font-size: medium;"></i> 5
                                                        Kuota Penerimaan</span>
                                                </div>
                                                <div class="col-6">
                                                    <div class="text-end" style="font-size: medium; color : #4EA971">
                                                        Lamaran terkirim pada 15 juni 2023</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- /Magang Fakultas -->

                <!-- Magang Mandiri -->
                <div class="tab-pane fade show active" id="navs-pills-justified-magang-fakultas" role="tabpanel">
                    <div class="row mt-2" style="padding-left: 12px;">
                        <ul class="nav nav-pills mb-3 " role="tablist">

                            <li class="nav-item" style="font-size: 15px;">
                                <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                                    data-bs-target="#navs-pills-justified-magang-mandiri"
                                    aria-controls="navs-pills-justified-magang-mandiri" aria-selected="false">
                                    <i class="ti ti-presentation-analytics pe-1"></i> Proses Seleksi
                                </button>
                            </li>
                            <li class="nav-item" style="font-size: 15px;">
                                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                                    data-bs-target="#navs-pills-terima-magang-mandiri"
                                    aria-controls="navs-pills-terima-magang-mandiri" aria-selected="false">
                                    <i class="ti ti-clipboard-check pe-1"></i> Terima Tawaran
                                </button>
                            </li>
                            <li class="nav-item" style="font-size: 15px;">
                                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                                    data-bs-target="#navs-pills-justified-tolak"
                                    aria-controls="navs-pills-justified-tolak" aria-selected="false">
                                    <i class="ti ti-clipboard-x pe-1"></i> Tolak Tawaran
                                </button>
                            </li>
                        </ul>

                        <div class="tab-pane fade show" id="navs-pills-justified-magang-mandiri" role="tabpanel">
                            <div class="card mt-2">
                                @foreach ($mandiri as $item)
                                    @if ($item->nim == $nim)
                                        <div class="card-body">
                                            <div class="alert alert-danger alert-dismissible" role="alert">
                                                Lakukan konfirmasi penerimaan segera!
                                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="row">
                                                <div class="ps-4">
                                                    <h4>{{ $item->posisi_magang }}</h4>
                                                    <p>{{ $item->nama_industri }}</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                    <span class="border-end pe-2 me-2"><i class="tf-icons ti ti-map-pin"
                                                            style="font-size: 18px;"></i>
                                                        {{ $item->alamat_industri }}</span>
                                                </div>
                                                <div class="col-2">
                                                    <span class="border-end pe-2 me-2"><i
                                                            class="tf-icons ti ti-phone-call pe-1"
                                                            style="font-size: 18px;"></i>{{ $item->nohp }}</span>
                                                </div>
                                                <div class="col-2">
                                                    <span><i class="tf-icons ti ti-mail pe-1"
                                                            style="font-size: 18px;"></i>{{ $item->email }}</span>
                                                </div>
                                            </div>
                                            <div class="text-left mt-3">
                                                <button type="button" class="btn btn-success waves-effect me-2"
                                                    data-id="{{ $item->id_pengajuan }}"
                                                    onclick="terima($(this))">Diterima
                                                </button>
                                                <button type="button" class="btn btn-danger waves-effect"
                                                    data-bs-toggle="modal" data-bs-target="#modalDitolak">Ditolak
                                                </button>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endsection

        @section(' page_script')
            <script>
                
                function terima(e) {
                    let id = e.attr('data-id');
                    let action = `{{ url('kegiatan-saya/lamaran-saya/update/') }}/${id}`;
                    var url = `{{ url('kegiatan-saya/lamaran-saya/edit/') }}/${id}`;
                    $.ajax({
                        type: 'GET',
                        url: url,
                        success: function(response) {
                            console.log(response);
                            $('#modalDiterima form').attr('action', action);
                            $('#tglpeng_').val(response.tglpeng).trigger('change');
                            $('#nama_industri').val(response.nama_industri);
                            $('#posisi_magang').val(response.posisi_magang);
                            $('#date_').val(response.startdate).trigger('change');
                            $('#date').val(response.enddate).trigger('change');

                            $('#modalDiterima').modal('show');
                        }
                    });
                }
            </script>
            <script src="{{ asset('app-assets/vendor/libs/sweetalert2/sweetalert2.js') }}"></script>
            <script src="{{ asset('app-assets/js/extended-ui-sweetalert2.js') }}"></script>
        @endsection
