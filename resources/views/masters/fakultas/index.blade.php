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
        <h4 class="fw-bold"><span class="text-muted fw-light">Master Data /</span> Fakultas</h4>
    </div>
    <div class="col-md-6 col-12 text-end">
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalTambahFakultas">Tambah
            Fakultas</button>
    </div>
    <div class="col-md-3 col-12 mb-2">
        <select class="select2 form-select" data-placeholder="Pilih Universitas">
            <option value="1">Universitas Telkom</option>
            <option value="2">Universitas Telkom</option>
            <option value="3">Universitas Telkom</option>
        </select>
    </div>
</div>
<div class="row mt-2">
    <div class="col-12">
        <div class="card">
            <div class="card-datatable table-responsive">
                <table class="table" id="table-master-fakultas">
                    <thead>
                        <tr>
                            <th>NOMOR</th>
                            <th>UNIVERSITAS</th>
                            <th>NAMA FAKULTAS</th>
                            <th>AKSI</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalTambahFakultas" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header text-center d-block">
                <h5 class="modal-title" id="modalTambahFakultas">Tambah Fakultas</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="mb-2">
                        <label for="univ" class="form-label">Universitas</label>
                        <select class="form-select select2" data-placeholder="Pilih Universitas">
                            <option value="1">Universitas Telkom</option>
                            <option value="2">Universitas Telkom</option>
                            <option value="3">Universitas Telkom</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-2">
                        <label for="fakultas" class="form-label">Nama Fakultas</label>
                        <input type="text" id="fakultas" class="form-control" placeholder="Nama Fakultas" />
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

<div class="modal fade" id="modalEditFakultas" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header text-center d-block">
                <h5 class="modal-title" id="modaleditFakultas">Edit Fakultas</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="mb-2">
                        <label for="univ" class="form-label">Universitas</label>
                        <select class="form-select select2" data-placeholder="Pilih Universitas">
                            <option>Universitas</option>
                            <option value="1">Universitas Telkom</option>
                            <option value="2">Universitas Telkom</option>
                            <option value="3">Universitas Telkom</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-2">
                        <label for="fakultas" class="form-label">Nama Fakultas</label>
                        <input type="text" id="fakultas" class="form-control" placeholder="Nama Fakultas" />
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
        "univ": "Universitas Telkom",
        "nama": "Fakultas Ilmu Terpan",
        "aksi": "<a data-bs-toggle='modal' data-bs-target='#modalEditFakultas' class='btn-icon text-warning waves-effect waves-light'><i class='tf-icons ti ti-edit' ></i></a> </a> <a onclick = deactive($(this))  class='btn-icon text-danger waves-effect waves-light'><i class='tf-icons ti ti-trash'></i></a>"
    },
    {
        "nomor": "2",
        "univ": "Universitas Telkom",
        "nama": "Fakultas Ilmu Terpan",
        "aksi": "<a data-bs-toggle='modal' data-bs-target='#modalEditFakultas' class='btn-icon text-warning waves-effect waves-light'><i class='tf-icons ti ti-edit' ></i></a> </a> <a onclick = deactive($(this))  class='btn-icon text-danger waves-effect waves-light'><i class='tf-icons ti ti-trash'></i></a>"
    },
    {
        "nomor": "3",
        "univ": "Universitas Telkom",
        "nama": "Fakultas Ilmu Terpan",
        "aksi": "<a data-bs-toggle='modal' data-bs-target='#modalEditFakultas' class='btn-icon text-warning waves-effect waves-light'><i class='tf-icons ti ti-edit' ></i></a> </a> <a onclick = deactive($(this))  class='btn-icon text-danger waves-effect waves-light'><i class='tf-icons ti ti-trash'></i></a>"
    }
];

var table = $('#table-master-fakultas').DataTable({
    "data": jsonData,
    columns: [{
            data: "nomor"
        },
        {
            data: "univ"
        },
        {
            data: "nama"
        },
        {
            data: "aksi"
        }
    ]
});

function deactive(e) {
    Swal.fire({
        title: 'Apakah anda yakin ingin menghapus data?',
        text: ' Data yang dipilih akan dihapus!',
        iconHtml: '<img src="{{ url("/app-assets/img/alert.png")}}">',
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Hapus",
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