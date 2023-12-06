@extends('partials_admin.template')

@section('meta_header')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

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

        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            color: #4EA971;
        }

        .bootstrap-select .dropdown-menu.inner a[aria-selected=true] {
            background: #4EA971 !important;
        }

        .dropdown-toggle:after {
            display: none;
        }

        .dropdown-toggle::before {
            display: inline-block !important;
            margin-right: 0.5em !important;
            vertical-align: middle !important;
            content: "" !important;
            margin-top: -0.28em !important;
            width: 0.42em !important;
            height: 0.42em !important;
            border: 1px solid !important;
            border-top: 0 !important;
            border-left: 0 !important;
            transform: rotate(45deg) !important;
        }

        .bootstrap-select .dropdown-menu a:not([href]):not(.active):not(:active):not(.selected):hover {
            color: #4EA971 !important;
        }
    </style>
@endsection

@section('main')
    <div class="row">
        <div class="col-md-9 col-12">
            <h4 class="fw-bold"><span class="text-muted fw-light">Jadwal Seleksi / </span>Posisi UI/UX Designer - 2023/2024 -
                Ganjil</h4>
        </div>
        <div class="col-md-3 col-12 mb-3 d-flex justify-content-end align-items-center">
            <select class="select2 form-select" data-placeholder="Pilih Tahun Ajaran">
                <option value="1">2023/2024 Genap</option>
                <option value="2">2023/2024 Ganjil</option>
                <option value="3">2022/2023 Genap</option>
                <option value="4">2022/2023 Ganjil</option>
                <option value="5">2021/2022 Genap</option>
                <option value="6">2021/2022 Ganjil</option>
            </select>
            <div class="ps-3">
                <button class="btn btn-success waves-effect" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#modalSlide"><i class="tf-icons ti ti-filter"></i></button>
            </div>
        </div>
        <div class="nav-align-top">
            <div class="row">
                <div class="col-6">
                    <ul class="nav nav-pills mb-3 " role="tablist">
                        <li class="nav-item" style="font-size: small;">
                            <button type="button" class="nav-link active showSingle" target="2" role="tab"
                                data-bs-toggle="tab" data-bs-target="#navs-pills-justified-tahap1"
                                aria-controls="navs-pills-justified-tahap1" aria-selected="false" style="padding: 8px 9px;">
                                <i class="tf-icons ti ti-device-desktop-analytics ti-xs me-1"></i> Seleksi Tahap 1
                                <span class="badge rounded-pill badge-center h-px-20 w-px-20 ms-1"
                                    style="background-color: #DCEEE3; color: #4EA971;">1</span>
                            </button>
                        </li>
                        <li class="nav-item" style="font-size: small;">
                            <button type="button" class="nav-link showSingle" target="2" role="tab"
                                data-bs-toggle="tab" data-bs-target="#navs-pills-justified-tahap2"
                                aria-controls="navs-pills-justified-tahap2" aria-selected="false" style="padding: 8px 9px;">
                                <i class="tf-icons ti ti-device-desktop-analytics ti-xs me-1"></i> Seleksi Tahap 2
                                <span class="badge rounded-pill badge-center h-px-20 w-px-20 ms-1"
                                    style="background-color: #DCEEE3; color: #4EA971;">1</span>
                            </button>
                        </li>
                        <li class="nav-item" style="font-size: small;">
                            <button type="button" class="nav-link showSingle" target="2" role="tab"
                                data-bs-toggle="tab" data-bs-target="#navs-pills-justified-tahap3"
                                aria-controls="navs-pills-justified-tahap3" aria-selected="false"
                                style="padding: 8px 9px;">
                                <i class="tf-icons ti ti-device-desktop-analytics ti-xs me-1"></i> Seleksi Tahap 3
                                <span class="badge rounded-pill badge-center h-px-20 w-px-20 ms-1"
                                    style="background-color: #DCEEE3; color: #4EA971;">2</span>
                            </button>
                        </li>
                    </ul>
                </div>
                <div class="col-6 text-end">
                    <div class="col-md-12 d-flex justify-content-end align-items-center mt-2 mb-3">
                        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalTambahJadwal">
                            <div class="d-flex align-items-center">
                                <i class="tf-icons ti ti-plus me-2"></i>
                                <span class="mt-1">Buat Jadwal Seleksi Lanjutan</span>
                            </div>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12 d-flex justify-content-end align-items-center mt-2 mb-4">
            <div class="dropdown bootstrap-select">
                <select id="selectpickerBasic" class="selectpicker " data-style="btn-default">
                    <option disabled selected>Ubah Status Kandidat</option>
                    <option value="Sudah Seleksi Tahap 1">Sudah Seleksi</option>
                    <option value="Belum Seleksi Tahap 1">Belum Seleksi</option>
                </select>
            </div>
            <div class="ps-3">
                <button class="btn btn-success waves-effect" type="button"><i
                        class="tf-icons ti ti-checks me-2"></i>Terapkan</button>
            </div>
        </div>
    </div>

    <div class="tab-content p-0">
        <div class="tab-pane fade show active" id="navs-pills-justified-tahap1" role="tabpanel">
            <div class="card">
                <div class="card-datatable table-responsive">
                    <table class="table tab1c" id="table-jadwal-seleksi">
                        <thead>
                            <tr>
                                <th></th>
                                <th></th>
                                <th>NOMOR</th>
                                <th style="min-width:100px;">NAMA</th>
                                <th>TANGGAL DAFTAR</th>
                                <th>TANGGAL SELEKSI</th>
                                <th>WAKTU SELEKSI</th>
                                <th style="min-width:100px;">PELAKSANAAN</th>
                                <th style="min-width:100px;">STATUS</th>
                                <th style="min-width:100px;">AKSI</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>

        <div class="tab-pane fade show" id="navs-pills-justified-tahap2" role="tabpanel">
            <div class="card">
                <div class="card-datatable table-responsive">
                    <table class="table tab1c" id="table-jadwal-seleksi-tahap2">
                        <thead>
                            <tr>
                                <th></th>
                                <th></th>
                                <th>NOMOR</th>
                                <th style="min-width:100px;">NAMA</th>
                                <th>TANGGAL DAFTAR</th>
                                <th>TAHAPAN SELEKSI</th>
                                <th>TANGGAL SELEKSI</th>
                                <th>WAKTU SELEKSI</th>
                                <th style="min-width:100px;">PELAKSANAAN</th>
                                <th style="min-width:100px;">STATUS</th>
                                <th style="min-width:100px;">AKSI</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>

        <div class="tab-pane fade show" id="navs-pills-justified-tahap3" role="tabpanel">
            <div class="card">
                <div class="card-datatable table-responsive">
                    <table class="table tab1c" id="table-jadwal-seleksi-tahap3">
                        <thead>
                            <tr>
                                <th></th>
                                <th></th>
                                <th>NOMOR</th>
                                <th style="min-width:100px;">NAMA</th>
                                <th>TANGGAL DAFTAR</th>
                                <th>TAHAPAN SELEKSI</th>
                                <th>TANGGAL SELEKSI</th>
                                <th>WAKTU SELEKSI</th>
                                <th style="min-width:100px;">PELAKSANAAN</th>
                                <th style="min-width:100px;">STATUS</th>
                                <th style="min-width:100px;">AKSI</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @include('company.jadwal_seleksi.modal')
