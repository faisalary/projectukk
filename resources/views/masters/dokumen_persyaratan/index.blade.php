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
        <h4 class="fw-bold"><span class="text-muted fw-light">Master Data /</span> Dokumen Persyaratan</h4>
    </div>
    <div class="col-md-6 col-12 text-end">
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalTambahDokumen">Tambah Dokumen Persyaratan</button>
    </div>
</div>
<div class="row mt-2">
    <div class="col-12">
        <div class="card">
            <div class="card-datatable table-responsive">
                <table class="table" id="table-master-dokumen">
                    <thead>
                        <tr>
                            <th>NOMOR</th>
                            <th>JENIS MAGANG</th>
                            <th>NAMA DOKUMEN</th>
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
<div class="modal fade" id="modalTambahDokumen" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header text-center d-block">
                <h5 class="modal-title" id="modalTambahDokumen">Tambah Dokumen Persyaratan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col mb-2">
                        <label for="jenis" class="form-label">Jenis Magang</label>
                        <select class="form-select select2" data-placeholder="Jenis Magang">
                            <option value="1">Magang Fakultas</option>
                            <option value="2">Magang Mandiri</option>
                            <option value="2">Magang Startup</option>
                            <option value="2">Magang Kerja</option>
                            <option value="2">Magang MBKM-Kampus Merdeka</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-2">
                        <label for="namadokumen" class="form-label">Nama Dokumen</label>
                        <input type="text" id="namadokumen" class="form-control" placeholder="Nama Dokumen" />
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success">Simpan</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalEditDokumen" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header text-center d-block">
                <h5 class="modal-title" id="modalEditDokumen">Edit Dokumen Persyaratan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col mb-2">
                        <label for="jenis" class="form-label">Jenis Magang</label>
                        <select class="form-select select2" data-placeholder="Jenis Magang">
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
                    <div class="col mb-2">
                        <label for="namadokumen" class="form-label">Nama Dokumen</label>
                        <input type="text" id="namadokumen" class="form-control" placeholder="Nama Dokumen" />
                    </div>
                </div>
            </div>
            <div class="modal-footer">
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
            "jenis magang": "Magang Fakultas",
            "nama dokumen": "Transkrip Nilai",
            "status": "<a data-bs-toggle='modal' data-bs-target='#modalEditDokumen' class='btn-icon'><span class='badge bg-label-success'>Aktif</span></a>",
            "aksi": "<a data-bs-toggle='modal' data-bs-target='#modalEditDokumen' class='btn-icon text-warning waves-effect waves-light'><i class='tf-icons ti ti-edit' ></i></a> <a onclick = deactive($(this))  class='btn-icon text-danger waves-effect waves-light'><i class='tf-icons ti ti-circle-x'></i></a>"
        },
        {
            "nomor": "2",
            "jenis magang": "Magang Fakultas",
            "nama dokumen": "Sertifikasi",
            "status": "<a data-bs-toggle='modal' data-bs-target='#modalEditDokumen' class='btn-icon'><span class='badge bg-label-success'>Aktif</span></a>",
            "aksi": "<a data-bs-toggle='modal' data-bs-target='#modalEditDokumen' class='btn-icon text-warning waves-effect waves-light'><i class='tf-icons ti ti-edit' ></i></a> <a onclick = deactive($(this))  class='btn-icon text-danger waves-effect waves-light'><i class='tf-icons ti ti-circle-x'></i></a>"
        },
        {
            "nomor": "3",
            "jenis magang": "Magang Fakultas",
            "nama dokumen": "Eprt",
            "status": "<a data-bs-toggle='modal' data-bs-target='#modalEditDokumen' class='btn-icon'><span class='badge bg-label-success'>Aktif</span></a>",
            "aksi": "<a data-bs-toggle='modal' data-bs-target='#modalEditDokumen' class='btn-icon text-warning waves-effect waves-light'><i class='tf-icons ti ti-edit' ></i></a> <a onclick = deactive($(this))  class='btn-icon text-danger waves-effect waves-light'><i class='tf-icons ti ti-circle-x'></i></a>"
        },
        {
            "nomor": "4",
            "jenis magang": "Magang Fakultas",
            "nama dokumen": "TAK",
            "status": "<a data-bs-toggle='modal' data-bs-target='#modalEditDokumen' class='btn-icon'><span class='badge bg-label-danger'>Non-aktif</span></a>",
            "aksi": "<a data-bs-toggle='modal' data-bs-target='#modalEditDokumen' class='btn-icon text-warning waves-effect waves-light'><i class='tf-icons ti ti-edit' ></i></a> <a onclick = active($(this))  class='btn-icon text-danger waves-effect waves-light'><i class='far fa-check-circle text-success'></i></a>"
        },
        {
            "nomor": "5",
            "jenis magang": "Magang Fakultas",
            "nama dokumen": "CV",
            "status": "<a data-bs-toggle='modal' data-bs-target='#modalEditDokumen' class='btn-icon'><span class='badge bg-label-success'>Aktif</span></a>",
            "aksi": "<a data-bs-toggle='modal' data-bs-target='#modalEditDokumen' class='btn-icon text-warning waves-effect waves-light'><i class='tf-icons ti ti-edit' ></i></a> <a onclick = deactive($(this))  class='btn-icon text-danger waves-effect waves-light'><i class='tf-icons ti ti-circle-x'></i></a>"
        },
        {
            "nomor": "6",
            "jenis magang": "Magang Fakultas",
            "nama dokumen": "Portofolio",
            "status": "<a data-bs-toggle='modal' data-bs-target='#modalEditDokumen' class='btn-icon'><span class='badge bg-label-success'>Aktif</span></a>",
            "aksi": "<a data-bs-toggle='modal' data-bs-target='#modalEditDokumen' class='btn-icon text-warning waves-effect waves-light'><i class='tf-icons ti ti-edit' ></i></a> <a onclick = deactive($(this))  class='btn-icon text-danger waves-effect waves-light'><i class='tf-icons ti ti-circle-x'></i></a>"
        }
    ];

    var table = $('#table-master-dokumen').DataTable({
        "data": jsonData,
        columns: [{
                data: "nomor"
            },
            {
                data: "jenis magang"
            },
            {
                data: "nama dokumen"
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
        text: ' Data yang dipilih akan diaktifkan!',
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