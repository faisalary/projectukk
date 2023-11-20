@extends('partials_admin.template')

@section('meta_header')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('page_style')
    <link rel="stylesheet" href="../../app-assets/vendor/libs/sweetalert2/sweetalert2.css" />
    <style>

    </style>
@endsection

@section('main')
    <div class="row">
        <div class="col-md-6 col-12">
            <h4 class="fw-bold"><span class="text-muted fw-light">Mitra /</span> Kelola Mitra</h4>
        </div>
        <div class="col-md-6 col-12 text-end">
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalTambahMitra">Tambah Mitra</button>
        </div>
    </div>
    <div class="col-xl-12">
        <div class="nav-align-top">
            <ul class="nav nav-pills mb-3 " role="tablist">
                <li class="nav-item">
                    <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                        data-bs-target="#navs-pills-justified-users" aria-controls="navs-pills-justified-users"
                        aria-selected="true">
                        <i class="tf-icons ti ti-users ti-xs me-1"></i> Created
                        {{-- <span class="badge rounded-pill badge-center h-px-20 w-px-20 bg-success ms-1">3</span> --}}
                    </button>
                </li>
                <li class="nav-item">
                    <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                        data-bs-target="#navs-pills-justified-pending" aria-controls="navs-pills-justified-pending"
                        aria-selected="false">
                        <i class="tf-icons ti ti-clock ti-xs me-1"></i> Pending
                        {{-- <span class="badge rounded-pill badge-center h-px-20 w-px-20 bg-success ms-1">2</span> --}}
                    </button>
                </li>
                <li class="nav-item">
                    <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                        data-bs-target="#navs-pills-justified-verified" aria-controls="navs-pills-justified-verified"
                        aria-selected="false">
                        <i class="tf-icons ti ti-user-check ti-xs me-1"></i> Verified
                        {{-- <span class="badge rounded-pill badge-center h-px-20 w-px-20 bg-success ms-1">4</span> --}}
                    </button>
                </li>
                <li class="nav-item">
                    <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                        data-bs-target="#navs-pills-justified-rejected" aria-controls="navs-pills-justified-rejected"
                        aria-selected="false">
                        <i class="tf-icons ti ti-user-x ti-xs me-1"></i> Rejected
                        {{-- <span class="badge rounded-pill badge-center h-px-20 w-px-20 bg-success ms-1">1</span> --}}
                    </button>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade show active" id="navs-pills-justified-users" role="tabpanel">
                    <div class="card-datatable table-responsive">
                        <table class="table" id="table-kelola-mitra1">
                            <thead>
                                <tr>
                                    <th>NOMOR</th>
                                    <th style="min-width: 100px;">NAMA</th>
                                    <th>EMAIL</th>
                                    <th>NOMOR TELEPON</th>
                                    <th>ALAMAT</th>
                                    <th>DESKRIPSI PERUSAHAAN</th>
                                    <th>KATEGORI MITRA</th>
                                    <th>STATUS KERJASAMA</th>
                                </tr>
                            </thead>
                        </table>
                    </div>

                </div>
                <div class="tab-pane fade" id="navs-pills-justified-pending" role="tabpanel">
                    <div class="card-datatable table-responsive">
                        <table class="table" id="table-kelola-mitra2">
                            <thead>
                                <tr>
                                    <th>NOMOR</th>
                                    <th style="min-width: 100px;">NAMA</th>
                                    <th>EMAIL</th>
                                    <th style="min-width: 120px;">NOMOR TELEPON</th>
                                    <th>ALAMAT</th>
                                    <th>DESKRIPSI PERUSAHAAN</th>
                                    <th>KATEGORI MITRA</th>
                                    <th>STATUS KERJASAMA</th>
                                    <th>AKSI</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>

                <div class="tab-pane fade" id="navs-pills-justified-verified" role="tabpanel">
                    <div class="card-datatable table-responsive">
                        <table class="table" id="table-kelola-mitra3">
                            <thead>
                                <tr>
                                    <th>NOMOR</th>
                                    <th style="min-width: 100px;">NAMA</th>
                                    <th>EMAIL</th>
                                    <th style="min-width: 120px;">NOMOR TELEPON</th>
                                    <th>ALAMAT</th>
                                    <th style="min-width: 100px;">DESKRIPSI PERUSAHAAN</th>
                                    <th>KATEGORI MITRA</th>
                                    <th>STATUS KERJASAMA</th>
                                    <th>STATUS</th>
                                    <th>AKSI</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                <div class="tab-pane fade" id="navs-pills-justified-rejected" role="tabpanel">
                    <p>
                    <div class="card-datatable table-responsive">
                        <table class="table" id="table-kelola-mitra4">
                            <thead>
                                <tr>
                                    <th>NOMOR</th>
                                    <th style="min-width: 100px;">NAMA</th>
                                    <th>EMAIL</th>
                                    <th style="min-width: 120px;">NOMOR TELEPON</th>
                                    <th style="min-width: 140px;">ALAMAT</th>
                                    <th>DESKRIPSI PERUSAHAAN</th>
                                    <th style="min-width: 100px;">KATEGORI MITRA</th>
                                    <th>STATUS KERJASAMA</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('company.kelola_mitra.modal')
