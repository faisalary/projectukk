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
        <h4 class="fw-bold"><span class="text-muted fw-light">Master Data /</span> Mitra</h4>
    </div>
    <div class="col-md-6 col-12 text-end">
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalTambahMitra">Tambah Mitra</button>
    </div>
</div>
<div class="row mt-2">
    <div class="col-12">
        <div class="card">
            <div class="card-datatable table-responsive">
                <table class="table" id="table-master-mitra">
                    <thead>
                        <tr>
                            <th>NOMOR</th>
                            <th>NAMA</th>
                            <th>NO TELEPON</th>
                            <th>ALAMAT</th>
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
<div class="modal fade" id="modalTambahMitra" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header text-center d-block">
                <h5 class="modal-title" id="modalTambahMitra">Tambah Mitra</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col mb-2">
                        <label for="mitra" class="form-label">Nama Mitra</label>
                        <input type="text" id="mitra" class="form-control" placeholder="Nama Mitra" />
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-2">
                        <label for="telp" class="form-label">No Telepon</label>
                        <input type="text" id="telp" class="form-control" placeholder="No Telepon" />
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-2">
                    <label for="alamat" class="form-label">Alamat</label>
                    <textarea class="form-control" id="alamat" placeholder="Alamat"></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-2">
                        <label for="kmitra" class="form-label">Kategori Mitra</label>
                        <input type="text" id="kategori" class="form-control" placeholder="Kategori Mitra" />
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

<div class="modal fade" id="modalEditMitra" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header text-center d-block">
                <h5 class="modal-title" id="modalEditMitra">Edit Mitra</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col mb-2">
                        <label for="mitra" class="form-label">Nama Mitra</label>
                        <input type="text" id="mitra" class="form-control" placeholder="Nama Mitra" />
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-2">
                        <label for="telp" class="form-label">No Telepon</label>
                        <input type="text" id="telp" class="form-control" placeholder="No Telepon" />
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-2">
                    <label for="alamat" class="form-label">Alamat</label>
                    <textarea class="form-control" id="alamat" placeholder="Alamat"></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-2">
                        <label for="kmitra" class="form-label">Kategori Mitra</label>
                        <input type="text" id="kategori" class="form-control" placeholder="Kategori Mitra" />
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
            "nama": "PT Mencari Cinta Sejati",
            "no telepon": "(022)",
            "alamat": "Jl. Telekomunikasi Terusan Buah Batu Bandung",
            "status": "<a data-bs-toggle='modal' data-bs-target='#modalEditMitra' class='btn-icon'><span class='badge bg-label-success'>Aktif</span></a>",
            "aksi": "<a data-bs-toggle='modal' data-bs-target='#modalEditMitra' class='btn-icon text-warning waves-effect waves-light'><i class='tf-icons ti ti-edit' ></i></a> <a onclick = deactive($(this))  class='btn-icon text-danger waves-effect waves-light'><i class='far fa-check-circle text-success'></i></a>"
        },
        {
            "nomor": "2",
            "nama": "PT Mencari Cinta Sejati",
            "no telepon": "(022)",
            "alamat": "Jl. Telekomunikasi Terusan Buah Batu Bandung",
            "status":"<a data-bs-toggle='modal' data-bs-target='#modalEditMitra' class='btn-icon'><span class='badge bg-label-danger'>Non-aktif</span></a>",
            "aksi": "<a data-bs-toggle='modal' data-bs-target='#modalEditMitra' class='btn-icon text-warning waves-effect waves-light'><i class='tf-icons ti ti-edit' ></i></a> <a onclick = active($(this))  class='btn-icon text-danger waves-effect waves-light'><i class='tf-icons ti ti-circle-x'></i></a>"
        },
        {
            "nomor": "3",
            "nama": "PT Mencari Cinta Sejati",
            "no telepon": "(022)",
            "alamat": "Jl. Telekomunikasi Terusan Buah Batu Bandung",
            "status":"<a data-bs-toggle='modal' data-bs-target='#modalEditMitra' class='btn-icon'><span class='badge bg-label-success'>Aktif</span></a>",
            "aksi": "<a data-bs-toggle='modal' data-bs-target='#modalEditMitra' class='btn-icon text-warning waves-effect waves-light'><i class='tf-icons ti ti-edit' ></i></a> <a onclick = deactive($(this))  class='btn-icon text-danger waves-effect waves-light'><i class='far fa-check-circle text-success'></i></a>"
        }
    ];

    var table = $('#table-master-mitra').DataTable({
        "data": jsonData,
        columns: [{
                data: "nomor"
            },

            {
                data: "nama"
            },
            {
                data: "no telepon"
            },
            {
                data: "alamat"
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