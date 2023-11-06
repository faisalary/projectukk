@extends('partials_admin.template')

@section('page_style')
<link rel="stylesheet" href="../../app-assets/vendor/libs/sweetalert2/sweetalert2.css" />
<style>
    .tooltip-inner {
        min-width: 100%;
        max-width: 100%;
    }
</style>

@endsection

@section('main')
<div class="row">
    <div class="col-md-12 col-12">
        <h4 class="fw-bold"><span class="text-muted fw-light">Lowongan Magang /</span> <span class="text-muted fw-light">Informasi Lowongan /</span> Fullstack Developer - Tahun Ajaran 2324</h4>
    </div>
    <div class="col-md-12 col-12 mb-3 p-0">
        <select class="select2 form-select" data-placeholder="Pilih Tahun Ajaran" style="width: 20px !important;">
            <option value="1">2023/2024 Genap</option>
            <option value="2">2023/2024 Ganjil</option>
            <option value="3">2022/2023 Genap</option>
            <option value="4">2022/2023 Ganjil</option>
            <option value="5">2021/2022 Genap</option>
            <option value="6">2021/2022 Ganjil</option>
        </select>
        <div><button class="btn btn-success waves-effect waves-light" data-bs-toggle="offcanvas" data-bs-target="#modalSlide"><i class="tf-icons ti ti-filter"></i>
        </button></div>
    </div>
</div>

