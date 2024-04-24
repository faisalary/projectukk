@extends('partials_mahasiswa.template')

@section('page_style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
    .hidden {
        display: none;
    }

    .page-item.active .page-link,
    .pagination li.active>a:not(.page-link) {
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

    .light-style .select2-container--default .select2-selection--single {
        width: 530px;
    }

    .light-style .select2-container--default .select2-selection {
        border-left: 0px;
        border-top-left-radius: 0px;
        border-bottom-left-radius: 0px;
    }

    .layout-wrapper,
    .layout-container {
        width: 100%;
        display: flex;
        flex: 1 1 auto;
        align-items: stretch;
        background-color: #fff;
    }

    input[type="checkbox"]:focus {
        outline: 0px auto -webkit-focus-ring-color;
        outline-offset: -2px;
    }

    .form-check-input:checked,
    .form-check-input[type=checkbox]:indeterminate {
        background-color: #4EA971 !important;
        border-color: #4EA971 !important;
    }

    .light-style .flatpickr-input[readonly],
    .light-style .flatpickr-input~.form-control[readonly] {
        background: #F8F8F8
    }

    .select2-results__option[role="option"][aria-selected="true"] {
        background-color: #4EA971;
        color: #fff;
    }

    .select2-container--default .select2-results__option--highlighted:not([aria-selected="true"]) {
        background-color: rgba(115, 103, 240, 0.08) !important;
        color: #4EA971 !important;
    }

    .light-style .select2-container--default .select2-selection--single {
        height: 48px !important;
    }

    .light-style .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 2.67rem !important;
    }

    span.select2-dropdown.select2-dropdown--below {
        width: 530px !important;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow b {
        position: absolute;
        height: 18px;
        width: 20px;
        top: 36% !important;
        background-repeat: no-repeat;
        background-size: 20px 18px;
        margin-left: 307px !important;
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
        border-left: 0;
    }

    span.select2-selection.select2-selection--single {
        border-top: 10px !important;
        border-bottom: 10px !important;
        border-right: 10px !important;
    }

    .light-style .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 3.2rem !important;
    }
</style>
@endsection

@section('main')

<div class="auto-container" style="background-color: #F8F8F8;background-repeat: no-repeat; background-size: cover; background-image: url({{asset('assets/images/background.png')}});">
    <div class="row mt-5 mb-3" style="margin-left:70px;">
        <div class="col-5 mt-3">
            <div class="input-group input-group-merge border">
                <span class="input-group-text" id="basic-addon-search31"><i class="ti ti-search"></i></span>
                <input type="text" class="form-control" placeholder="Lowongan Magang" aria-label="Lowongan Magang" aria-describedby="basic-addon-search31" style="height: 37px;">
            </div>
        </div>
        <div class="col-5 mt-3">
            <div class="input-group input-group-merge border">
                <span class="input-group-text" id="basic-addon-search31"><i class="ti ti-map-pin"></i></span>
                <select class="select2 form-control" data-placeholder="Pilih lokasi Magang" aria-describedby="basic-addon-search31">
                    <option disabled selected> Lokasi Magang </option>
                    <option> Bandung </option>
                    <option> Jakarta </option>
                    <option> Medan </option>
                    <option> Surabaya </option>
                    <option> Yogyakarta </option>
                </select>
            </div>
        </div>
        <div class="col-2 mt-3">
            <button class="btn btn-success" type="button" style="height: 50px;">Cari sekarang
                <!-- <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                Loading... -->
            </button>
        </div>
    </div>
    <div class="row mt-4 mb-3">
        <div class="col-1 ms-5"></div>
        <div class="col-2">
            <p class="flatpickr-input" id="flatpickr-range">Tanggal Posting <i class=" ti ti-chevron-down" style="font-size: 15px;"></i></p>
        </div>
        <div class="col-2">
            <div class="dropdown cursor-pointer">
                <a class="dropdown-toogle" data-bs-toggle="dropdown" aria-expanded="false">
                    Perusahaan
                    <!-- <span class="badge badge-center rounded-pill bg-success">3</span> -->
                    <i class="ti ti-chevron-down pb-1" style="font-size: medium;"></i>
                </a>
                <ul class="dropdown-menu checkbox-menu allow-focus" aria-labelledby="dropdownMenu1" style="min-width: 230px !important;">

                    <li class="mb-2 ps-2 pe-3">
                        <input class="form-check-input" type="checkbox" style="margin-top: 0px; margin-right:3px" style="margin-top: 0px; margin-right:3px"> PT Techno Infinity
                    </li>

                    <li class="mb-2 ps-2 pe-3">
                        <input class="form-check-input" type="checkbox" style="margin-top: 0px; margin-right:3px"> Direktorat PUTI Tel-U
                    </li>

                    <li class="mb-2 ps-2 pe-3">
                        <input class="form-check-input" type="checkbox" style="margin-top: 0px; margin-right:3px"> PT Telkom Indonesia
                    </li>

                    <li class="mb-2 ps-2 pe-3">
                        <input class="form-check-input" type="checkbox" style="margin-top: 0px; margin-right:3px"> PT Inovasi Daya Solusi
                    </li>

                    <li class="mb-2 ps-2 pe-3">
                        <input class="form-check-input" type="checkbox" style="margin-top: 0px; margin-right:3px"> PT Indo Trans Teknologi
                    </li>

                    <li class="mb-2 ps-2 pe-3">
                        <input class="form-check-input" type="checkbox" style="margin-top: 0px; margin-right:3px"> Direktorat PUTI Tel-U
                    </li>

                    <li class="mb-2 ps-2 pe-3">
                        <input class="form-check-input" type="checkbox" style="margin-top: 0px; margin-right:3px"> Fakultas Ilmu Terapan
                    </li>
                    <hr>
                    <div class=" d-flex justify-content-between ms-2 me-2">
                        <button class="btn btn-outline-danger" type="submit">Reset</button>
                        <button class="btn btn-success" type="submit">Terapkan</button>
                    </div>
                </ul>
            </div>
        </div>
        <div class="col-2">
            <div class="dropdown cursor-pointer">
                <a class="dropdown-toogle" data-bs-toggle="dropdown" aria-expanded="false">
                    Uang Saku
                    <i class="ti ti-chevron-down pb-1" style="font-size: medium;"></i>
                </a>
                <ul class="dropdown-menu checkbox-menu allow-focus" aria-labelledby="dropdownMenu1" style="min-width: 250px !important;">
                    <div class="form-check mb-2 ms-2">
                        <input name="paymentType" class="form-check-input" type="radio" value="tidakBerbayar" id="tidakBerbayarRadio" onclick="toggleDivVisibility(this)">
                        <label class="form-check-label" for="tidakBerbayarRadio"> Tidak Berbayar </label>
                    </div>

                    <div class="form-check mb-2 ms-2">
                        <input name="paymentType" class="form-check-input" type="radio" value="berbayar" id="berbayarRadio" onclick="toggleDivVisibility(this)">
                        <label class="form-check-label" for="berbayarRadio"> Berbayar </label>
                    </div>

                    <div id="myDIV" style="display: none;">
                        <div class="ms-2 me-3">
                            <div class="input-group border">
                                <span class="input-group-text" id="basic-addon11">IDR</span>
                                <input type="text" class="form-control" placeholder="Masukkan minimal nominal" aria-label="Masukkan minimal nominal" aria-describedby="basic-addon11" style="width: 150px !important;">
                            </div>
                        </div>
                    </div>

                    <hr>
                    <div class=" d-flex justify-content-between ms-2 me-2">
                        <button class="btn btn-outline-danger" type="submit">Reset</button>
                        <button class="btn btn-success" type="submit">Terapkan</button>
                    </div>
                </ul>
            </div>
        </div>
        <div class="col-2">
            <div class="dropdown cursor-pointer">
                <a class="dropdown-toogle" data-bs-toggle="dropdown" aria-expanded="false">
                    Durasi Magang
                    <!-- <span class="badge badge-center rounded-pill bg-success">2</span> -->
                    <i class="ti ti-chevron-down pb-1" style="font-size: medium;"></i>
                </a>
                <ul class="dropdown-menu checkbox-menu allow-focus" aria-labelledby="dropdownMenu1" style="min-width: 230px !important;">
                    <li class="mb-2 ps-2 pe-5">
                        <input class="form-check-input" type="checkbox" style="margin-top: 0px; margin-right:3px">Magang 1 Semester
                    </li>

                    <li class="mb-2 ps-2 pe-5">
                        <input class="form-check-input" type="checkbox" style="margin-top: 0px; margin-right:3px">Magang 2 Semester
                    </li>
                    <hr>
                    <div class=" d-flex justify-content-between ms-2 me-2">
                        <button class="btn btn-outline-danger" type="submit">Reset</button>
                        <button class="btn btn-success" type="submit">Terapkan</button>
                    </div>
                </ul>
            </div>
        </div>
        <div class="col-2">
            <div class="dropdown cursor-pointer">
                <a class="dropdown-toogle" data-bs-toggle="dropdown" aria-expanded="false">
                    Pelaksanaan
                    <!-- <span class="badge badge-center rounded-pill bg-success">2</span> -->
                    <i class="ti ti-chevron-down pb-1" style="font-size: medium;"></i>
                </a>
                <ul class="dropdown-menu checkbox-menu allow-focus" aria-labelledby="dropdownMenu1" style="min-width: 230px !important;">
                    <li class="mb-2 ps-2 pe-5">
                        <input class="form-check-input" type="checkbox" style="margin-top: 0px; margin-right:3px"> Onsite
                    </li>

                    <li class="mb-2 ps-2 pe-5">
                        <input class="form-check-input" type="checkbox" style="margin-top: 0px; margin-right:3px"> Hybrid
                    </li>
                    <li class="mb-2 ps-2 pe-5">
                        <input class="form-check-input" type="checkbox" style="margin-top: 0px; margin-right:3px"> Online
                    </li>
                    <hr>
                    <div class=" d-flex justify-content-between ms-2 me-2">
                        <button class="btn btn-outline-danger" type="submit">Reset</button>
                        <button class="btn btn-success" type="submit">Terapkan</button>
                    </div>
                </ul>
            </div>
        </div>
        <div class="col-1"></div>
    </div>
</div>

{{-- Lowongn tidak ditemukan --}}
<!-- <div class="col-3 mt-5">
    <img class="image" style="border-radius: 0%; margin-left:465px;" src="{{ asset('front/assets/img/nodata.png')}}" alt="admin.upload">
</div>
<div class="sec-title mt-5 mb-4 text-center">
    <h4> Maaf, lowongan tidak di temukan</h4>
    <p> Silakan coba sesuaikan filter atau periksa kembali penulisan Anda</p>
</div> -->

<div class="container-xxl flex-grow-1 container-p-y">
    {{-- <h4 class="ms-4">{{ $lowongan->count() }} Lowongan Magang Fakultas</h4> --}}
    @php
    $jumlahDiterima = $lowongan->where('statusaprove', 'diterima')->count();
    @endphp
    <h4 class="ms-4">{{ $jumlahDiterima }} Lowongan Magang Fakultas</h4>

    <div class="row mt-2 ps-4">
        <div class="col-5">
            <div class="row">
                @foreach($lowongan as $l)
                @if($l->statusaprove == 'diterima')
                <div class="col-12 mt-3 mb-2">
                    <div class="card border" style="width: 530px">
                        <div class="card-body">
                            <div class="row card-header" style="background-color: #FFFFFF; padding:0px;">
                                <div class="col-3 text-left">
                                    <figure class="image" style="border-radius: 0%;">
                                        {{-- <img style="border-radius: 0%;" src="{{ asset('front/assets/img/icon_lowongan.png')}}" alt="admin.upload"> --}}
                                        @if ($l->industri->image)
                                        <img src="{{ asset('storage/' . $l->industri->image) }}" alt="user-avatar"
                                            class="" height="125" width="125"
                                            id="imgPreview">
                                        @else
                                            <img src="../../app-assets/img/avatars/14.png" alt="user-avatar"
                                                class="" height="125" width="125"
                                                id="imgPreview" data-default-src="../../app-assets/img/avatars/14.png">
                                        @endif
                                    </figure>
                                </div>
                                <div class="col-6 ms-3">
                                    <h5 class="mb-1" style="text-align: left !important; font-size: 20px; -webkit-line-clamp: 2;text-overflow: ellipsis; overflow: hidden; display: -webkit-box; -webkit-box-orient: vertical; word-break: break-word;">
                                        {{$l->intern_position ?? ''}}
                                    </h5>
                                    <p style="text-align: left !important; font-size:15px; margin-bottom: 0px;">
                                        {{$l->industri->namaindustri ?? ''}}
                                    </p>
                                </div>
                                <div class="col-2 ms-3">
                                    <i onclick="myFunction(this)" class="fa fa-bookmark-o ms-4" style="font-size: 40px;color:#4EA971;"></i>
                                </div>
                            </div>
                            <div class="border"></div>
                            <div class="map-pin mt-3 mb-3">
                                <i class="ti ti-map-pin" style="margin-right: 10px;margin-bottom:5px;"></i>
                                {{$l->lokasi ?? ''}}
                            </div>
                            <div class="currency-dollar mb-3" style="margin-left: -1px; margin-right: 10px">
                                <i class="ti ti-currency-dollar" style="margin-right: 10px;margin-bottom:5px;"></i>
                                {{$l->nominal_salary ?? 'Tidak Berbayar'}}
                            </div>
                            <div class="briefcase mb-3" style="margin-left: 1px;">
                                <i class="ti ti-calendar-time" style="margin-right: 10px;margin-bottom:5px;"></i>
                                {{$l->durasimagang ?? ''}}
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="location" style="margin-left: 2px;">
                                        <i class="ti ti-users" style="margin-right: 10px;margin-bottom:5px;"></i>
                                        {{$l->kuota ?? ''}} Kuota Penerimaan
                                    </div>
                                </div>
                                <div class="col-6 d-flex justify-content-end" style="padding: 0px; margin-left: -10px;">
                                    <div class="location"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @endforeach
            </div>

            <div class="row mt-3 mb-2">
                <nav aria-label="Page navigation">
                    <ul class="pagination" style="margin-left: 130px; color:black">
                        <li class="page-item ">
                            <a class="page-link waves-effect" href="javascript:void(0);">Previous</a>
                        </li>
                        <li class="page-item active">
                            <a class="page-link waves-effect" href="javascript:void(0);">1</a>
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
            </div>
        </div>

        <div class="col-7">

            {{-- Ada lowongan terpilih--}}
            <!-- <div class="row">
                <div class="col-12 mt-3 mb-2">
                    <div class="card border" style="width: 765px; height: auto;">
                        <div class="card-body">
                            <div class="row card-header" style="background-color: #FFFFFF; padding:0px;">
                                <div class="d-flex justify-content-between mb-3">
                                    <figure class="image" style="border-radius: 0%; margin-left: 10px;"><img style="width:180px;" src="{{ asset('front/assets/img/icon_lowongan.png') }}" alt="admin.upload">
                                    </figure>
                                    <div style="margin-left: 250px;">
                                        <small class="text-muted" style="font-size: 18px;">Batas Melamar 13 Juli
                                            2023</small><br>
                                        <div class="row mt-2">
                                            <a href="/detail/lowongan/magang"><button type="button" class="btn btn-sm btn-outline-dark waves-effect" style="width: 200px; margin-left:15px;">Buka dihalaman baru</button>
                                            </a><br>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-2 mb-2 ms-1 p-0">
                                    <h4 style=" margin-bottom: 0px; ">PT
                                        Wings Surya</h4>
                                    <h1 class="mb-1" style="  text-overflow: ellipsis; overflow: hidden; display: -webkit-box; -webkit-box-orient: vertical; word-break: break-word;">
                                        Human Resources</h1>
                                </div>
                                <div class="d-flex ms-2 mt-2" style="font-size: 14px;">
                                    <ul style="border-right: 1px solid #D3D6DB; padding: 0 20px 0 0;">
                                        <li class="d-flex align-items-center fw-semibold" style="margin-top: 15px !important">
                                            <i class="ti ti-users ti-xs me-2"></i>
                                            5 Kouta Penerimaan
                                        </li>
                                        <li class=" d-flex align-items-center fw-semibold" style="margin-top: 15px !important">
                                            <i class="ti ti-briefcase ti-xs me-2"></i>
                                            Onsite
                                        </li>
                                        <li class=" d-flex align-items-center fw-semibold" style="margin-top: 15px !important">
                                            <i class="ti ti-calendar-time  ti-xs me-2"></i>
                                            2 Semerter
                                        </li>
                                    </ul>
                                    <ul style="border-right: 1px solid #D3D6DB; padding: 0 20px 0 20px;">

                                        <li class=" d-flex align-items-center fw-semibold" style="margin-top: 15px !important">
                                            <i class="ti ti-map-pin  ti-xs me-2"></i>
                                            Bandung & Jakarta
                                        </li>
                                        <li class=" d-flex align-items-center fw-semibold" style="margin-top: 15px !important">
                                            <i class="ti ti-currency-dollar  ti-xs me-2"></i>
                                            Rp 1.000.000 - 5.000.000
                                        </li>
                                        <li class="d-flex align-items-center fw-semibold" style="margin-top: 15px !important">
                                            <i class="ti ti-building-community  ti-xs me-2"></i>
                                            D3
                                        </li>
                                    </ul>
                                    <ul style="padding: 0 0 0 20px;">
                                        <li class="list-group-item d-flex align-items-start fw-semibold" style="margin-top: 15px !important">
                                            <i class="ti ti-school ti-xs me-2"></i>
                                            <div>
                                                Program Studi
                                                <ul style="list-style-type: disc; padding-left: 20px; margin-top: 5px;">
                                                    <li>Rekayasa Perangkat Lunak</li>
                                                    <li>Manajemen Pemasaran</li>
                                                    <li>Sistem Informasi</li>
                                                </ul>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <a href="/apply" type="submit" class="btn btn-success ms-4" style="height:50px; width:695px; border-radius:8px;">Lamar Lowongan</a>
                            </div>

                            <div class="row mt-3 p-2" style="border-bottom: 1px solid #D3D6DB;">
                                <h3>
                                    Deskripsi Pekerjaan
                                </h3>
                                <div class="text-block row" style="column-gap: 20px; padding-bottom: 25px !important">
                                    <ul style="margin-left: 20px; margin-bottom:0;">
                                        <li class="cursor-pointer content" style="text-align: left !important; font-size:17px; margin-bottom: 0px;">
                                            Manage Talent Acquisition activities for Desk Worker and Non-Desk Worker.
                                        </li>

                                        <li class="cursor-pointer content" style="text-align: left !important; font-size:17px; margin-bottom: 0px;">
                                            Lead HR Internal Communication and Employer Branding.
                                        </li>

                                        <li class="cursor-pointer content" style="text-align: left !important; font-size:17px; margin-bottom: 0px;">
                                            Manage On-Boarding program for new hire.
                                        </li>

                                        <li class="cursor-pointer content" style="text-align: left !important; font-size:17px; margin-bottom: 0px;">
                                            Support employee Performance Evaluation process.
                                        </li>

                                        <li class="cursor-pointer content" style="text-align: left !important; font-size:17px; margin-bottom: 0px;">
                                            Support Talent Management and Succession Planning function.
                                        </li>
                                        <span class="content-new" style="display: none;">
                                            <li class="cursor-pointer content" style="text-align: left !important; font-size:17px; margin-bottom: 0px;">
                                                Conduct HR People Analytic such as headcount, labor-cost, hours-work, etc. </li>

                                            <li class="cursor-pointer content" style="text-align: left !important; font-size:17px; margin-bottom: 0px;">
                                                Lead Employee Engagement activities and events. </li>

                                            <li class="cursor-pointer content" style="text-align: left !important; font-size:17px; margin-bottom: 0px;">
                                                Liaise with relevant parties to ensure HR function executed smoothly. </li>

                                            <li class="cursor-pointer content" style="text-align: left !important; font-size:17px; margin-bottom: 0px;">
                                                Support other HR Indonesia operations activities. </li>
                                        </span>
                                        <span class="show_hide_new cursor-pointer" style="color:#4EA971">Show More</span>
                                    </ul>
                                </div>
                            </div>

                            <div class="row mt-3 ps-2" style="border-bottom: 1px solid #D3D6DB;">
                                <h3>
                                    Requirement
                                </h3>
                                <div class=" text-block row" style="column-gap: 20px; padding-bottom: 23px !important">
                                    <ul style="margin-left: 20px; margin-bottom:0;">
                                        <li class="cursor-pointer content" style="text-align: left !important; font-size:17px; margin-bottom: 0px;">
                                            At least Bachelor's degree in any field.
                                        </li>
                                        <li class="cursor-pointer content" style="text-align: left !important; font-size:17px; margin-bottom: 0px;">
                                            At least 3 years of experience in HR / HRBP.
                                        </li>
                                        <li class="cursor-pointer content" style="text-align: left !important; font-size:17px; margin-bottom: 0px;">
                                            Has strong numerical capability and excel expertise.
                                        </li>
                                        <li class="cursor-pointer content" style="text-align: left !important; font-size:17px; margin-bottom: 0px;">
                                            Has experience using Workday will be an advantage.
                                        </li>
                                        <li class="cursor-pointer content" style="text-align: left !important; font-size:17px; margin-bottom: 0px;">
                                            Good command of spoken and written English.
                                        </li>
                                        <span class="content-new" style="display: none;">
                                            <li class="cursor-pointer content" style="text-align: left !important; font-size:17px; margin-bottom: 0px;">
                                                Strong attention to detail. </li>

                                            <li class="cursor-pointer content" style="text-align: left !important; font-size:17px; margin-bottom: 0px;">
                                                Self-motivated and able to work without supervision. </li>

                                            <li class="cursor-pointer content" style="text-align: left !important; font-size:17px; margin-bottom: 0px;">
                                                Willing to work in Cikampek area. </li>
                                        </span>
                                        <span class="show_hide_new cursor-pointer" style="color:#4EA971">Show More</span>
                                    </ul>
                                </div>
                            </div>

                            <div class="row mt-3 ps-2" style="border-bottom: 1px solid #D3D6DB;">
                                <h3>
                                    Benefit
                                </h3>
                                <div class="row" style="column-gap: 20px; padding-bottom: 30px !important">
                                    <ul style="margin-left: 20px; margin-bottom:0;">
                                        <li class="cursor-pointer content" style="text-align: left !important; font-size:17px; margin-bottom: 0px;">
                                            Family Care.
                                        </li>
                                        <li class="cursor-pointer content" style="text-align: left !important; font-size:17px; margin-bottom: 0px;">
                                            Parking Access.
                                        </li>
                                        <li class="cursor-pointer content" style="text-align: left !important; font-size:17px; margin-bottom: 0px;">
                                            Reward Compensation.
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="row mt-3 ps-2" style="border-bottom: 1px solid #D3D6DB;">
                                <h3>
                                    Kemampuan
                                </h3>
                                <div class="row">
                                    <div class="d-flex" style="column-gap: 20px; padding-bottom: 30px !important">
                                        <span class="badge rounded-pill bg-success bg-glow" style="font-size: 15px;">SPSS</span>
                                        <span class="badge rounded-pill bg-success bg-glow" style="font-size: 15px;">Microsoft Office</span>
                                        <span class="badge rounded-pill bg-success bg-glow" style="font-size: 15px;">Google Suite</span>
                                        <span class="badge rounded-pill bg-success bg-glow" style="font-size: 15px;">Counseling Tools</span>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-3">
                                <h3>Seleksi Tahap 1</h3>
                                <div class="mb-3" style="font-size: 15px;"><i class="ti ti-clipboard-list" style="font-size: x-large;"></i>Seleksi Administrasi</div>
                                <div style="font-size: 15px;"><i class="ti ti-clipboard-list" style="font-size: x-large;"></i>Range Tanggal Pelaksanaan: 18/10/2023 - 20/10/2023</div>
                            </div>

                            <div class="mt-3">
                                <h3>Seleksi Tahap 2</h3>
                                <div class="mb-3" style="font-size: 15px;"><i class="ti ti-clipboard-list" style="font-size: x-large;"></i>Wawancara HR</div>
                                <div style="font-size: 15px;"><i class="ti ti-clipboard-list" style="font-size: x-large;"></i>Range Tanggal Pelaksanaan: 18/10/2023 - 20/10/2023</div>
                            </div>

                            <div class="mt-3" style="border-bottom: 1px solid #D3D6DB;">
                                <h3>Seleksi Tahap 3</h3>
                                <div class="mb-3" style="font-size: 15px;"><i class="ti ti-clipboard-list" style="font-size: x-large;"></i>Wawancara User</div>
                                <div class="mb-4" style="font-size: 15px;"><i class="ti ti-clipboard-list" style="font-size: x-large;"></i>Range Tanggal Pelaksanaan: 18/10/2023 - 20/10/2023</div>
                            </div>

                            <div class="row mt-3">
                                <h3>
                                    Tentang Perusahaan
                                </h3>
                            </div>
                            <div class="row mb-2">
                                <div class="text-block">
                                    <p class="mb-2">
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque iaculis lacinia erat in auctor. In venenatis nisl vel nisl laoreet, in feugiat nibh tincidunt. Donec fermentum interdum nunc, ac viverra tellus molestie in. Suspendisse blandit maximus mauris, vitae pharetra risus gravida eu. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque iaculis lacinia erat in auctor. In venenatis nisl vel nisl laoreet, in feugiat nibh tincidunt. Donec fermentum interdum nunc, ac viverra tellus molestie in.
                                        <span class="ellipsis">...</span>
                                        <span class="content-new" style="display: none;"> Suspendisse blandit maximus mauris, vitae pharetra risus gravida eu. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque iaculis lacinia erat in auctor. In venenatis nisl vel nisl laoreet, in feugiat nibh tincidunt. Donec fermentum interdum nunc, ac viverra tellus molestie in.</span>
                                        <a class="show_hide_new cursor-pointer" style="color:#4EA971">Show More</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
            {{-- Belum ada lowongan terpilih--}}
            <div class="border text-center mt-3" style="border-radius: 8px;">
                <figure class="m-5">
                    <img class="image" src="{{ asset('front/assets/img/amico.png')}}" alt="admin.upload">
                </figure>
                <h5>Belum ada lowongan terpilih</h5>
                <p>Silahkan pilih lowongan yang tersedia untuk mendapatkan detail informasi</p>
            </div>
        </div>
    </div>
</div>


@endsection

@section('page_script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.js"></script>

<script>
    $(".checkbox-menu").on("change", "input[type='checkbox']", function() {
        $(this).closest("li").toggleClass("active", this.checked);
    });

    $(document).on('click', '.allow-focus', function(e) {
        e.stopPropagation();
    });

    function toggleDivVisibility(radio) {
        var x = document.getElementById("myDIV");
        if (radio.value === "berbayar") {
            x.style.display = "block";
        } else {
            x.style.display = "none";
        }
    }


    function myFunction(x) {
        x.classList.toggle("fa-bookmark-o");
        x.classList.toggle("fa-bookmark");
    }
</script>
@endsection