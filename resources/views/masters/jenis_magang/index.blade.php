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
</style>
@endsection

@section('main')
<div class="row">
    <div class="col-md-6 col-12">
        <h4 class="fw-bold"><span class="text-muted fw-light">Master Data /</span> Jenis Magang</h4>
    </div>
    <div class="col-md-6 col-12 text-end">
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalTambahJenisMagang">Tambah Jenis Magang</button>
    </div>
</div>

<div class="row mt-2">
    <div class="col-12">
        <div class="card">
            <div class="card-datatable table-responsive">
                <table class="table" id="table-master-jenis_magang">
                    <thead>
                        <tr>
                            <th>NOMOR</th>
                            <th>JENIS MAGANG</th>
                            <th>DURASI MAGANG</th>
                            <th>DOKUMEN UPLOAD</th>
                            <th>SELEKSI</th>
                            <th>STATUS</th>
                            <th>AKSI</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalTambahJenisMagang" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header text-center d-block">
                <h5 class="modal-title" id="modalTambahJenisMagang">Tambah Jenis Magang</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col mb-2">
                        <label for="jenis" class="form-label">Jenis Magang</label>
                        <input type="text" id="jenis" class="form-control" placeholder="Jenis Magang" />
                    </div>
                </div>
                <div class="row">
                <div class="col mb-2">
                    <label for="durasi" class="form-label">Durasi Magang</label>
                    <input type="text" id="durasi" class="form-control" placeholder="Durasi Magang" />
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-2">
                        <label for="dokumen" class="form-label">Dokumen Upload</label>
                        <input type="text" id="dokumen" class="form-control" placeholder="Dokumen Upload" />
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-2">
                        <label for="seleksi" class="form-label">Seleksi</label>
                        <input type="text" id="seleksi" class="form-control" placeholder="Seleksi" />
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <!-- <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">
                    Close
                </button> -->
                <button type="button" class="btn btn-success">Simpan</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalEditJenisMagang" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header text-center d-block">
                <h5 class="modal-title" id="modalEditJenisMagang">Edit Jenis Magang</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col mb-2">
                        <label for="jenis" class="form-label">Jenis Magang</label>
                        <input type="text" id="jenis" class="form-control" placeholder="Jenis Magang" />
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-2">
                    <label for="durasi" class="form-label">Durasi Magang</label>
                    <input type="text" id="durasi" class="form-control" placeholder="Durasi Magang" />
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-2">
                        <label for="dokumen" class="form-label">Dokumen Upload</label>
                        <input type="text" id="dokumen" class="form-control" placeholder="Dokumen Upload" />
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-2">
                        <label for="seleksi" class="form-label">Seleksi</label>
                        <input type="text" id="seleksi" class="form-control" placeholder="Seleksi" />
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <!-- <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">
                    Close
                </button> -->
                <button type="button" class="btn btn-success">Simpan</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('page_script')
<script>
    var jsonData = [{
            "nomor": "1",
            "jenis": "Magang Fakultas",
            "durasi": "2 Semester",
            "dokumen": "Ya",
            "seleksi": "Ya",
            "status":"<span class='badge bg-label-success me-1'>Aktif</span>",
           "aksi": "<a data-bs-toggle='modal' data-bs-target='#modalEditJenisMagang' class='btn-icon text-warning waves-effect waves-light'><i class='tf-icons ti ti-edit' ></i><a onclick = deactive($(this))  class='btn-icon text-danger waves-effect waves-light'><i class='tf-icons ti ti-circle-x'></i></a>"
        },
        {
            "nomor": "2",
            "jenis": "Magang Mandiri",
            "durasi": "1 Semester",
            "dokumen": "Tidak",
            "seleksi": "Tidak",
            "status":"<span class='badge bg-label-danger me-1'>Non-Aktif</span>",
            "aksi": "<a data-bs-toggle='modal' data-bs-target='#modalEditJenisMagang' class='btn-icon text-warning waves-effect waves-light'><i class='tf-icons ti ti-edit' ></i><a onclick = active($(this))  class='btn-icon text-success waves-effect waves-light'><i class='tf-icons ti ti-circle-check'></i></a>"
        },
        {
            "nomor": "3",
            "jenis": "Magang Startup",
            "durasi": "1 Semester",
            "dokumen": "Ya",
            "seleksi": "Tidak",
            "status":"<span class='badge bg-label-success me-1'>Aktif</span>",
            "aksi": "<a data-bs-toggle='modal' data-bs-target='#modalEditJenisMagang' class='btn-icon text-warning waves-effect waves-light'><i class='tf-icons ti ti-edit' ></i><a onclick = deactive($(this))  class='btn-icon text-danger waves-effect waves-light'><i class='tf-icons ti ti-circle-x'></i></a>"
        }
    ];

    var table = $('#table-master-jenis_magang').DataTable({
        "data": jsonData,
        columns: [{
                data: "nomor"
            },

            {
                data: "jenis"
            },
            {
                data: "durasi"
            },
            {
                data: "dokumen"
            },
            {
                data: "seleksi"
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
            text: ' Data yang dipilih akan Non-Aktif!',
            iconHtml: '<img src="{{ url("/app-assets/img/alert.png")}}">',
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
    function active(e) {
        Swal.fire({
            title: 'Apakah anda yakin ingin mengaktifkan data?',
            text: ' Data yang dipilih akan Aktif!',
            iconHtml: '<img src="{{ url("/app-assets/img/alert.png")}}">',
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

<script src="../../app-assets/vendor/libs/sweetalert2/sweetalert2.js"></script>
<script src="../../app-assets/js/extended-ui-sweetalert2.js"></script>
@endsection