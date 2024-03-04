@extends('partials_admin.template')
@section('meta_header')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('page_style')
<link rel="stylesheet" href="{{ asset('app-assets/vendor/libs/sweetalert2/sweetalert2.css')}}" />
<style>
    .tooltip-inner {
        min-width: 100%;
        max-width: 100%;
    }

    .position-relative {
        padding-right: 15px;
        padding-left: 15px;
    }

    h6,
    .h6 {
        font-size: 0.9375rem;
        margin-bottom: 0px;
    }

    #more {
        display: none;
    }

    span.select2-selection.select2-selection--single {
        width: 200px;
    }
</style>

@endsection

@section('main')
<button class="btn btn-outline-success my-2 waves-effect p-3 mb-4" type="button" id="back" style="width: 10%; height:5%;">
    <i class="bi bi-arrow-left text-success" style="font-size: medium;"> Kembali </i>
</button>
<div class="row">
    <div class="col-md-12 col-12">
        <nav aria-label="breadcrumb">
            <h4>
                <ol class="breadcrumb breadcrumb-style1">
                    @can( "title.info.lowongan.admin")
                    <li class="breadcrumb-item text-secondary">
                        Informasi Mitra
                    </li>
                    @endcan
                    <li class="breadcrumb-item">
                        <a class="text-secondary">Informasi Lowongan</a>
                    </li>
                    <li class="breadcrumb-item active">Lowongan {{$pendaftar->lowonganMagang->intern_position ?? $lowongan->intern_position}} Periode 21 April - 14 Juni 2023</li>
                </ol>
            </h4>
        </nav>
        <!-- <h4 class="fw-bold"><span class="text-muted fw-light">Lowongan Magang /</span> <span class="text-muted fw-light">Informasi Lowongan /</span> Fullstack Developer - Tahun Ajaran 2324</h4> -->
    </div>
    <div class="col-9"></div>
    <div class="col-md-3 col-12 mb-3 d-flex align-items-center justify-content-between">
        <select class="select2 form-select" data-placeholder="Pilih Tahun Ajaran">
            <option value="1">2023/2024 Genap</option>
            <option value="2">2023/2024 Ganjil</option>
            <option value="3">2022/2023 Genap</option>
            <option value="4">2022/2023 Ganjil</option>
            <option value="5">2021/2022 Genap</option>
            <option value="6">2021/2022 Ganjil</option>
        </select>
        <button class="btn btn-success waves-effect waves-light" data-bs-toggle="offcanvas" data-bs-target="#modalfilter"><i class="tf-icons ti ti-filter"></i>
        </button>
    </div>
</div>