<div class="col-xl-12">
    <div class="nav-align-top">
        <ul class="nav nav-pills mb-3 " role="tablist">
            <li class="nav-item" style="font-size: small;">
                <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-justified-kandidat" aria-controls="navs-pills-justified-kandidat" aria-selected="true" style="padding: 8px 9px;">
                    <i class="tf-icons ti ti-users ti-xs me-1"></i> Seluruh Kandidat
                    <span class="badge rounded-pill badge-center h-px-20 w-px-20 bg-secondary ms-1">3</span>
                </button>
            </li>
            <li class="nav-item" style="font-size: small;">
                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-justified-belum-proses" aria-controls="navs-pills-justified-belum-proses" aria-selected="false" style="padding: 8px 9px;">
                    <i class="tf-icons ti ti-clock ti-xs me-1"></i> Belum Proses
                    <span class="badge rounded-pill badge-center h-px-20 w-px-20 bg-secondary ms-1">2</span>
                </button>
            </li>
            <li class="nav-item" style="font-size: small;">
                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-justified-screening" aria-controls="navs-pills-justified-screening" aria-selected="false" style="padding: 8px 9px;">
                    <i class="tf-icons ti ti-user-check ti-xs me-1"></i> Screening
                    <span class="badge rounded-pill badge-center h-px-20 w-px-20 bg-secondary ms-1">1</span>
                </button>
            </li>
            <li class="nav-item" style="font-size: small;">
                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-justified-tahap1" aria-controls="navs-pills-justified-tahap1" aria-selected="false" style="padding: 8px 9px;">
                    <i class="tf-icons ti ti-user-x ti-xs me-1"></i> Seleksi Tahap 1
                    <span class="badge rounded-pill badge-center h-px-20 w-px-20 bg-secondary ms-1">1</span>
                </button>
            </li>
            <li class="nav-item" style="font-size: small;">
                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-justified-tahap2" aria-controls="navs-pills-justified-tahap2" aria-selected="false" style="padding: 8px 9px;">
                    <i class="tf-icons ti ti-user-x ti-xs me-1"></i> Seleksi Tahap 2
                    <span class="badge rounded-pill badge-center h-px-20 w-px-20 bg-secondary ms-1">1</span>
                </button>
            </li>
            <li class="nav-item" style="font-size: small;">
                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-justified-penawaran" aria-controls="navs-pills-justified-penawaran" aria-selected="false" style="padding: 8px 9px;">
                    <i class="tf-icons ti ti-clock ti-xs me-1"></i> Penawaran
                    <span class="badge rounded-pill badge-center h-px-20 w-px-20 bg-secondary ms-1">2</span>
                </button>
            </li>
            <li class="nav-item" style="font-size: small;">
                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-justified-diterima" aria-controls="navs-pills-justified-diterima" aria-selected="false" style="padding: 8px 9px;">
                    <i class="tf-icons ti ti-user-check ti-xs me-1"></i> Diterima
                    <span class="badge rounded-pill badge-center h-px-20 w-px-20 bg-secondary ms-1">1</span>
                </button>
            </li>
            <li class="nav-item" style="font-size: small;">
                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-justified-ditolak" aria-controls="navs-pills-justified-ditolak" aria-selected="false" style="padding: 8px 9px;">
                    <i class="tf-icons ti ti-user-x ti-xs me-1"></i> Ditolak
                    <span class="badge rounded-pill badge-center h-px-20 w-px-20 bg-secondary ms-1">1</span>
                </button>
            </li>
        </ul>
        <p class="text-secondary">Filter Berdasarkan : <i class='tf-icons ti ti-alert-circle text-primary pb-1' data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Program Studi : D3 Rekayasa Perangkat Lunak Aplikasi, Fakultas : Ilmu Terapan, Universitas : Tel-U Jakarta, Status :  Diterima" id="tooltip-filter"></i></p>


        <div class="tab-content p-0">
            <div class="tab-pane fade show active" id="navs-pills-justified-kandidat" role="tabpanel">
                <div class="card-datatable table-responsive">
                    <table class="table" id="table-seluruh-kandidat">
                        <thead>
                            <tr>
                                <th>NOMOR</th>
                                <th style="min-width:100px;">NAMA</th>
                                <th>NO TELEPON </th>
                                <th>EMAIL</th>
                                <th style="min-width:140px;">PROGRAM STUDI</th>
                                <th style="min-width:100px;">FAKULTAS</th>
                                <th style="min-width:120px;">UNIVERSITAS</th>
                                <th>STATUS</th>
                                <th style="min-width:90px;">AKSI</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>

            <div class="tab-pane fade" id="navs-pills-justified-belum-proses" role="tabpanel">
                <div class="card-datatable table-responsive">
                    <table class="table" id="table-belum-proses">
                        <thead>
                            <tr>
                                <th>NOMOR</th>
                                <th style="min-width:100px;">NAMA</th>
                                <th>NO TELEPON </th>
                                <th>EMAIL</th>
                                <th style="min-width:140px;">PROGRAM STUDI</th>
                                <th style="min-width:100px;">FAKULTAS</th>
                                <th style="min-width:120px;">UNIVERSITAS</th>
                                <th>STATUS</th>
                                <th style="min-width:90px;">AKSI</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>

            <div class="tab-pane fade" id="navs-pills-justified-screening" role="tabpanel">
                <div class="card-datatable table-responsive">
                    <table class="table" id="table-screening">
                        <thead>
                            <tr>
                                <th>NOMOR</th>
                                <th style="min-width:100px;">NAMA</th>
                                <th>NO TELEPON </th>
                                <th>EMAIL</th>
                                <th style="min-width:140px;">PROGRAM STUDI</th>
                                <th style="min-width:100px;">FAKULTAS</th>
                                <th style="min-width:120px;">UNIVERSITAS</th>
                                <th>STATUS</th>
                                <th style="min-width:90px;">AKSI</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>

            <div class="tab-pane fade" id="navs-pills-justified-tahap1" role="tabpanel">
                <div class="card-datatable table-responsive">
                    <table class="table" id="table-tahap1">
                        <thead>
                            <tr>
                                <th>NOMOR</th>
                                <th style="min-width:100px;">NAMA</th>
                                <th>NO TELEPON </th>
                                <th>EMAIL</th>
                                <th style="min-width:140px;">PROGRAM STUDI</th>
                                <th style="min-width:100px;">FAKULTAS</th>
                                <th style="min-width:120px;">UNIVERSITAS</th>
                                <th>STATUS</th>
                                <th style="min-width:90px;">AKSI</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>

            <div class="tab-pane fade" id="navs-pills-justified-tahap2" role="tabpanel">
                <div class="card-datatable table-responsive">
                    <table class="table" id="table-tahap2">
                        <thead>
                            <tr>
                                <th>NOMOR</th>
                                <th style="min-width:100px;">NAMA</th>
                                <th>NO TELEPON </th>
                                <th>EMAIL</th>
                                <th style="min-width:140px;">PROGRAM STUDI</th>
                                <th style="min-width:100px;">FAKULTAS</th>
                                <th style="min-width:120px;">UNIVERSITAS</th>
                                <th>STATUS</th>
                                <th style="min-width:90px;">AKSI</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>

            <div class="tab-pane fade" id="navs-pills-justified-penawaran" role="tabpanel">
                <div class="card-datatable table-responsive">
                    <table class="table" id="table-penawaran">
                        <thead>
                            <tr>
                                <th>NOMOR</th>
                                <th style="min-width:100px;">NAMA</th>
                                <th>NO TELEPON </th>
                                <th>EMAIL</th>
                                <th style="min-width:140px;">PROGRAM STUDI</th>
                                <th style="min-width:100px;">FAKULTAS</th>
                                <th style="min-width:120px;">UNIVERSITAS</th>
                                <th>STATUS</th>
                                <th style="min-width:90px;">AKSI</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>

            <div class="tab-pane fade" id="navs-pills-justified-diterima" role="tabpanel">
                <div class="card-datatable table-responsive">
                    <table class="table" id="table-diterima">
                        <thead>
                            <tr>
                                <th>NOMOR</th>
                                <th style="min-width:100px;">NAMA</th>
                                <th>NO TELEPON </th>
                                <th>EMAIL</th>
                                <th style="min-width:140px;">PROGRAM STUDI</th>
                                <th style="min-width:100px;">FAKULTAS</th>
                                <th style="min-width:120px;">UNIVERSITAS</th>
                                <th>STATUS</th>
                                <th style="min-width:90px;">AKSI</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>

            <div class="tab-pane fade" id="navs-pills-justified-ditolak" role="tabpanel">
                <div class="card-datatable table-responsive">
                    <table class="table" id="table-ditolak">
                        <thead>
                            <tr>
                                <th></th>
                                <th></th>
                                <th>NOMOR</th>
                                <th style="min-width:100px;">NAMA</th>
                                <th>NO TELEPON </th>
                                <th>EMAIL</th>
                                <th style="min-width:140px;">PROGRAM STUDI</th>
                                <th style="min-width:100px;">FAKULTAS</th>
                                <th style="min-width:120px;">UNIVERSITAS</th>
                                <th>STATUS</th>
                                <th style="min-width:90px;">AKSI</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="offcanvas offcanvas-end" tabindex="-1" id="modalSlide" aria-labelledby="offcanvasAddUserLabel">
    <div class="offcanvas-header">
        <h5 id="offcanvasAddUserLabel" class="offcanvas-title">Filter Berdasarkan</h5>
    </div>
    <div class="offcanvas-body mx-0 flex-grow-0 pt-0 h-100">
        <form class="add-new-user pt-0" id="filter">
            <div class="col-12 mb-2">
                <div class="row">
                    <div class="col mb-2 form-input">
                        <label for="univ" class="form-label">Universitas</label>
                        <select class="form-select select2" id="univ" name="univ" data-placeholder="Pilih Universitas">
                            <option disabled selected>Pilih Universitas</option>
                        </select>
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="mb-2">
                        <label for="fakultas" class="form-label">Fakultas</label>
                        <select class="form-select select2" id="fakultas" name="fakultas" data-placeholder="Pilih Fakultas">
                            <option disabled selected>Pilih Fakultas</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-2 form-input">
                        <label for="univ" class="form-label">Prodi</label>
                        <select class="form-select select2" id="prodi" name="prodi" data-placeholder="Pilih Prodi">
                            <option disabled selected>Pilih Prodi</option>
                        </select>
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-2 form-input">
                        <label for="univ" class="form-label">Status Kandidat</label>
                        <select class="form-select select2" id="status" name="status" data-placeholder="Status Kandidat">
                            <option disabled selected>Pilih Status Kandidat</option>
                        </select>
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
            </div>
            <div class="mt-3 text-end">
                <button type="button" class="btn btn-label-danger">Reset</button>
                <button type="submit" class="btn btn-success">Terapkan</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('page_script')
