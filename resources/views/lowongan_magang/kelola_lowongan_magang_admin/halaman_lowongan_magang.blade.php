@extends('partials_admin.template')

@section('meta_header')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('page_style')
<link rel="stylesheet" href="../../app-assets/vendor/libs/sweetalert2/sweetalert2.css" />
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
</style>

@endsection

@section('main')
<div class="row">
    <div class="col-md-9 col-12">
        <h4 class="fw-bold">Kelola Lowongan-Tahun Ajaran 2324</h4>
    </div>
    <div class="col-md-3 col-12 mb-3 ps-5 d-flex align-items-center justify-content-between">
        <select class="select2 form-select" data-placeholder="Pilih Tahun Ajaran">
            <option value="1">2023/2024 Genap</option>
            <option value="2">2023/2024 Ganjil</option>
            <option value="3">2022/2023 Genap</option>
            <option value="4">2022/2023 Ganjil</option>
            <option value="5">2021/2022 Genap</option>
            <option value="6">2021/2022 Ganjil</option>
        </select>
        <button class="btn btn-success waves-effect waves-light" data-bs-toggle="offcanvas" data-bs-target="#modalSlide"><i class="tf-icons ti ti-filter"></i>
        </button>
        </div>
    </div>

<div class="col-xl-12">
    <div class="nav-align-top">
        <ul class="nav nav-pills " role="tablist">
            <li class="nav-item" style="font-size: small;">
                <button type="button" class="nav-link active showSingle" target="1" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-justified-dibuat" aria-controls="navs-pills-justified-dibuat" aria-selected="true" style="padding: 8px 9px;">
                    <i class="tf-icons ti ti-briefcase ti-xs me-2"></i> Dibuat
                    <span class="badge rounded-pill badge-center h-px-20 w-px-20 ms-1"style="background-color: #DCEEE3; color: #4EA971;">3</span>
                </button>
            </li>
            <li class="nav-item" style="font-size: small;">
                <button type="button" class="nav-link showSingle" target="3" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-justified-tertunda" aria-controls="navs-pills-justified-tertunda" aria-selected="false" style="padding: 8px 9px;">
                    <i class="tf-icons ti ti-clock ti-xs me-2"></i> Tertunda
                    <span class="badge rounded-pill badge-center h-px-20 w-px-20 ms-1" style="background-color: #DCEEE3; color: #4EA971;">2</span>
                </button>
            </li>
            <li class="nav-item" style="font-size: small;">
                <button type="button" class="nav-link showSingle" target="2" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-justified-disetujui" aria-controls="navs-pills-justified-disetujui" aria-selected="false" style="padding: 8px 9px;">
                    <i class="tf-icons ti ti-clipboard-check ti-xs me-2"></i>Disetujui
                    <span class="badge rounded-pill badge-center h-px-20 w-px-20 ms-1" style="background-color: #DCEEE3; color: #4EA971;">4</span>
                </button>
            </li>
            <li class="nav-item" style="font-size: small;">
                <button type="button" class="nav-link showSingle" target="2" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-justified-ditolak" aria-controls="navs-pills-justified-ditolak" aria-selected="false" style="padding: 8px 9px;">
                    <i class="tf-icons ti ti-clipboard-x ti-xs me-2"></i> Ditolak
                    <span class="badge rounded-pill badge-center h-px-20 w-px-20 ms-1" style="background-color: #DCEEE3; color: #4EA971;">1</span>
                </button>
            </li>
        </ul>
    </div>
