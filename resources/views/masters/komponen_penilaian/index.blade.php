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

        .trash-icon {
            border: 2px solid red;
            border-radius: 5px;
            padding: 3px;
        }
    </style>
@endsection

@section('main')
    <div class="row">
        <div class="col-md-6 col-12">
            <h4 class="fw-bold"><span class="text-muted fw-light">Master Data /</span> Komponen Penilaian</h4>
        </div>
        <div class="col-md-6 col-12 text-end">
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modal-komponen-nilai">Tambah Komponen
                Penilaian</button>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-12">
            <div class="card">
                <div class="card-datatable table-responsive">
                    <table class="table" id="table-master-komponen">
                        <thead>
                            <tr>
                                <th>NOMOR</th>
                                <th>JENIS MAGANG</th>
                                <th>NAMA KOMPONEN</th>
                                <th>DINILAI OLEH</th>
                                <th>BOBOT</th>
                                <th>TOTAL BOBOT</th>
                                <th>STATUS</th>
                                <th style="min-width:100px;">AKSI</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    @include('masters.komponen_penilaian.modal')


@endsection

@section('page_script')
    <script src="../../app-assets/vendor/libs/sweetalert2/sweetalert2.js"></script>
    <script src="../../app-assets/js/extended-ui-sweetalert2.js"></script>
    <script>
        var jsonData = [{
                "nomor": "1",
                "jenis magang": "Magang Fakultas",
                "nama komponen": "Sikap",
                "dinilai oleh": "Pembimbing Lapangan",
                "bobot": "20%",
                "total bobot": "",
                "status": "<span class='badge bg-label-success'>Aktif</span>",
                "aksi": "<a data-bs-toggle='modal' data-bs-target='#modalEditKomponen' class='btn-icon text-warning waves-effect waves-light'><i class='tf-icons ti ti-edit' ></i></a> <a onclick = deactive($(this))  class='btn-icon text-danger waves-effect waves-light'><i class='tf-icons ti ti-circle-x'></i></a>"
            },
            {
                "nomor": "",
                "jenis magang": "",
                "nama komponen": "Kehadiran",
                "dinilai oleh": "Pembimbing Lapangan",
                "bobot": "20%",
                "total bobot": "",
                "status": "<span class='badge bg-label-success'>Aktif</span>",
                "aksi": "<a data-bs-toggle='modal' data-bs-target='#modalEditKomponen' class='btn-icon text-warning waves-effect waves-light'><i class='tf-icons ti ti-edit' ></i></a> <a onclick = deactive($(this))  class='btn-icon text-danger waves-effect waves-light'><i class='tf-icons ti ti-circle-x'></i></a>"
            },
            {
                "nomor": "",
                "jenis magang": "",
                "nama komponen": "Performa",
                "dinilai oleh": "Pembimbing Lapangan",
                "bobot": "20%",
                "total bobot": "100%",
                "status": "<span class='badge bg-label-success'>Aktif</span>",
                "aksi": "<a data-bs-toggle='modal' data-bs-target='#modalEditKomponen' class='btn-icon text-warning waves-effect waves-light'><i class='tf-icons ti ti-edit' ></i></a> <a onclick = deactive($(this))  class='btn-icon text-danger waves-effect waves-light'><i class='tf-icons ti ti-circle-x'></i></a>"
            },
            {
                "nomor": "",
                "jenis magang": "",
                "nama komponen": "Laporan Akhir",
                "dinilai oleh": "Pembimbing Lapangan",
                "bobot": "20%",
                "total bobot": "",
                "status": "<span class='badge bg-label-success'>Aktif</span>",
                "aksi": "<a data-bs-toggle='modal' data-bs-target='#modalEditKomponen' class='btn-icon text-warning waves-effect waves-light'><i class='tf-icons ti ti-edit' ></i></a> <a onclick = deactive($(this))  class='btn-icon text-danger waves-effect waves-light'><i class='tf-icons ti ti-circle-x'></i></a>"
            },
            {
                "nomor": "",
                "jenis magang": "",
                "nama komponen": "Presentasi",
                "dinilai oleh": "Pembimbing Lapangan",
                "bobot": "20%",
                "total bobot": "",
                "status": "<span class='badge bg-label-success'>Aktif</span>",
                "aksi": "<a data-bs-toggle='modal' data-bs-target='#modalEditKomponen' class='btn-icon text-warning waves-effect waves-light'><i class='tf-icons ti ti-edit' ></i></a> <a onclick = deactive($(this))  class='btn-icon text-danger waves-effect waves-light'><i class='tf-icons ti ti-circle-x'></i></a>"
            },
        ];

        var table = $('#table-master-komponen').DataTable({
            "data": jsonData,
            columns: [{
                    data: "nomor"
                },
                {
                    data: "jenis magang"
                },
                {
                    data: "nama komponen"
                },
                {
                    data: "dinilai oleh"
                },
                {
                    data: "bobot"
                },
                {
                    data: "total bobot"
                },
                {
                    data: "status"
                },
                {
                    data: "aksi"
                }
            ]
        });

        function deactive(e) {
            Swal.fire({
                title: 'Apakah anda yakin ingin menonaktifkan data?',
                text: ' Data yang dipilih akan dihapus!',
                iconHtml: '<img src="{{ url('/app-assets/img/alert.png') }}">',
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yakin",
                cancelButtonText: "Batal",
                closeOnConfirm: false,
                closeOnCancel: false,
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger',
                    iconHtml: 'no-border'
                },
                buttonsStyling: false
            });
        }

        function alert(e) {
            Swal.fire({
                title: 'Bobot nilai melebihi 100%',
                text: ' Pastikan anda memasukkan bobot yang sesuai',
                iconHtml: '<img src="{{ url('/app-assets/img/alert.png') }}">',
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Oke",
                closeOnConfirm: false,
                customClass: {
                    confirmButton: 'btn btn-success',
                    iconHtml: 'no-border'
                },
                buttonsStyling: false
            });
        }

        function alertt(e) {
            Swal.fire({
                title: 'Bobot kurang dari 100%',
                text: ' Pastikan anda memasukkan bobot yang sesuai',
                iconHtml: '<img src="{{ url('/app-assets/img/alert.png') }}">',
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Oke",
                closeOnConfirm: false,
                customClass: {
                    confirmButton: 'btn btn-success',
                    iconHtml: 'no-border'
                },
                buttonsStyling: false
            });
        }

        function active(e) {
            Swal.fire({
                title: 'Apakah anda yakin ingin mengaktifkan data?',
                text: ' Data yang dipilih akan diaktifkan!',
                iconHtml: '<img src="{{ url('/app-assets/img/alert.png') }}">',
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yakin",
                cancelButtonText: "Batal",
                closeOnConfirm: false,
                closeOnCancel: false,
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger',
                    iconHtml: 'no-border'
                },
                buttonsStyling: false
            });
        }
    </script>
@endsection