<script src="../../app-assets/vendor/libs/jquery-repeater/jquery-repeater.js"></script>
<script src="../../app-assets/js/forms-extras.js"></script>
<script>
    var jsonData = [{
            "nomor": "1",
            "nama": "Andika Alatas 6701228083",
            "no": "+6281298076589",
            "email": "dikta@gmail.com",
            "prodi": "D3 Sistem Informasi",
            "fakultas": "Ilmu Terapan",
            "universitas": "Telkom Bandung",
            "status": "<span class='badge bg-label-secondary me-1'>Belum Proses</span>",
            "aksi": "<a data-bs-toggle='modal' data-bs-target='' class='btn-icon text-success waves-effect waves-light'><i class='tf-icons ti ti-file-invoice' ></i><a onclick = active($(this))  class='btn-icon text-danger waves-effect waves-light'><i class='tf-icons ti ti-trash'></i></a>"
        },
        {
            "nomor": "2",
            "nama": "Andika Alatas 6701228083",
            "no": "+6281298076589",
            "email": "dikta@gmail.com",
            "prodi": "D3 Sistem Informasi",
            "fakultas": "Ilmu Terapan",
            "universitas": "Telkom Bandung",
            "status": "<span class='badge bg-label-warning me-1'>Screening</span>",
            "aksi": "<a data-bs-toggle='modal' data-bs-target='' class='btn-icon text-success waves-effect waves-light'><i class='tf-icons ti ti-file-invoice' ></i><a onclick = active($(this))  class='btn-icon text-danger waves-effect waves-light'><i class='tf-icons ti ti-trash'></i></a>"
        },
        {
            "nomor": "3",
            "nama": "Andika Alatas 6701228083",
            "no": "+6281298076589",
            "email": "dikta@gmail.com",
            "prodi": "D3 Sistem Informasi",
            "fakultas": "Ilmu Terapan",
            "universitas": "Telkom Bandung",
            "status": "<span class='badge bg-label-success me-1'>Diterima</span>",
            "aksi": "<a data-bs-toggle='modal' data-bs-target='' class='btn-icon text-success waves-effect waves-light'><i class='tf-icons ti ti-file-invoice' ></i><a onclick = active($(this))  class='btn-icon text-danger waves-effect waves-light'><i class='tf-icons ti ti-trash'></i></a>"
        },
        {
            "nomor": "4",
            "nama": "Andika Alatas 6701228083",
            "no": "+6281298076589",
            "email": "dikta@gmail.com",
            "prodi": "D3 Sistem Informasi",
            "fakultas": "Ilmu Terapan",
            "universitas": "Telkom Bandung",
            "status": "<span class='badge bg-label-danger me-1'>Ditolak</span>",
            "aksi": "<a data-bs-toggle='modal' data-bs-target='' class='btn-icon text-success waves-effect waves-light'><i class='tf-icons ti ti-file-invoice' ></i><a onclick = active($(this))  class='btn-icon text-danger waves-effect waves-light'><i class='tf-icons ti ti-trash'></i></a>"
        },
        {
            "nomor": "5",
            "nama": "Andika Alatas 6701228083",
            "no": "+6281298076589",
            "email": "dikta@gmail.com",
            "prodi": "D3 Sistem Informasi",
            "fakultas": "Ilmu Terapan",
            "universitas": "Telkom Bandung",
            "status": "<span class='badge bg-label-info me-1'>Penawaran</span>",
            "aksi": "<a data-bs-toggle='modal' data-bs-target='' class='btn-icon text-success waves-effect waves-light'><i class='tf-icons ti ti-file-invoice' ></i><a onclick = active($(this))  class='btn-icon text-danger waves-effect waves-light'><i class='tf-icons ti ti-trash'></i></a>"
        },
        {
            "nomor": "6",
            "nama": "Andika Alatas 6701228083",
            "no": "+6281298076589",
            "email": "dikta@gmail.com",
            "prodi": "D3 Sistem Informasi",
            "fakultas": "Ilmu Terapan",
            "universitas": "Telkom Bandung",
            "status": "<span class='badge bg-label-primary me-1'>Seleksi Tahap 1</span>",
            "aksi": "<a data-bs-toggle='modal' data-bs-target='' class='btn-icon text-success waves-effect waves-light'><i class='tf-icons ti ti-file-invoice' ></i><a onclick = active($(this))  class='btn-icon text-danger waves-effect waves-light'><i class='tf-icons ti ti-trash'></i></a>"
        },
        {
            "nomor": "7",
            "nama": "Andika Alatas 6701228083",
            "no": "+6281298076589",
            "email": "dikta@gmail.com",
            "prodi": "D3 Sistem Informasi",
            "fakultas": "Ilmu Terapan",
            "universitas": "Telkom Bandung",
            "status": "<span class='badge bg-label-dark me-1'>Seleksi Tahap 2</span>",
            "aksi": "<a data-bs-toggle='modal' data-bs-target='' class='btn-icon text-success waves-effect waves-light'><i class='tf-icons ti ti-file-invoice' ></i><a onclick = active($(this))  class='btn-icon text-danger waves-effect waves-light'><i class='tf-icons ti ti-trash'></i></a>"
        }
    ];

    var table = $('#table-seluruh-kandidat').DataTable({
        "data": jsonData,
        scrollX: true,
        columns: [{
                data: "nomor"
            },
            {
                data: "nama"
            },
            {
                data: "no"
            },

            {
                data: "email"
            },
            {
                data: "prodi"
            },
            {
                data: "fakultas"
            },
            {
                data: "universitas"
            },
            {
                data: "status"
            },
            {
                data: "aksi"
            }
        ]
    });

    var jsonData = [{
            "nomor": "1",
            "nama": "Andika Alatas 6701228083",
            "no": "+6281298076589",
            "email": "dikta@gmail.com",
            "prodi": "D3 Sistem Informasi",
            "fakultas": "Ilmu Terapan",
            "universitas": "Telkom Bandung",
            "status": "<span class='badge bg-label-secondary me-1'>Belum Proses</span>",
            "aksi": "<a data-bs-toggle='modal' data-bs-target='' class='btn-icon text-success waves-effect waves-light'><i class='tf-icons ti ti-file-invoice' ></i><a onclick = active($(this))  class='btn-icon text-danger waves-effect waves-light'><i class='tf-icons ti ti-trash'></i></a>"
        },
        {
            "nomor": "2",
            "nama": "Andika Alatas 6701228083",
            "no": "+6281298076589",
            "email": "dikta@gmail.com",
            "prodi": "D3 Sistem Informasi",
            "fakultas": "Ilmu Terapan",
            "universitas": "Telkom Bandung",
            "status": "<span class='badge bg-label-secondary me-1'>Belum Proses</span>",
            "aksi": "<a data-bs-toggle='modal' data-bs-target='' class='btn-icon text-success waves-effect waves-light'><i class='tf-icons ti ti-file-invoice' ></i><a onclick = active($(this))  class='btn-icon text-danger waves-effect waves-light'><i class='tf-icons ti ti-trash'></i></a>"
        },
        {
            "nomor": "3",
            "nama": "Andika Alatas 6701228083",
            "no": "+6281298076589",
            "email": "dikta@gmail.com",
            "prodi": "D3 Sistem Informasi",
            "fakultas": "Ilmu Terapan",
            "universitas": "Telkom Bandung",
            "status": "<span class='badge bg-label-secondary me-1'>Belum Proses</span>",
            "aksi": "<a data-bs-toggle='modal' data-bs-target='' class='btn-icon text-success waves-effect waves-light'><i class='tf-icons ti ti-file-invoice' ></i><a onclick = active($(this))  class='btn-icon text-danger waves-effect waves-light'><i class='tf-icons ti ti-trash'></i></a>"
        }
    ];
    var table = $('#table-belum-proses').DataTable({
        "data": jsonData,
        scrollX: true,
        columns: [{
                data: "nomor"
            },
            {
                data: "nama"
            },
            {
                data: "no"
            },

            {
                data: "email"
            },
            {
                data: "prodi"
            },
            {
                data: "fakultas"
            },
            {
                data: "universitas"
            },
            {
                data: "status"
            },
            {
                data: "aksi"
            }
        ]
    });

    var jsonData = [{
            "nomor": "1",
            "nama": "Andika Alatas 6701228083",
            "no": "+6281298076589",
            "email": "dikta@gmail.com",
            "prodi": "D3 Sistem Informasi",
            "fakultas": "Ilmu Terapan",
            "universitas": "Telkom Bandung",
            "status": "<span class='badge bg-label-warning me-1'>Screening</span>",
            "aksi": "<a data-bs-toggle='modal' data-bs-target='' class='btn-icon text-success waves-effect waves-light'><i class='tf-icons ti ti-file-invoice' ></i><a onclick = active($(this))  class='btn-icon text-danger waves-effect waves-light'><i class='tf-icons ti ti-trash'></i></a>"
        },
        {
            "nomor": "2",
            "nama": "Andika Alatas 6701228083",
            "no": "+6281298076589",
            "email": "dikta@gmail.com",
            "prodi": "D3 Sistem Informasi",
            "fakultas": "Ilmu Terapan",
            "universitas": "Telkom Bandung",
            "status": "<span class='badge bg-label-warning me-1'>Screening</span>",
            "aksi": "<a data-bs-toggle='modal' data-bs-target='' class='btn-icon text-success waves-effect waves-light'><i class='tf-icons ti ti-file-invoice' ></i><a onclick = active($(this))  class='btn-icon text-danger waves-effect waves-light'><i class='tf-icons ti ti-trash'></i></a>"
        },
        {
            "nomor": "3",
            "nama": "Andika Alatas 6701228083",
            "no": "+6281298076589",
            "email": "dikta@gmail.com",
            "prodi": "D3 Sistem Informasi",
            "fakultas": "Ilmu Terapan",
            "universitas": "Telkom Bandung",
            "status": "<span class='badge bg-label-warning me-1'>Screening</span>",
            "aksi": "<a data-bs-toggle='modal' data-bs-target='' class='btn-icon text-success waves-effect waves-light'><i class='tf-icons ti ti-file-invoice' ></i><a onclick = active($(this))  class='btn-icon text-danger waves-effect waves-light'><i class='tf-icons ti ti-trash'></i></a>"
        }
    ];
    var table = $('#table-screening').DataTable({
        "data": jsonData,
        scrollX: true,
        columns: [{
                data: "nomor"
            },
            {
                data: "nama"
            },
            {
                data: "no"
            },

            {
                data: "email"
            },
            {
                data: "prodi"
            },
            {
                data: "fakultas"
            },
            {
                data: "universitas"
            },
            {
                data: "status"
            },
            {
                data: "aksi"
            }
        ]
    });

    var jsonData = [{
            "nomor": "1",
            "nama": "Andika Alatas 6701228083",
            "no": "+6281298076589",
            "email": "dikta@gmail.com",
            "prodi": "D3 Sistem Informasi",
            "fakultas": "Ilmu Terapan",
            "universitas": "Telkom Bandung",
            "status": "<span class='badge bg-label-primary me-1'>Seleksi Tahap 1</span>",
            "aksi": "<a data-bs-toggle='modal' data-bs-target='' class='btn-icon text-success waves-effect waves-light'><i class='tf-icons ti ti-file-invoice' ></i><a onclick = active($(this))  class='btn-icon text-danger waves-effect waves-light'><i class='tf-icons ti ti-trash'></i></a>"
        },
        {
            "nomor": "2",
            "nama": "Andika Alatas 6701228083",
            "no": "+6281298076589",
            "email": "dikta@gmail.com",
            "prodi": "D3 Sistem Informasi",
            "fakultas": "Ilmu Terapan",
            "universitas": "Telkom Bandung",
            "status": "<span class='badge bg-label-primary me-1'>Seleksi Tahap 1</span>",
            "aksi": "<a data-bs-toggle='modal' data-bs-target='' class='btn-icon text-success waves-effect waves-light'><i class='tf-icons ti ti-file-invoice' ></i><a onclick = active($(this))  class='btn-icon text-danger waves-effect waves-light'><i class='tf-icons ti ti-trash'></i></a>"
        },
        {
            "nomor": "3",
            "nama": "Andika Alatas 6701228083",
            "no": "+6281298076589",
            "email": "dikta@gmail.com",
            "prodi": "D3 Sistem Informasi",
            "fakultas": "Ilmu Terapan",
            "universitas": "Telkom Bandung",
            "status": "<span class='badge bg-label-primary me-1'>Seleksi Tahap 1</span>",
            "aksi": "<a data-bs-toggle='modal' data-bs-target='' class='btn-icon text-success waves-effect waves-light'><i class='tf-icons ti ti-file-invoice' ></i><a onclick = active($(this))  class='btn-icon text-danger waves-effect waves-light'><i class='tf-icons ti ti-trash'></i></a>"
        }
    ];
    var table = $('#table-tahap1').DataTable({
        "data": jsonData,
        scrollX: true,
        columns: [{
                data: "nomor"
            },
            {
                data: "nama"
            },
            {
                data: "no"
            },

            {
                data: "email"
            },
            {
                data: "prodi"
            },
            {
                data: "fakultas"
            },
            {
                data: "universitas"
            },
            {
                data: "status"
            },
            {
                data: "aksi"
            }
        ]
    });

    var jsonData = [{
            "nomor": "1",
            "nama": "Andika Alatas 6701228083",
            "no": "+6281298076589",
            "email": "dikta@gmail.com",
            "prodi": "D3 Sistem Informasi",
            "fakultas": "Ilmu Terapan",
            "universitas": "Telkom Bandung",
            "status": "<span class='badge bg-label-dark me-1'>Seleksi Tahap 2</span>",
            "aksi": "<a data-bs-toggle='modal' data-bs-target='' class='btn-icon text-success waves-effect waves-light'><i class='tf-icons ti ti-file-invoice' ></i><a onclick = active($(this))  class='btn-icon text-danger waves-effect waves-light'><i class='tf-icons ti ti-trash'></i></a>"
        },
        {
            "nomor": "2",
            "nama": "Andika Alatas 6701228083",
            "no": "+6281298076589",
            "email": "dikta@gmail.com",
            "prodi": "D3 Sistem Informasi",
            "fakultas": "Ilmu Terapan",
            "universitas": "Telkom Bandung",
            "status": "<span class='badge bg-label-dark me-1'>Seleksi Tahap 2</span>",
            "aksi": "<a data-bs-toggle='modal' data-bs-target='' class='btn-icon text-success waves-effect waves-light'><i class='tf-icons ti ti-file-invoice' ></i><a onclick = active($(this))  class='btn-icon text-danger waves-effect waves-light'><i class='tf-icons ti ti-trash'></i></a>"
        },
        {
            "nomor": "3",
            "nama": "Andika Alatas 6701228083",
            "no": "+6281298076589",
            "email": "dikta@gmail.com",
            "prodi": "D3 Sistem Informasi",
            "fakultas": "Ilmu Terapan",
            "universitas": "Telkom Bandung",
            "status": "<span class='badge bg-label-dark me-1'>Seleksi Tahap 2</span>",
            "aksi": "<a data-bs-toggle='modal' data-bs-target='' class='btn-icon text-success waves-effect waves-light'><i class='tf-icons ti ti-file-invoice' ></i><a onclick = active($(this))  class='btn-icon text-danger waves-effect waves-light'><i class='tf-icons ti ti-trash'></i></a>"
        }
    ];
    var table = $('#table-tahap2').DataTable({
        "data": jsonData,
        scrollX: true,
        columns: [{
                data: "nomor"
            },
            {
                data: "nama"
            },
            {
                data: "no"
            },

            {
                data: "email"
            },
            {
                data: "prodi"
            },
            {
                data: "fakultas"
            },
            {
                data: "universitas"
            },
            {
                data: "status"
            },
            {
                data: "aksi"
            }
        ]
    });

    var jsonData = [{
            "nomor": "1",
            "nama": "Andika Alatas 6701228083",
            "no": "+6281298076189",
            "email": "dikta@gmail.com",
            "prodi": "D3 Sistem Informasi",
            "fakultas": "Ilmu Terapan",
            "universitas": "Telkom Bandung",
            "status": "<span class='badge bg-label-info me-1'>Penawaran</span>",
            "aksi": "<a data-bs-toggle='modal' data-bs-target='' class='btn-icon text-success waves-effect waves-light'><i class='tf-icons ti ti-file-invoice' ></i><a onclick = active($(this))  class='btn-icon text-danger waves-effect waves-light'><i class='tf-icons ti ti-trash'></i></a>"
        },
        {
            "nomor": "2",
            "nama": "Andika Alatas 6701228083",
            "no": "+6281298076589",
            "email": "dikta@gmail.com",
            "prodi": "D3 Sistem Informasi",
            "fakultas": "Ilmu Terapan",
            "universitas": "Telkom Bandung",
            "status": "<span class='badge bg-label-info me-1'>Penawaran</span>",
            "aksi": "<a data-bs-toggle='modal' data-bs-target='' class='btn-icon text-success waves-effect waves-light'><i class='tf-icons ti ti-file-invoice' ></i><a onclick = active($(this))  class='btn-icon text-danger waves-effect waves-light'><i class='tf-icons ti ti-trash'></i></a>"
        },
        {
            "nomor": "3",
            "nama": "Andika Alatas 6701228083",
            "no": "+6281298076589",
            "email": "dikta@gmail.com",
            "prodi": "D3 Sistem Informasi",
            "fakultas": "Ilmu Terapan",
            "universitas": "Telkom Bandung",
            "status": "<span class='badge bg-label-info me-1'>Penawaran</span>",
            "aksi": "<a data-bs-toggle='modal' data-bs-target='' class='btn-icon text-success waves-effect waves-light'><i class='tf-icons ti ti-file-invoice' ></i><a onclick = active($(this))  class='btn-icon text-danger waves-effect waves-light'><i class='tf-icons ti ti-trash'></i></a>"
        }
    ];
    var table = $('#table-penawaran').DataTable({
        "data": jsonData,
        scrollX: true,
        columns: [{
                data: "nomor"
            },
            {
                data: "nama"
            },
            {
                data: "no"
            },

            {
                data: "email"
            },
            {
                data: "prodi"
            },
            {
                data: "fakultas"
            },
            {
                data: "universitas"
            },
            {
                data: "status"
            },
            {
                data: "aksi"
            }
        ]
    });

    var jsonData = [{
            "nomor": "1",
            "nama": "Andika Alatas 6701228083",
            "no": "+6281298076589",
            "email": "dikta@gmail.com",
            "prodi": "D3 Sistem Informasi",
            "fakultas": "Ilmu Terapan",
            "universitas": "Telkom Bandung",
            "status": "<span class='badge bg-label-success me-1'>Diterima</span>",
            "aksi": "<a data-bs-toggle='modal' data-bs-target='' class='btn-icon text-success waves-effect waves-light'><i class='tf-icons ti ti-file-invoice' ></i><a onclick = active($(this))  class='btn-icon text-danger waves-effect waves-light'><i class='tf-icons ti ti-trash'></i></a>"
        },
        {
            "nomor": "2",
            "nama": "Andika Alatas 6701228083",
            "no": "+6281298076589",
            "email": "dikta@gmail.com",
            "prodi": "D3 Sistem Informasi",
            "fakultas": "Ilmu Terapan",
            "universitas": "Telkom Bandung",
            "status": "<span class='badge bg-label-success me-1'>Diterima</span>",
            "aksi": "<a data-bs-toggle='modal' data-bs-target='' class='btn-icon text-success waves-effect waves-light'><i class='tf-icons ti ti-file-invoice' ></i><a onclick = active($(this))  class='btn-icon text-danger waves-effect waves-light'><i class='tf-icons ti ti-trash'></i></a>"
        },
        {
            "nomor": "3",
            "nama": "Andika Alatas 6701228083",
            "no": "+6281298076589",
            "email": "dikta@gmail.com",
            "prodi": "D3 Sistem Informasi",
            "fakultas": "Ilmu Terapan",
            "universitas": "Telkom Bandung",
            "status": "<span class='badge bg-label-success me-1'>Diterima</span>",
            "aksi": "<a data-bs-toggle='modal' data-bs-target='' class='btn-icon text-success waves-effect waves-light'><i class='tf-icons ti ti-file-invoice' ></i><a onclick = active($(this))  class='btn-icon text-danger waves-effect waves-light'><i class='tf-icons ti ti-trash'></i></a>"
        }
    ];
    var table = $('#table-diterima').DataTable({
        "data": jsonData,
        scrollX: true,
        columns: [{
                data: "nomor"
            },
            {
                data: "nama"
            },
            {
                data: "no"
            },

            {
                data: "email"
            },
            {
                data: "prodi"
            },
            {
                data: "fakultas"
            },
            {
                data: "universitas"
            },
            {
                data: "status"
            },
            {
                data: "aksi"
            }
        ]
    });

    var jsonData = [{
            "id": "",
            "id": "",
            "nomor": "1",
            "nama": "Andika Alatas 6701228083",
            "no": "+6281298076589",
            "email": "dikta@gmail.com",
            "prodi": "D3 Sistem Informasi",
            "fakultas": "Ilmu Terapan",
            "universitas": "Telkom Bandung",
            "status": "<span class='badge bg-label-danger me-1'>Ditolak</span>",
            "aksi": "<a data-bs-toggle='modal' data-bs-target='' class='btn-icon text-success waves-effect waves-light'><i class='tf-icons ti ti-file-invoice' ></i><a onclick = active($(this))  class='btn-icon text-danger waves-effect waves-light'><i class='tf-icons ti ti-trash'></i></a>"
        },
        {
            "id": "",
            "id": "",
            "nomor": "2",
            "nama": "Andika Alatas 6701228083",
            "no": "+6281298076589",
            "email": "dikta@gmail.com",
            "prodi": "D3 Sistem Informasi",
            "fakultas": "Ilmu Terapan",
            "universitas": "Telkom Bandung",
            "status": "<span class='badge bg-label-danger me-1'>Ditolak</span>",
            "aksi": "<a data-bs-toggle='modal' data-bs-target='' class='btn-icon text-success waves-effect waves-light'><i class='tf-icons ti ti-file-invoice' ></i><a onclick = active($(this))  class='btn-icon text-danger waves-effect waves-light'><i class='tf-icons ti ti-trash'></i></a>"
        },
        {
            "id": "",
            "id": "",
            "nomor": "3",
            "nama": "Andika Alatas 6701228083",
            "no": "+6281298076589",
            "email": "dikta@gmail.com",
            "prodi": "D3 Sistem Informasi",
            "fakultas": "Ilmu Terapan",
            "universitas": "Telkom Bandung",
            "status": "<span class='badge bg-label-danger me-1'>Ditolak</span>",
            "aksi": "<a data-bs-toggle='modal' data-bs-target='' class='btn-icon text-success waves-effect waves-light'><i class='tf-icons ti ti-file-invoice' ></i><a onclick = active($(this))  class='btn-icon text-danger waves-effect waves-light'><i class='tf-icons ti ti-trash'></i></a>"
        }
    ];
    var table = $('#table-ditolak').DataTable({
        "data": jsonData,
        scrollX: true,
        columns: [{
                data: 'id'
            },
            {
                data: 'id'
            }, {
                data: "nomor"
            },
            {
                data: "nama"
            },
            {
                data: "no"
            },

            {
                data: "email"
            },
            {
                data: "prodi"
            },
            {
                data: "fakultas"
            },
            {
                data: "universitas"
            },
            {
                data: "status"
            },
            {
                data: "aksi"
            }
        ],
        columnDefs: [{
                // For Responsive
                className: 'control',
                orderable: false,
                searchable: false,
                responsivePriority: 2,
                targets: 0,
                render: function(data, type, full, meta) {
                    return '';
                }
            },
            {
                targets: 1,
                orderable: false,
                searchable: false,
                responsivePriority: 3,
                checkboxes: true,
                render: function() {
                    return '<input type="checkbox" class="dt-checkboxes form-check-input">';
                },
                checkboxes: {
                    selectAllRender: '<input type="checkbox" class="form-check-input">'
                }
            },
        ],
    });
</script>

<script src="../../app-assets/vendor/libs/sweetalert2/sweetalert2.js"></script>
<script src="../../app-assets/js/extended-ui-sweetalert2.js"></script>
@endsection