<div class="col-xl-12">
    <div class="nav-align-top">
        <ul class="nav nav-pills mb-3 " role="tablist">
            <li class="nav-item" style="font-size: small;">
                <button type="button" class="nav-link active showSingle" target="1" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-justified-kandidat" aria-controls="navs-pills-justified-kandidat" aria-selected="true" style="padding: 8px 9px;">
                    <i class="tf-icons ti ti-users ti-xs me-1"></i> Data Kandidat
                </button>
            </li>
            <li class="nav-item" style="font-size: small;">
                <button type="button" class=" nav-link showSingle" target="2" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-justified-screening" aria-controls="navs-pills-justified-screening" aria-selected="false" style="padding: 8px 9px;">
                    <i class="tf-icons ti ti-files ti-xs me-1"></i> Screening
                </button>
            </li>
            @if($lowongan->tahapan_seleksi == '1')
            <li class="nav-item" style="font-size: small;">
                <button type="button" class="nav-link showSingle" target="3" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-justified-tahap1" aria-controls="navs-pills-justified-tahap1" aria-selected="false" style="padding: 8px 9px;">
                    <i class="tf-icons ti ti-display ti-xs me-1"></i> Seleksi Tahap 1
                </button>
            </li>
            @elseif($lowongan->tahapan_seleksi == '2')
            <li class="nav-item" style="font-size: small;">
                <button type="button" class="nav-link showSingle" target="3" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-justified-tahap1" aria-controls="navs-pills-justified-tahap1" aria-selected="false" style="padding: 8px 9px;">
                    <i class="tf-icons bi bi-display ti-xs me-1"></i> Seleksi Tahap 1
                </button>
            </li>
            <li class="nav-item" style="font-size: small;">
                <button type="button" class="nav-link showSingle" target="4" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-justified-tahap2" aria-controls="navs-pills-justified-tahap2" aria-selected="false" style="padding: 8px 9px;">
                    <i class="tf-icons bi bi-display ti-xs me-1"></i> Seleksi Tahap 2
                </button>
            </li>
            @else
            <li class="nav-item" style="font-size: small;">
                <button type="button" class="nav-link showSingle" target="3" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-justified-tahap1" aria-controls="navs-pills-justified-tahap1" aria-selected="false" style="padding: 8px 9px;">
                    <i class="tf-icons bi bi-display ti-xs me-1"></i> Seleksi Tahap 1
                </button>
            </li>
            <li class="nav-item" style="font-size: small;">
                <button type="button" class="nav-link showSingle" target="4" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-justified-tahap2" aria-controls="navs-pills-justified-tahap2" aria-selected="false" style="padding: 8px 9px;">
                    <i class="tf-icons bi bi-display ti-xs me-1"></i> Seleksi Tahap 2
                </button>
            </li>
            <li class="nav-item" style="font-size: small;">
                <button type="button" class="nav-link showSingle" target="5" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-justified-tahap3" aria-controls="navs-pills-justified-tahap3" aria-selected="false" style="padding: 8px 9px;">
                    <i class="tf-icons bi bi-display ti-xs me-1"></i> Seleksi Tahap 3
                </button>
            </li>
            @endif
            <li class="nav-item" style="font-size: small;">
                <button type="button" class="nav-link showSingle" target="6" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-justified-penawaran" aria-controls="navs-pills-justified-penawaran" aria-selected="false" style="padding: 8px 9px;">
                    <i class="tf-icons ti ti-writing-sign ti-xs me-1"></i> Penawaran
                </button>
            </li>
            <li class="nav-item" style="font-size: small;">
                <button type="button" class="nav-link showSingle" target="7" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-justified-diterima" aria-controls="navs-pills-justified-diterima" aria-selected="false" style="padding: 8px 9px;">
                    <i class="tf-icons ti ti-user-check ti-xs me-1"></i> Diterima
                </button>
            </li>
            <li class="nav-item" style="font-size: small;">
                <button type="button" class="nav-link showSingle" target="8" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-justified-ditolak" aria-controls="navs-pills-justified-ditolak" aria-selected="false" style="padding: 8px 9px;">
                    <i class="tf-icons ti ti-user-x ti-xs me-1"></i> Ditolak
                </button>
            </li>
        </ul>
    </div>

    <div class="row cnt">
        <div class="col-8 text-secondary mb-3">Filter Berdasarkan : <i class='tf-icons ti ti-alert-circle text-primary pb-1' data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Program Studi : D3 Rekayasa Perangkat Lunak Aplikasi, Fakultas : Ilmu Terapan, Universitas : Tel-U Jakarta" id="tooltip-filter"></i></div>
        @foreach(['2','3','4','5'] as $statusId)
        @if($statusId == 2)
        @can("ubah.lowongan.admin")
        <div id="div{{$statusId}}" class="col-xl-1 targetDiv" style="display: none;">

            <div class="col-md-4 col-12 mb-3 d-flex align-items-center justify-content-between">
                <form class="status-form d-flex" method=" POST" action="{{ route('kandidat.status') }}">
                    @csrf
                    <select class="form-select select2" data-placeholder="Ubah Status Kandidat" name="status">
                        <option value="" disabled selected>Ubah Status Kandidat</option>
                        <option value="tahap1">Tahap 1</option>
                        <option value="ditolak">Ditolak</option>
                    </select>

                    <button class="btn btn-success waves-effect waves-light mr-4" type="submit" style="min-width: 142px;"><i class="tf-icons ti ti-checks"> Terapkan</i>
                    </button>
                </form>
            </div>
        </div>
        @endcan
        @endif
        @endforeach
    </div>

    <!-- Modal Filter -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="modalfilter" aria-labelledby="offcanvasAddUserLabel">
        <div class="offcanvas-header">
            <h5 id="offcanvasAddUserLabel" class="offcanvas-title" style="padding-left: 15px;">Filter Berdasarkan</h5>
        </div>
        <div class="offcanvas-body mx-0 flex-grow-0 pt-0 h-100">
            <form class="add-new-user pt-0" id="filter">
                <div class="col-12 mb-2">
                    <div class="row">
                        <div class="col mb-2 form-input">
                            <label for="univ" class="form-label" style="padding-left: 15px;">Universitas</label>
                            <select class="form-select select2" id="univ" name="univ" data-placeholder="Pilih Universitas">
                                <option disabled selected>Pilih Universitas</option>
                            </select>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-2">
                            <label for="fakultas" class="form-label" style="padding-left: 15px;">Fakultas</label>
                            <select class="form-select select2" id="fakultas" name="fakultas" data-placeholder="Pilih Fakultas">
                                <option disabled selected>Pilih Fakultas</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-2 form-input">
                            <label for="univ" class="form-label" style="padding-left: 15px;">Prodi</label>
                            <select class="form-select select2" id="prodi" name="prodi" data-placeholder="Pilih Prodi">
                                <option disabled selected>Pilih Prodi</option>
                            </select>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="row cnt">
                        <div id="div1" class="targetDiv">
                            <div class="col mb-2 form-input">
                                <label for="univ" class="form-label" style="padding-left: 15px;">Status Kandidat</label>
                                <select class="form-select select2" id="status" name="status" data-placeholder="Status Kandidat">
                                    <option disabled selected>Pilih Status Kandidat</option>
                                    <option>Screening</option>
                                    <option>Seleksi Tahap 1</option>
                                    <option>Seleksi Tahap 2</option>
                                    <option>Penawaran</option>
                                    <option>Diterima</option>
                                    <option>Ditolak</option>
                                </select>
                                <div class="invalid-feedback"></div>
                            </div>
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

    <div class="tab-content p-0">
        @foreach(['kandidat', 'screening','tahap1','tahap2','tahap3','penawaran','diterima','ditolak'] as $tableId)
        <div class="tab-pane fade show {{$loop->iteration == 1 ? 'active' : ''}}" id="navs-pills-justified-{{$tableId}}" role="tabpanel">
            <div class="card">
                <div class="row mt-3 ms-2">
                    <div class="col-6 d-flex align-items-center" style="border: 2px solid #D3D6DB; max-width:420px; height:40px;border-radius:8px;">
                        <span style="color:#4B465C;">Total Kandidat {{$pendaftar->lowonganMagang->intern_position ?? $lowongan->intern_position}}:</span>&nbsp;<span style="color:#7367F0;">{{$total['kandidat'] ?? "0"}}</span>&nbsp;<span style="color:#4EA971;"> Kandidat Melamar </span>
                    </div>
                    <div class="col-6 d-flex align-items-center justify-content-end" style="margin-left:180px;">
                        <span style="color:#4B465C;">Batas Konfirmasi Penerimaan :</span>&nbsp;<span style="color:#4EA971;">{{($lowongan->date_confirm_closing?->format('d-m-Y') ?? 'Masukan batas konfirmasi penerimaan')}}</span>
                    </div>
                </div>

                <div class="card-datatable table-responsive">
                    <table class="table tab1c" id="{{$tableId}}" style="width: 100%;">
                        <thead>
                            <tr>
                                @can("only.lkm")
                                <th style="min-width: auto;">SELECT</th>
                                @endcan
                                <th style="min-width: auto;">NOMOR</th>
                                <th style="min-width:100px;">NAMA</th>
                                <th style="min-width:150px;">TANGGAL DAFTAR</th>
                                <th style="min-width:100px;">NO TELEPON </th>
                                <th style="min-width:150px;">EMAIL</th>
                                <th style="min-width:150px;">PROGRAM STUDI</th>
                                <th style="min-width:100px;">FAKULTAS</th>
                                <th style="min-width:150px;">UNIVERSITAS</th>
                                <th style="min-width:100px;">STATUS</th>
                                <th style="min-width:100px;">AKSI</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
        @endforeach

    </div>

    @endsection

    @section('page_script')
    <script src="{{ asset('app-assets/vendor/libs/jquery-repeater/jquery-repeater.js')}}"></script>
    <script src="{{ asset('app-assets/js/forms-extras.js')}}"></script>
    <script>
        // var jsonData = [{
        //         "nomor": "1",
        //         "nama": "Andika Alatas 6701228083",
        //         "no": "+6281298076589",
        //         "email": "dikta@gmail.com",
        //         "prodi": "D3 Sistem Informasi",
        //         "fakultas": "Ilmu Terapan",
        //         "universitas": "Telkom Bandung",
        //         "status": "<span class='badge bg-label-secondary me-1'>Belum Proses</span>",
        //         "aksi": "<a data-bs-toggle='offcanvas' data-bs-target='#modalslide' class='btn-icon text-success waves-effect waves-light'><i class='tf-icons ti ti-file-invoice' ></i><a onclick = active($(this))  class='btn-icon text-danger waves-effect waves-light'><i class='tf-icons ti ti-trash'></i></a>"
        //     },
        //     {
        //         "nomor": "2",
        //         "nama": "Andika Alatas 6701228083",
        //         "no": "+6281298076589",
        //         "email": "dikta@gmail.com",
        //         "prodi": "D3 Sistem Informasi",
        //         "fakultas": "Ilmu Terapan",
        //         "universitas": "Telkom Bandung",
        //         "status": "<span class='badge bg-label-warning me-1'>Screening</span>",
        //         "aksi": "<a data-bs-toggle='offcanvas' data-bs-target='#modalslide' class='btn-icon text-success waves-effect waves-light'><i class='tf-icons ti ti-file-invoice' ></i><a onclick = active($(this))  class='btn-icon text-danger waves-effect waves-light'><i class='tf-icons ti ti-trash'></i></a>"
        //     },
        //     {
        //         "nomor": "3",
        //         "nama": "Andika Alatas 6701228083",
        //         "no": "+6281298076589",
        //         "email": "dikta@gmail.com",
        //         "prodi": "D3 Sistem Informasi",
        //         "fakultas": "Ilmu Terapan",
        //         "universitas": "Telkom Bandung",
        //         "status": "<span class='badge bg-label-success me-1'>Diterima</span>",
        //         "aksi": "<a data-bs-toggle='offcanvas' data-bs-target='#modalslide' class='btn-icon text-success waves-effect waves-light'><i class='tf-icons ti ti-file-invoice' ></i><a onclick = active($(this))  class='btn-icon text-danger waves-effect waves-light'><i class='tf-icons ti ti-trash'></i></a>"
        //     },
        //     {
        //         "nomor": "4",
        //         "nama": "Andika Alatas 6701228083",
        //         "no": "+6281298076589",
        //         "email": "dikta@gmail.com",
        //         "prodi": "D3 Sistem Informasi",
        //         "fakultas": "Ilmu Terapan",
        //         "universitas": "Telkom Bandung",
        //         "status": "<span class='badge bg-label-danger me-1'>Ditolak</span>",
        //         "aksi": "<a data-bs-toggle='offcanvas' data-bs-target='#modalslide' class='btn-icon text-success waves-effect waves-light'><i class='tf-icons ti ti-file-invoice' ></i><a onclick = active($(this))  class='btn-icon text-danger waves-effect waves-light'><i class='tf-icons ti ti-trash'></i></a>"
        //     },
        //     {
        //         "nomor": "5",
        //         "nama": "Andika Alatas 6701228083",
        //         "no": "+6281298076589",
        //         "email": "dikta@gmail.com",
        //         "prodi": "D3 Sistem Informasi",
        //         "fakultas": "Ilmu Terapan",
        //         "universitas": "Telkom Bandung",
        //         "status": "<span class='badge bg-label-info me-1'>Penawaran</span>",
        //         "aksi": "<a data-bs-toggle='offcanvas' data-bs-target='#modalslide' class='btn-icon text-success waves-effect waves-light'><i class='tf-icons ti ti-file-invoice' ></i><a onclick = active($(this))  class='btn-icon text-danger waves-effect waves-light'><i class='tf-icons ti ti-trash'></i></a>"
        //     },
        //     {
        //         "nomor": "6",
        //         "nama": "Andika Alatas 6701228083",
        //         "no": "+6281298076589",
        //         "email": "dikta@gmail.com",
        //         "prodi": "D3 Sistem Informasi",
        //         "fakultas": "Ilmu Terapan",
        //         "universitas": "Telkom Bandung",
        //         "status": "<span class='badge bg-label-primary me-1'>Seleksi Tahap 1</span>",
        //         "aksi": "<a data-bs-toggle='offcanvas' data-bs-target='#modalslide' class='btn-icon text-success waves-effect waves-light'><i class='tf-icons ti ti-file-invoice' ></i><a onclick = active($(this))  class='btn-icon text-danger waves-effect waves-light'><i class='tf-icons ti ti-trash'></i></a>"
        //     },
        //     {
        //         "nomor": "7",
        //         "nama": "Andika Alatas 6701228083",
        //         "no": "+6281298076589",
        //         "email": "dikta@gmail.com",
        //         "prodi": "D3 Sistem Informasi",
        //         "fakultas": "Ilmu Terapan",
        //         "universitas": "Telkom Bandung",
        //         "status": "<span class='badge bg-label-dark me-1'>Seleksi Tahap 2</span>",
        //         "aksi": "<a data-bs-toggle='offcanvas' data-bs-target='#modalslide' class='btn-icon text-success waves-effect waves-light'><i class='tf-icons ti ti-file-invoice' ></i><a onclick = active($(this))  class='btn-icon text-danger waves-effect waves-light'><i class='tf-icons ti ti-trash'></i></a>"
        //     }
        // ];

        $('.table').each(function() {
            let idElement = $(this).attr('id');
            let idLowongan = `{{$pendaftar->id_lowongan ?? 0}}`;
            let url = `{{ url('/informasi/kandidat/show/${idLowongan}') }}?type=` + idElement;
            if ($(this).attr('id') == null) return;
            // console.log(idElement);
            // console.log(url);
            // console.log(idLowongan);


            $(this).DataTable({
                ajax: url,
                serverSide: false,
                processing: true,
                deferRender: true,
                type: 'GET',
                columns: [
                    @can("only.lkm") {
                        data: "check"
                    },
                    @endcan {
                        data: "DT_RowIndex",
                        name: 'nomor'
                    },
                    {
                        data: null,
                        name: 'combined_column',
                        render: function(data, type, row) {
                            return data.mahasiswa.namamhs + '<br>' + (data.mahasiswa.nim);
                        }
                    },
                    {
                        data: "tanggaldaftar",
                        name: 'tanggal_daftar'
                    },
                    {
                        data: "mahasiswa.nohpmhs",
                        name: 'nohp'
                    },

                    {
                        data: "mahasiswa.emailmhs",
                        name: 'email'
                    },
                    {
                        data: function(data, type, row) {
                            return data.mahasiswa.prodi.namaprodi;
                        },
                        name: 'prodi'
                    },
                    {
                        data: function(data, type, row) {
                            return data.mahasiswa.fakultas.namafakultas;
                        },
                        name: 'fakultas'
                    },
                    {
                        data: function(data, type, row) {
                            return data.mahasiswa.univ.namauniv;
                        },
                        name: 'univ'
                    },
                    {
                        data: "status"
                    },
                    {
                        data: "action"
                    }
                ]
            });

        });

        $(document).ready(function() {
            $('.form-select').select2();
        });

        jQuery(function() {
            jQuery('.showSingle').click(function() {
                let idElement = $(this).attr('target');

                jQuery('.targetDiv').hide('.cnt');
                jQuery("#div" + idElement).slideToggle();

                // console.log(idElement);
            });
        });

        function myFunction() {
            var dots = document.getElementById("dots");
            var moreText = document.getElementById("more");
            var btnText = document.getElementById("myBtn");
            https: //meet.google.com/bqa-trxd-gkg

                if (dots.style.display === "none") {
                    dots.style.display = "inline";
                    btnText.innerHTML = "Lebih Banyak";
                    moreText.style.display = "none";
                } else {
                    dots.style.display = "none";
                    btnText.innerHTML = "Lebih Sedikit";
                    moreText.style.display = "inline";
                }
        }


        $('.display').DataTable({
            responsive: true
        });

        $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
            $($.fn.dataTable.tables(true)).DataTable().columns.adjust().responsive.recalc();
        });

        document.getElementById("back").addEventListener("click", () => {
            history.back();
        });
    </script>

    <script src="{{ asset('app-assets/vendor/libs/sweetalert2/sweetalert2.js') }}"></script>
    <script src="{{ asset('app-assets/js/extended-ui-sweetalert2.js') }}"></script>

    @endsection