@endsection

@section('page_script')
    <script src="../../app-assets/vendor/libs/jquery-repeater/jquery-repeater.js"></script>
    <script src="../../app-assets/js/forms-extras.js"></script>

    <script>
        $("#modalTambahJadwal").on("hide.bs.modal", function() {
            $(".modal-title").html("Tambah Jadwal Seleksi Lanjutan");
            $("#modal-button").html("Save Data");
            $('#modalTambahJadwal form')[0].reset();
            $('#modalTambahJadwal form #pelaksanaan').val('').trigger('change');
            $('#modalTambahJadwal form').attr('action', "{{ url('jadwal-seleksi/store') }}");
            $('.invalid-feedback').removeClass('d-block');
            $('.form-control').removeClass('is-invalid');
        });

        function edit(e) {
            let id = e.attr('data-id');

            let action = `{{ url('jadwal-seleksi/update/') }}/${id}`;
            var url = `{{ url('jadwal-seleksi/edit/') }}/${id}`;
            $.ajax({
                type: 'GET',
                url: url,
                success: function(response) {
                    $(".modal-title").html("Edit Jadwal Seleksi Lanjutan");
                    $("#modal-button").html("Update Data");
                    $('#modalTambahJadwal form').attr('action', action);
                    $('#nama').val(response.id_pendaftaran);
                    $('#pelaksanaan').val(response.pelaksanaan).trigger('change');
                    $('#mulai').val(response.tglseleksi);
                    $('#waktu').val(response.jamseleksi);
                    $('#tempat').val(response.detail);

                    $('#modalTambahJadwal').modal('show');
                }
            });
        }

        // var jsonData = [{
        //         "id": "",
        //         "id": "",
        //         "nomor": "1",
        //         "nama": "<span class='fw-bold'>Andika Alatas</span> <br> 6701228083",
        //         "tanggal_pendaftaran": "14 Juni 2023",
        //         "tanggal": "20 Juli 2023",
        //         "waktu": "08.00",
        //         "pelaksanaan": "Online",
        //         "status": "<span class='badge bg-label-success me-1'>Sudah Seleksi</span>",
        //         "aksi": "<a data-bs-toggle='modal' data-bs-target='#modalEditJadwal' class='btn-icon text-warning waves-effect waves-light'><i class='tf-icons ti ti-edit' ></i><a data-bs-toggle='modal' data-bs-target='#modalCVOnline' class='btn-icon text-success waves-effect waves-light'><i class='tf-icons ti ti-file-invoice' ></i>"
        //     },
        //     {
        //         "id": "",
        //         "id": "",
        //         "nomor": "2",
        //         "nama": "<span class='fw-bold'>Andika Alatas</span> <br> 6701228083",
        //         "tanggal_pendaftaran": "14 Juni 2023",
        //         "tanggal": "20 Juli 2023",
        //         "waktu": "08.00",
        //         "pelaksanaan": "Onsite",
        //         "status": "<span class='badge bg-label-secondary me-1'>Belum Seleksi</span>",
        //         "aksi": "<a data-bs-toggle='modal' data-bs-target='#modalEditJadwal' class='btn-icon text-warning waves-effect waves-light'><i class='tf-icons ti ti-edit' ></i><a data-bs-toggle='modal' data-bs-target='#modalCV' class='btn-icon text-success waves-effect waves-light'><i class='tf-icons ti ti-file-invoice' ></i>"
        //     },
        //     {
        //         "id": "",
        //         "id": "",
        //         "nomor": "3",
        //         "nama": "<span class='fw-bold'>Andika Alatas</span> <br> 6701228083",
        //         "tanggal_pendaftaran": "14 Juni 2023",
        //         "tanggal": "20 Juli 2023",
        //         "waktu": "08.00",
        //         "pelaksanaan": "Onsite",
        //         "status": "<span class='badge bg-label-success me-1'>Sudah Seleksi</span>",
        //         "aksi": "<a data-bs-toggle='modal' data-bs-target='#modalEditJadwal' class='btn-icon text-warning waves-effect waves-light'><i class='tf-icons ti ti-edit' ></i><a data-bs-toggle='modal' data-bs-target='#modalCV' class='btn-icon text-success waves-effect waves-light'><i class='tf-icons ti ti-file-invoice' ></i>"

        //     }
        // ];
        var table = $('#table-jadwal-seleksi').DataTable({
            ajax: {
                url: "{{ url('jadwal-seleksi/show') }}",
                type: 'POST',
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                }
            },
            columns: [{
                    data: "id_seleksi"
                },
                {
                    data: "id_seleksi"
                },
                {
                    data: "DT_RowIndex"
                },
                {
                    data: "id_pendaftaran",
                    name: "id_pendaftaran"
                },
                {
                    data: "tanggaldaftar",
                    name: "tanggaldaftar"
                },
                {
                    data: "tglseleksi",
                    name: "mulai"
                },
                {
                    data: "jamseleksi",
                    name: "waktu"
                },
                {
                    data: "pelaksanaan",
                    name: "pelaksanaan"
                },
                {
                    data: "status"
                },
                {
                    data: "action"
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
            ]
        });

        var table = $('#table-jadwal-seleksi-tahap2').DataTable({
        });

        var table = $('#table-jadwal-seleksi-tahap3').DataTable({
        });
    </script>


    <script src="../../app-assets/vendor/libs/sweetalert2/sweetalert2.js"></script>
    <script src="../../app-assets/js/extended-ui-sweetalert2.js"></script>
@endsection