</div>

   <div class="row mb-4">
    <div class="col-md-8 col-12 ">
    <div class="text-secondary mt-4">Filter Berdasarkan : <i class='tf-icons ti ti-alert-circle text-primary pb-1'
        data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Posisi Pekerjaan : -, Durasi Magang : -, Fakultas : -, Universitas : -" id="tooltip-filter"></i></div>
    </div>
        <div class="col-md-4 d-flex justify-content-end align-items-center">
            <a href='/tambah-lowongan-magang'>
                <button class="btn btn-success" type="button" data-bs-toggle="modal" data-bs-target="#modal-lowonganmagang">+ Tambah Lowongan
                Magang</button>
            </a>
        </div>
   </div>

    {{-- <div class="offcanvas offcanvas-end" tabindex="-1" id="modalSlide" aria-labelledby="offcanvasAddUserLabel">
        <div class="offcanvas-header">
            <h5 id="offcanvasAddUserLabel" class="offcanvas-title" style="padding-left: 15px;">Filter Berdasarkan</h5>
        </div>
        <div class="offcanvas-body mx-0 flex-grow-0 pt-0 h-100">
            <form class="add-new-user pt-0" id="filter">
                <div class="col-12 mb-2">
                    <div class="row">
                        <div class="col mb-2 form-input">
                            <label for="univ" class="form-label" style="padding-left: 15px;">Posisi Pekerjaan</label>
                            <select class="form-select select2" id="posisipekerjaan" name="posisi pekerjaan" data-placeholder="Pilih posisi pekerjaan">
                                <option disabled selected>Pilih Posisi Pekerjaan</option>
                            </select>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-2">
                            <label for="univ" class="form-label" style="padding-left: 15px;">Durasi Magang</label>
                            <select class="form-select select2" id="durasimagang" name="durasi magang" data-placeholder="Pilih Durasi Magang">
                                <option disabled selected>Pilih Durasi Magang</option>
                                <option value="1 Semester">1 Semester</option>
                                <option value="2 Semester">2 Semester</option>

                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-2 form-input">
                            <label for="fakultas" class="form-label" style="padding-left: 15px;">Fakultas</label>
                            <select class="form-select select2" id="fakultas" name="fakultas" data-placeholder="Input Fakultas">
                                <option disabled selected>Pilih Fakultas</option>
                                <option value="fakultas ilmu terapan">Fakultas Ilmu Terapan</option>
                                <option value="Fakultas Komunikasi Bisnis">Fakultas Komunikasi Bisnis</option>
                                <option value="Fakultas Industri Kreatif">Fakultas Industri Kreatif</option>
                                <option value="Fakultas Ekonomi Bisnis Bisnis">Fakultas Ekonomi Bisnis Bisnis</option>
                            </select>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="row cnt">
                        <div id="div1" class="targetDiv">
                            <div class="col mb-2 form-input">
                                <label for="univ" class="form-label" style="padding-left: 15px;">Program Studi</label>
                                <select class="form-select select2" id="programstudi" name="program studi" data-placeholder="Program Studi">
                                    <option disabled selected>Pilih Program Studi</option>
                                    <option value="D3 Rekayasa Perangkat Lunak Aplikasi">D3 Rekayasa Perangkat Lunak Aplikasi</option>
                                    <option value="D3 Sistem Informasi">D3 Sistem Informasi</option>
                                    <option value="D3 Teknologi Komputer">D3 Teknologi Komputer</option>
                                    <option value="D3 Teknologi Rekayasa Media">D3 Teknologi Rekayasa Media</option>
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
    </div> --}}

    <div class="tab-content p-0">
        <div class="tab-pane fade show active" id="navs-pills-justified-dibuat" role="tabpanel">
            <div class="card">
                <div class="row mt-3 ms-2">
                    <div class="border border-green-500 py-2 px-3 fw-semibold rounded-2 w-10 col-5" style="width: 300px;">
                        <span class="badge badge-center bg-label-success mr-10"><i class="ti ti-briefcase"></i></span>
                        Total lowongan : <span class="text-primary">50</span> <span
                            class="text-success">Lowongan</span>
                    </div>
                </div>
                <div class="card-datatable table-responsive">
                    <table class="table tab1c" id="table-dibuat" style="width: 100%;">
                        <thead>
                            <tr>
                                <th style="min-width: auto;">NOMOR</th>
                                <th style="min-width:100px;">POSISI</th>
                                <th style="min-width:100px;">FAKULTAS </th>
                                <th style="min-width:150px;">PROGRAM STUDI</th>
                                <th style="min-width:150px;">TANGGAL</th>
                                <th style="min-width:100px;">DURASI MAGANG</th>
                                <th style="min-width:100px;">STATUS</th>
                                <th style="min-width:100px;">AKSI</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>

        <div class="tab-pane fade" id="navs-pills-justified-tertunda" role="tabpanel">
            <div class="card">
                <div class="row mt-3 ms-2">
                    <div class="border border-green-500 py-2 px-3 fw-semibold rounded-2 w-10 col-5" style="width: 300px;">
                        <span class="badge badge-center bg-label-success mr-10"><i class="ti ti-briefcase"></i></span>
                        Total lowongan : <span class="text-primary">50</span> <span
                            class="text-success">Lowongan</span>
                    </div>
                </div>
                <div class="card-datatable table-responsive">
                    <table class="table tab1c" id="table-tertunda" style="width: 100% !important;">
                        <thead>
                            <tr>
                                <th style="min-width: auto;">NOMOR</th>
                                <th style="min-width:100px;">POSISI</th>
                                <th style="min-width:100px;">FAKULTAS </th>
                                <th style="min-width:150px;">PROGRAM STUDI</th>
                                <th style="min-width:150px;">TANGGAL</th>
                                <th style="min-width:100px;">DURASI MAGANG</th>
                                <th style="min-width:100px;">STATUS</th>
                                <th style="min-width:100px;">AKSI</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>

        <div class="tab-pane fade" id="navs-pills-justified-disetujui" role="tabpanel">
            <div class="card">
                <div class="row mt-3 ms-2">
                 <div class="border border-green-500 py-2 px-3 fw-semibold rounded-2 w-10 col-5" style="width: 300px;">
                        <span class="badge badge-center bg-label-success mr-10"><i class="ti ti-briefcase"></i></span>
                        Total lowongan : <span class="text-primary">50</span> <span
                            class="text-success">Lowongan</span>
                    </div>
                </div>
                <div class="card-datatable table-responsive">
                    <table class="table" id="table-disetujui">
                        <thead>
                            <tr>
                                <th></th>
                                <th></th>
                                <th style="min-width: auto;">NOMOR</th>
                                <th style="min-width:100px;">POSISI</th>
                                <th style="min-width:100px;">FAKULTAS </th>
                                <th style="min-width:150px;">PROGRAM STUDI</th>
                                <th style="min-width:150px;">TANGGAL</th>
                                <th style="min-width:100px;">DURASI MAGANG</th>
                                <th style="min-width:100px;">STATUS</th>
                                <th style="min-width:100px;">AKSI</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>

        <div class="tab-pane fade" id="navs-pills-justified-ditolak" role="tabpanel">
            <div class="card">
                <div class="row mt-3 ms-2">
                 <div class="border border-green-500 py-2 px-3 fw-semibold rounded-2 w-10 col-5" style="width: 300px;">
                        <span class="badge badge-center bg-label-success mr-10"><i class="ti ti-briefcase"></i></span>
                        Total lowongan : <span class="text-primary">50</span> <span
                            class="text-success">Lowongan</span>
                    </div>
                </div>
                <div class="card-datatable table-responsive">
                    <table class="table" id="table-ditolak">
                        <thead>
                            <tr>
                                <th></th>
                                <th></th>
                                <th style="min-width: auto;">NOMOR</th>
                                <th style="min-width:100px;">POSISI</th>
                                <th style="min-width:100px;">FAKULTAS </th>
                                <th style="min-width:150px;">PROGRAM STUDI</th>
                                <th style="min-width:150px;">TANGGAL</th>
                                <th style="min-width:100px;">DURASI MAGANG</th>
                                <th style="min-width:100px;">STATUS</th>
                                <th style="min-width:100px;">AKSI</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Alert-->
    <div class="modal fade" id="modalalert" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <img src="../../app-assets/img/alert.png" alt="">
                <h5 class="modal-title" id="modal-title">Apakah Anda Yakin Ingin Mengahapus Data?</h5>
                <div class="swal2-html-container" id="swal2-html-container" style="display: block;">Data yang dipilih akan dihapus secara permanen!</div>
                </div>
                    <div class="modal-footer" style="display: flex; justify-content:center;">
                        <button type="submit" id="modal-button" class="btn btn-success">Ya, yakin</button>
                        <button type="submit" id="modal-button" class="btn btn-danger">Batal</button>
                    </div>
            </div>
        </div>
    </div>
