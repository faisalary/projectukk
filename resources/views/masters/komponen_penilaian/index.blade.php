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
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalTambahKomponen">Tambah Komponen
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
    <div class="modal fade" id="modalTambahKomponen" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header text-center d-block">
                    <h5 class="modal-title">Tambah Komponen Penilaian</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="form-repeater">
                        <div data-repeater-list="group-a">
                            <div data-repeater-item="">
                                <div class="row">
                                    <div class="col mb-2">
                                        <label for="jenis" class="form-label">Jenis Magang</label>
                                        <select id="jenis" class="form-select">
                                            <option>Jenis Magang</option>
                                            <option value="1">Magang Fakultas</option>
                                            <option value="2">Magang Mandiri</option>
                                            <option value="2">Magang Startup</option>
                                            <option value="2">Magang Kerja</option>
                                            <option value="2">Magang MBKM-Kampus Merdeka</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 col-12">
                                        <label class="form-label" for="form-repeater-1-1">Nama Komponen</label>
                                        <input type="text" id="form-repeater-1-1" class="form-control"
                                            placeholder="Nama Komponen">
                                    </div>
                                    <div class="col-md-4 col-15" style="margin-right: -1rem; margin-left: -1rem;">
                                        <label class="form-label" for="form-repeater-1-2">Bobot Penilaian</label>
                                        <input type="text" id="form-repeater-1-2" class="form-control"
                                            placeholder="Bobot Penilaian">
                                    </div>
                                    <div class="col-md-3 col-12">
                                        <label class="form-label" for="form-repeater-1-2">Dinilai Oleh</label>
                                        <input type="text" id="form-repeater-1-2" class="form-control"
                                            placeholder="Dinilai Oleh">
                                    </div>
                                    <div class="col-md-1 col-12 d-flex align-items-center mb-3"
                                        style="margin-right: -1rem; margin-left: -1rem; margin-top: 1.3rem;">
                                        <button class="btn waves-effect" data-repeater-delete="">
                                            <i class="tf-icons ti ti-trash text-danger trash-icon"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <button class="btn waves-effect bg-label-success" data-repeater-create="">
                        <i class="ti ti-plus me-1"></i>
                        <span class="align-middle">Data</span>
                    </button>
                    <div class="row">
                        <div class="col-md-12 col-12 text-end">
                            <button class="btn btn-success" onclick = alertt($(this))  class='btn-icon text-danger waves-effect waves-light'><i class='far fa-check-circle text-success'></i>Simpan</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalEditKomponen" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header text-center d-block">
                    <h5 class="modal-title">Edit Komponen Penilaian</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="form-repeater">
                        <div data-repeater-list="group-a">
                            <div data-repeater-item="">
                                <div class="row">
                                    <div class="col mb-2">
                                        <label for="jenis" class="form-label">Jenis Magang</label>
                                        <select id="jenis" class="form-select">
                                            <option>Jenis Magang</option>
                                            <option value="1">Magang Fakultas</option>
                                            <option value="2">Magang Mandiri</option>
                                            <option value="2">Magang Startup</option>
                                            <option value="2">Magang Kerja</option>
                                            <option value="2">Magang MBKM-Kampus Merdeka</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 col-12">
                                        <label class="form-label" for="form-repeater-1-1">Nama Komponen</label>
                                        <input type="text" id="form-repeater-1-1" class="form-control"
                                            placeholder="Nama Komponen">
                                    </div>
                                    <div class="col-md-4 col-15" style="margin-right: -1rem; margin-left: -1rem;">
                                        <label class="form-label" for="form-repeater-1-2">Bobot Penilaian</label>
                                        <input type="text" id="form-repeater-1-2" class="form-control"
                                            placeholder="Bobot Penilaian">
                                    </div>
                                    <div class="col-md-3 col-12">
                                        <label class="form-label" for="form-repeater-1-2">Dinilai Oleh</label>
                                        <input type="text" id="form-repeater-1-2" class="form-control"
                                            placeholder="Dinilai Oleh">
                                    </div>
                                    <div class="col-md-1 col-12 d-flex align-items-center mb-3"
                                        style="margin-right: -1rem; margin-left: -1rem; margin-top: 1.3rem;">
                                        <button class="btn waves-effect" data-repeater-delete="">
                                            <i class="tf-icons ti ti-trash text-danger trash-icon"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <button class="btn waves-effect bg-label-success" data-repeater-create="">
                        <i class="ti ti-plus me-1"></i>
                        <span class="align-middle">Data</span>
                    </button>
                    <div class="row">
                        <div class="col-md-12 col-12 text-end">
                            <button class="btn btn-success" onclick = alert($(this))  class='btn-icon text-danger waves-effect waves-light'><i class='far fa-check-circle text-success'></i>Simpan</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


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
                "aksi": "<a data-bs-toggle='modal' data-bs-target='#modalEditKomponen' class='btn-icon text-warning waves-effect waves-light'><i class='tf-icons ti ti-edit' ></i></a> <a onclick = deactive($(this))  class='btn-icon text-danger waves-effect waves-light'><i class='far fa-check-circle text-success'></i></a>"
            },
            {
                "nomor": "",
                "jenis magang": "",
                "nama komponen": "Kehadiran",
                "dinilai oleh": "Pembimbing Lapangan",
                "bobot": "20%",
                "total bobot": "",
                "status": "<span class='badge bg-label-success'>Aktif</span>",
                "aksi": "<a data-bs-toggle='modal' data-bs-target='#modalEditKomponen' class='btn-icon text-warning waves-effect waves-light'><i class='tf-icons ti ti-edit' ></i></a> <a onclick = deactive($(this))  class='btn-icon text-danger waves-effect waves-light'><i class='far fa-check-circle text-success'></i></a>"
            },
            {
                "nomor": "",
                "jenis magang": "",
                "nama komponen": "Performa",
                "dinilai oleh": "Pembimbing Lapangan",
                "bobot": "20%",
                "total bobot": "100%",
                "status": "<span class='badge bg-label-success'>Aktif</span>",
                "aksi": "<a data-bs-toggle='modal' data-bs-target='#modalEditKomponen' class='btn-icon text-warning waves-effect waves-light'><i class='tf-icons ti ti-edit' ></i></a> <a onclick = deactive($(this))  class='btn-icon text-danger waves-effect waves-light'><i class='far fa-check-circle text-success'></i></a>"
            },
            {
                "nomor": "",
                "jenis magang": "",
                "nama komponen": "Laporan Akhir",
                "dinilai oleh": "Pembimbing Lapangan",
                "bobot": "20%",
                "total bobot": "",
                "status": "<span class='badge bg-label-success'>Aktif</span>",
                "aksi": "<a data-bs-toggle='modal' data-bs-target='#modalEditKomponen' class='btn-icon text-warning waves-effect waves-light'><i class='tf-icons ti ti-edit' ></i></a> <a onclick = deactive($(this))  class='btn-icon text-danger waves-effect waves-light'><i class='far fa-check-circle text-success'></i></a>"
            },
            {
                "nomor": "",
                "jenis magang": "",
                "nama komponen": "Presentasi",
                "dinilai oleh": "Pembimbing Lapangan",
                "bobot": "20%",
                "total bobot": "",
                "status": "<span class='badge bg-label-success'>Aktif</span>",
                "aksi": "<a data-bs-toggle='modal' data-bs-target='#modalEditKomponen' class='btn-icon text-warning waves-effect waves-light'><i class='tf-icons ti ti-edit' ></i></a> <a onclick = deactive($(this))  class='btn-icon text-danger waves-effect waves-light'><i class='far fa-check-circle text-success'></i></a>"
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
