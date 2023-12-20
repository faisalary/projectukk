@extends('partials_admin.template')

@section('page_style')
    <link rel="stylesheet" href="../../app-assets/vendor/libs/sweetalert2/sweetalert2.css" />
    <style>
        .swal2-icon {
            border-color: transparent !important;
        }

        .swal2-title {
            font-size: 20px !important;
            text-align: center !important;
            margin-top: 0px !important;
            margin-bottom: 0px !important;
        }

        .swal2-modal.swal2-popup .swal2-title {
            max-width: 100% !important;
        }

        .swal2-html-container {
            font-size: 16px !important;
        }

        a:hover {
            color: #6F6B7D !important;
        }
    </style>
@endsection

@section('main')
    <div class="row">
        <div class="col-md-9 col-12">
            <h4 class="fw-bold">Jadwal Seleksi</h4>
        </div>
        <div class="col-md-3 col-12 mb-3 float-end d-flex justify-content-end">
            <select class="select2 form-select" data-placeholder="Pilih Tahun Ajaran" style="width: 95% !important;">
                <option value="1">2023/2024 Genap</option>
                <option value="2">2023/2024 Ganjil</option>
                <option value="3">2022/2023 Genap</option>
                <option value="4">2022/2023 Ganjil</option>
                <option value="5">2021/2022 Genap</option>
                <option value="6">2021/2022 Ganjil</option>
            </select>
        </div>
    </div>

    <div class="row mt-2">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mt-4">
                        <div class="col-sm-12 col-md-6">
                            <div class="d-flex align-items-center justify-content-start">
                                <span>Show</span>
                                <select class="form-select mx-2" style="width: 14%;">
                                    <option value="10">10</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                </select>
                                <span>entries</span>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="d-flex align-items-center justify-content-end">
                                <span>Search:</span>
                                <input type="search" class="form-control ms-2" placeholder="Search" style="width: 50%;">
                            </div>
                        </div>
                    </div>

                    <div class="card mt-4">
                        <a href="/seleksi/lanjutan/jadwal" style="hover:" class="card-body">
                            <div class="row">
                                <div class="col-2">
                                    <figure class="image" style="border-radius: 0%;"><img style="border-radius: 0%;"
                                            src="{{ asset('front/assets/img/icon_lowongan.png') }}" alt="admin.upload">
                                    </figure>
                                </div>
                                <div class="col-10 d-flex justify-content-between">
                                    <div>
                                        <h5>UI/UX Designer</h5>
                                        <p>IT-Computer - Software</p>
                                    </div>
                                    <div>
                                        <span class="badge bg-label-success me-1 text-end">Aktif</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row gy-3 mt-3">
                                <div class="col-md-2 col-6">
                                    <div class="d-flex align-items-center">
                                        <div class="badge rounded-pill bg-label-success me-3 p-2">
                                            <i class="ti ti-users ti-sm"></i>
                                        </div>
                                        <div class="card-info">
                                            <small>Total Pelamar</small>
                                            <h5 class="mb-0">0</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2 col-6">
                                    <div class="d-flex align-items-center">
                                        <div class="badge rounded-pill bg-label-success me-3 p-2">
                                            <i class="ti ti-file-report ti-sm"></i>
                                        </div>
                                        <div class="card-info">
                                            <small>Seleksi Tahap 1</small>
                                            <h5 class="mb-0">0</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2 col-6">
                                    <div class="d-flex align-items-center">
                                        <div class="badge rounded-pill bg-label-success me-3 p-2">
                                            <i class="ti ti-file-report ti-sm"></i>
                                        </div>
                                        <div class="card-info">
                                            <small>Seleksi Tahap 2</small>
                                            <h5 class="mb-0">0</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2 col-6">
                                    <div class="d-flex align-items-center">
                                        <div class="badge rounded-pill bg-label-success me-3 p-2">
                                            <i class="ti ti-file-report ti-sm"></i>
                                        </div>
                                        <div class="card-info">
                                            <small>Seleksi Tahap 3</small>
                                            <h5 class="mb-0">0</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr />
                            <div class="row mt-2">
                                <div class="col-12 d-flex justify-content-between">
                                    <div class="col-6">
                                        <div class="tf-icons ti ti-calendar" style="font-size: medium; margin-right:10px;">
                                            30 Juli 2023 - 30 Juni 2024</div>
                                        <div class="tf-icons ti ti-users" style="font-size: medium;"> Kuota Penerimaan : 50
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="card mt-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-2">
                                    <figure class="image" style="border-radius: 0%;"><img style="border-radius: 0%;"
                                            src="{{ asset('front/assets/img/icon_lowongan.png') }}" alt="admin.upload">
                                    </figure>
                                </div>
                                <div class="col-10 d-flex justify-content-between">
                                    <div>
                                        <h5>Fullstack Developer</h5>
                                        <p>IT-Computer - Software</p>
                                    </div>
                                    <div>
                                        <span class="badge bg-label-success me-1 text-end">Aktif</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row gy-3 mt-3">
                                <div class="col-md-2 col-6">
                                    <div class="d-flex align-items-center">
                                        <div class="badge rounded-pill bg-label-success me-3 p-2">
                                            <i class="ti ti-users ti-sm"></i>
                                        </div>
                                        <div class="card-info">
                                            <small>Total Pelamar</small>
                                            <h5 class="mb-0">0</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2 col-6">
                                    <div class="d-flex align-items-center">
                                        <div class="badge rounded-pill bg-label-success me-3 p-2">
                                            <i class="ti ti-file-report ti-sm"></i>
                                        </div>
                                        <div class="card-info">
                                            <small>Seleksi Tahap 1</small>
                                            <h5 class="mb-0">0</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2 col-6">
                                    <div class="d-flex align-items-center">
                                        <div class="badge rounded-pill bg-label-success me-3 p-2">
                                            <i class="ti ti-file-report ti-sm"></i>
                                        </div>
                                        <div class="card-info">
                                            <small>Seleksi Tahap 2</small>
                                            <h5 class="mb-0">0</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2 col-6">
                                    <div class="d-flex align-items-center">
                                        <div class="badge rounded-pill bg-label-success me-3 p-2">
                                            <i class="ti ti-file-report ti-sm"></i>
                                        </div>
                                        <div class="card-info">
                                            <small>Seleksi Tahap 3</small>
                                            <h5 class="mb-0">0</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr />
                            <div class="row mt-2">
                                <div class="col-12 d-flex justify-content-between">
                                    <div class="col-6">
                                        <div class="tf-icons ti ti-calendar"
                                            style="font-size: medium; margin-right:10px;"> 30 Juli 2023 - 30 Juni 2024
                                        </div>
                                        <div class="tf-icons ti ti-users" style="font-size: medium;"> Kuota Penerimaan :
                                            50</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mt-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-2">
                                    <figure class="image" style="border-radius: 0%;"><img style="border-radius: 0%;"
                                            src="{{ asset('front/assets/img/icon_lowongan.png') }}" alt="admin.upload">
                                    </figure>
                                </div>
                                <div class="col-10 d-flex justify-content-between">
                                    <div>
                                        <h5>Backend Developer</h5>
                                        <p>IT-Computer - Software</p>
                                    </div>
                                    <div>
                                        <span class="badge bg-label-success me-1 text-end">Aktif</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row gy-3 mt-3">
                                <div class="col-md-2 col-6">
                                    <div class="d-flex align-items-center">
                                        <div class="badge rounded-pill bg-label-success me-3 p-2">
                                            <i class="ti ti-users ti-sm"></i>
                                        </div>
                                        <div class="card-info">
                                            <small>Total Pelamar</small>
                                            <h5 class="mb-0">0</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2 col-6">
                                    <div class="d-flex align-items-center">
                                        <div class="badge rounded-pill bg-label-success me-3 p-2">
                                            <i class="ti ti-file-report ti-sm"></i>
                                        </div>
                                        <div class="card-info">
                                            <small>Seleksi Tahap 1</small>
                                            <h5 class="mb-0">0</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2 col-6">
                                    <div class="d-flex align-items-center">
                                        <div class="badge rounded-pill bg-label-success me-3 p-2">
                                            <i class="ti ti-file-report ti-sm"></i>
                                        </div>
                                        <div class="card-info">
                                            <small>Seleksi Tahap 2</small>
                                            <h5 class="mb-0">0</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2 col-6">
                                    <div class="d-flex align-items-center">
                                        <div class="badge rounded-pill bg-label-success me-3 p-2">
                                            <i class="ti ti-file-report ti-sm"></i>
                                        </div>
                                        <div class="card-info">
                                            <small>Seleksi Tahap 3</small>
                                            <h5 class="mb-0">0</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr />
                            <div class="row mt-2">
                                <div class="col-12 d-flex justify-content-between">
                                    <div class="col-6">
                                        <div class="tf-icons ti ti-calendar"
                                            style="font-size: medium; margin-right:10px;"> 30 Juli 2023 - 30 Juni 2024
                                        </div>
                                        <div class="tf-icons ti ti-users" style="font-size: medium;"> Kuota Penerimaan :
                                            50</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-end" style="margin-right:25px;">
                        <li class="page-item first">
                            <a class="page-link" href="javascript:void(0);">Previous</a>
                        </li>
                        <li class="page-item active">
                            <a class="page-link" href="javascript:void(0);">1</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="javascript:void(0);">2</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="javascript:void(0);">3</a>
                        </li>
                        <li class="page-item last">
                            <a class="page-link" href="javascript:void(0);">Next</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
@endsection

@section('page_script')
    <script src="../../app-assets/vendor/libs/sweetalert2/sweetalert2.js"></script>
    <script src="../../app-assets/js/extended-ui-sweetalert2.js"></script>
@endsection