@endsection

@section('page_script')
<script>
    $("#modal-lowonganmagang").on("hide.bs.modal", function() {

    $("#modal-title").html("Tambah Lowongan Magang");
    $("#modal-button").html("Save Data");
    $('#modal-lowonganmagang form #mitra_add').val('').trigger('change');
    $('#modal-lowonganmagang form #tahunajaran_add').val('').trigger('change');
    $('#modal-lowonganmagang form #jenismagang_add').val('').trigger('change');
    $('#modal-lowonganmagang form #fakultas_add').val('').trigger('change');
    $('#modal-lowonganmagang form #informasilowongan_add').val('').trigger('change');
    $('#modal-lowonganmagang form #fakultas_add').val('').trigger('change');
    });

    function edit(e) {
    let id = e.attr('data-id');

    let action = `{{ url('kelola/lowongan/admin/update/') }}/${id}`;
    var url = `{{ url('kelola/lowongan/admin/edit/') }}/${id}`;
        $.ajax({
            type: 'GET',
            url: url,
            success: function(response) {
                $("#modal-title").html("Edit LowonganMangang");
                $("#modal-button").html("Update Data")
                $('#modal-lowonganmagang form').attr('action', action);
                $('#mitra_add').val(response.id_industis).change();
                $('#tahunajaran_add').val(response.id_year_Akademik).change();

                $('#jenismagang_add').val(response.id_jenismagang).change();

                $('#posisi').val(response.intern_position);
                $('#bidang').val(response.bidang);
                $('#durasimagang').val(response.durasimagang);
                $('#deskripsi').val(response.deskripsi);
                $('#kualifikasi').val(response.requirements);

                $('#kuotapenerimaan').val(response.kuota);
                $('#benefit').val(response.benefitmagang);
                $('#tanggalmulai').val(response.startdate);
                $('#tanggalakhir').val(response.enddate);
                $('#tahapan').val(response.tahapan_seleksi);
                $('#informasilowongan').val(response.date_confirm_closing).change();
                $('#programstudi').val(response.id_prodi).change();
                $('#fakultas_add').val(response.id_fakultas).change();

                $('#modal-lowonganmagang').modal('show');
            }
        });
    }


    var table = $('#table-dibuat').DataTable({
        ajax: '{{ route("lowongan-magang.show")}}',
        serverSide: false,
        processing: true,
        deferRender: true,
        type: 'GET',
        destroy: true,
        columns: [{
                data: 'DT_RowIndex'
            },
            {
                data: 'posisipekerjaan',
                name: 'posisipekerjaan'
            },
            {
                data: 'fakultas',
                name: 'fakultas'
            },
            {
                data: 'programstudi',
                name: 'programstudi'
            },
            {
                data: 'tanggal',
                name: 'tanggal'
            },
            {
                data: 'durasimagang',
                name: 'durasimagang'
            },
            {
                data: 'status',
                name: 'status'
            },
            {
                data: 'action',
                name: 'action'
            }
        ],
    });

    var table = $('#table-tertunda').DataTable({
        ajax: '{{ route("lowongan-magang.show")}}',
        serverSide: false,
        processing: true,
        deferRender: true,
        type: 'GET',
        destroy: true,
        columns: [{
            data: 'DT_RowIndex'
            },
            {
                data: 'posisipekerjaan',
                name: 'posisipekerjaan'
            },
            {
                data: 'fakultas',
                name: 'fakultas'
            },
            {
                data: 'programstudi',
                name: 'programstudi'
            },
            {
                data: 'tanggal',
                name: 'tanggal'
            },
            {
                data: 'durasimagang',
                name: 'durasimagang'
            },
            {
                data: 'status',
                name: 'status'
            },
            {
                data: 'action',
                name: 'action'
            }
        ],
    });


    var table = $('#table-disetujui').DataTable({
        ajax: '{{ route("lowongan-magang.show")}}',
        serverSide: false,
        processing: true,
        deferRender: true,
        type: 'GET',
        destroy: true,
        columns: [{
            data: 'DT_RowIndex'
            },
            {
                data: 'posisipekerjaan',
                name: 'posisipekerjaan'
            },
            {
                data: 'fakultas',
                name: 'fakultas'
            },
            {
                data: 'programstudi',
                name: 'programstudi'
            },
            {
                data: 'tanggal',
                name: 'tanggal'
            },
            {
                data: 'durasimagang',
                name: 'durasimagang'
            },
            {
                data: 'status',
                name: 'status'
            },
            {
                data: 'action',
                name: 'action'
            }
        ],
    });

    var table = $('#table-ditolak').DataTable({
        ajax: '{{ route("lowongan-magang.show")}}',
        serverSide: false,
        processing: true,
        deferRender: true,
        type: 'GET',
        destroy: true,
        columns: [{
            data: 'DT_RowIndex'
            },
            {
                data: 'posisipekerjaan',
                name: 'posisipekerjaan'
            },
            {
                data: 'fakultas',
                name: 'fakultas'
            },
            {
                data: 'programstudi',
                name: 'programstudi'
            },
            {
                data: 'tanggal',
                name: 'tanggal'
            },
            {
                data: 'durasimagang',
                name: 'durasimagang'
            },
            {
                data: 'status',
                name: 'status'
            },
            {
                data: 'action',
                name: 'action'
            }
        ],
    });
</script>

<script src="../../app-assets/vendor/libs/sweetalert2/sweetalert2.js"></script>
<script src="../../app-assets/js/extended-ui-sweetalert2.js"></script>

@endsection