@endsection

@section('page_script')
    <script src="../../app-assets/vendor/libs/jquery-repeater/jquery-repeater.js"></script>
    <script src="../../app-assets/js/forms-extras.js"></script>
    <script>
        $("#modalTambahProdi").on("hide.bs.modal", function() {


            $("#simpanButton").html("Save Data");
        });
        var table = $('#table-kelola-mitra1').DataTable({
            ajax: "{{ route('kelola_mitra.show') }}",
            serverSide: false,
            processing: true,
            deferRender: true,
            type: 'GET',
            destroy: true,
            columns: [{
                    data: 'DT_RowIndex'
                },

                {
                    data: 'namaindustri',
                    name: 'namaindustri'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'notelepon',
                    name: 'notelepon'
                },
                {
                    data: 'alamatindustri',
                    name: 'alamatindustri'
                },
                {
                    data: 'description',
                    name: 'description'
                },
                {
                    data: 'kategori_industri',
                    name: 'kategori_industri'
                },
                {
                    data: 'statuskerjasama',
                    name: 'statuskerjasama'
                }
            ]
        });
    </script>

    <script>
        var table = $('#table-kelola-mitra2').DataTable({
            ajax: "{{ route('kelola_mitra.show') }}",
            serverSide: false,
            processing: true,
            deferRender: true,
            type: 'GET',
            destroy: true,
            columns: [{
                    data: 'DT_RowIndex'
                },

                {
                    data: 'namaindustri',
                    name: 'namaindustri'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'notelepon',
                    name: 'notelepon'
                },
                {
                    data: 'alamatindustri',
                    name: 'alamatindustri'
                },
                {
                    data: 'description',
                    name: 'description'
                },
                {
                    data: 'kategori_industri',
                    name: 'kategori_industri'
                },
                {
                    data: 'statuskerjasama',
                    name: 'statuskerjasama'
                },
                {
                    data: 'action',
                    name: 'action'
                }

            ]
        });
    </script>

    <script>
        var table = $('#table-kelola-mitra3').DataTable({
            ajax: "{{ route('kelola_mitra.show') }}",
            serverSide: false,
            processing: true,
            deferRender: true,
            type: 'GET',
            destroy: true,
            columns: [{
                    data: 'DT_RowIndex'
                },

                {
                    data: 'namaindustri',
                    name: 'namaindustri'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'notelepon',
                    name: 'notelepon'
                },
                {
                    data: 'alamatindustri',
                    name: 'alamatindustri'
                },
                {
                    data: 'description',
                    name: 'description'
                },
                {
                    data: 'kategori_industri',
                    name: 'kategori_industri'
                },
                {
                    data: 'statuskerjasama',
                    name: 'statuskerjasama'
                },
                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'action',
                    name: 'action'
                }
            ]
        });
    </script>

    <script>
        var table = $('#table-kelola-mitra4').DataTable({
            ajax: "{{ route('kelola_mitra.show') }}",
            serverSide: false,
            processing: true,
            deferRender: true,
            type: 'GET',
            destroy: true,
            columns: [{
                    data: 'DT_RowIndex'
                },

                {
                    data: 'namaindustri',
                    name: 'namaindustri'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'notelepon',
                    name: 'notelepon'
                },
                {
                    data: 'alamatindustri',
                    name: 'alamatindustri'
                },
                {
                    data: 'description',
                    name: 'description'
                },
                {
                    data: 'kategori_industri',
                    name: 'kategori_industri'
                },
                {
                    data: 'statuskerjasama',
                    name: 'statuskerjasama'
                }
            ]
        });
    </script>

    <script src="../../app-assets/vendor/libs/sweetalert2/sweetalert2.js"></script>
    <script src="../../app-assets/js/extended-ui-sweetalert2.js"></script>
@endsection
