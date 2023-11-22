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

        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            color: #4EA971;
        }
    </style>
@endsection

@section('main')
    <div class="row">
        <div class="col-md-9 col-12">
            <h4 class="fw-bold">Jadwal Seleksi</h4>
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
            <button class="btn btn-success waves-effect" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#modalSlide"><i class="tf-icons ti ti-filter"></i></button>
        </div>

        <div class="col-md-1 col-12 text-end" style="width:50px;">
        </div>
        <div class="col-md-12 d-flex justify-content-end align-items-center mt-2 mb-4">
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalTambahJadwal">
                <div class="d-flex align-items-center">
                    <i class="tf-icons ti ti-plus me-2"></i>
                    <span class="mt-1">Jadwal Seleksi Lanjutan</span>
                </div>
            </button>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-12">
            <div class="card">
                <div class="card-datatable table-responsive">
                    <table class="table" id="table-jadwal-seleksi">
                        <thead>
                            <tr>
                                <th></th>
                                <th></th>
                                <th>NOMOR</th>
                                <th>NAMA</th>
                                <th>TANGGAL SELEKSI</th>
                                <th>WAKTU SELESAI</th>
                                <th>JENIS SELEKSI</th>
                                <th>PELAKSANAAN</th>
                                <th>STATUS</th>
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
        var jsonData = [{
                "id": "",
                "id": "",
                "nomor": "1",
                "nama": "<span class='fw-bold'>Andika Alatas</span> <br> 6701228083",
                "tanggal": "<span class='text-secondary'>Mulai</span><br>20 Juli 2023<br><span class='text-secondary'>Berakhir</span><br>22 Juli 2023",
                "waktu": "<span class='text-secondary'>Jam Dimulai</span><br>08.00<br><span class='text-secondary'>Jam Berakhir</span><br>23.59",
                "jenis": "Seleksi Tahap 1",
                "pelaksanaan": "Online",
                "status": "<span class='badge bg-label-success me-1'>Sudah Seleksi</span>",
                "aksi": "<a data-bs-toggle='modal' data-bs-target='#modalEditJadwal' class='btn-icon text-warning waves-effect waves-light'><i class='tf-icons ti ti-edit' ></i><a data-bs-toggle='modal' data-bs-target='#modalCVOnline' class='btn-icon text-success waves-effect waves-light'><i class='tf-icons ti ti-file-invoice' ></i>"
            },
            {
                "id": "",
                "id": "",
                "nomor": "2",
                "nama": "<span class='fw-bold'>Andika Alatas</span> <br> 6701228083",
                "tanggal": "<span class='text-secondary'>Mulai</span><br>20 Juli 2023<br><span class='text-secondary'>Berakhir</span><br>22 Juli 2023",
                "waktu": "<span class='text-secondary'>Jam Dimulai</span><br>08.00<br><span class='text-secondary'>Jam Berakhir</span><br>23.59",
                "jenis": "Seleksi Tahap 1",
                "pelaksanaan": "Onsite",
                "status": "<span class='badge bg-label-secondary me-1'>Belum Seleksi</span>",
                "aksi": "<a data-bs-toggle='modal' data-bs-target='#modalEditJadwal' class='btn-icon text-warning waves-effect waves-light'><i class='tf-icons ti ti-edit' ></i><a data-bs-toggle='modal' data-bs-target='#modalCV' class='btn-icon text-success waves-effect waves-light'><i class='tf-icons ti ti-file-invoice' ></i>"
            },
            {
                "id": "",
                "id": "",
                "nomor": "3",
                "nama": "<span class='fw-bold'>Andika Alatas</span> <br> 6701228083",
                "tanggal": "<span class='text-secondary'>Mulai</span><br>20 Juli 2023<br><span class='text-secondary'>Berakhir</span><br>22 Juli 2023",
                "waktu": "<span class='text-secondary'>Jam Dimulai</span><br>08.00<br><span class='text-secondary'>Jam Berakhir</span><br>23.59",
                "jenis": "Seleksi Tahap 1",
                "pelaksanaan": "Onsite",
                "status": "<span class='badge bg-label-success me-1'>Sudah Seleksi</span>",
                "aksi": "<a data-bs-toggle='modal' data-bs-target='#modalEditJadwal' class='btn-icon text-warning waves-effect waves-light'><i class='tf-icons ti ti-edit' ></i><a data-bs-toggle='modal' data-bs-target='#modalCV' class='btn-icon text-success waves-effect waves-light'><i class='tf-icons ti ti-file-invoice' ></i>"

            }
        ];
        var table = $('#table-jadwal-seleksi').DataTable({
            "data": jsonData,
            columns: [{
                    data: "id"
                },
                {
                    data: "id"
                },
                {
                    data: "nomor"
                },
                {
                    data: "nama"
                },
                {
                    data: "tanggal"
                },
                {
                    data: "waktu"
                },
                {
                    data: "jenis"
                },
                {
                    data: "pelaksanaan"
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
            ]
        });
    </script>


    <script src="../../app-assets/vendor/libs/sweetalert2/sweetalert2.js"></script>
    <script src="../../app-assets/js/extended-ui-sweetalert2.js"></script>
@endsection
