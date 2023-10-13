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
        <h4 class="fw-bold"><span class="text-muted fw-light">Master Data /</span> Universitas</h4>
    </div>
    <div class="col-md-6 col-12 text-end">
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalTambahUniversitas">Tambah Universitas</button>
    </div>
</div>
<div class="row mt-2">
    <div class="col-12">
        <div class="card">
            <div class="card-datatable table-responsive">
                <table class="table" id="table-master-univ">
                    <thead>
                        <tr>
                            <th>NOMOR</th>
                            <th>NAMA</th>
                            <th>JALAN</th>
                            <th>KOTA</th>
                            <th>TELP</th>
                            <th>AKSI</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalTambahUniversitas" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header text-center d-block">
                <h5 class="modal-title" id="modalTambahUniversitas">Tambah Universitas</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col mb-2">
                        <label for="universitas" class="form-label">Nama Universitas</label>
                        <input type="text" id="universitas" class="form-control" placeholder="Nama Universitas" />
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-2">
                    <label for="jalan" class="form-label">Jalan</label>
                    <textarea class="form-control" id="kota" placeholder="Jalan"></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-2">
                        <label for="kota" class="form-label">Kota</label>
                        <input type="text" id="kota" class="form-control" placeholder="Kota" />
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-2">
                        <label for="telp" class="form-label">Telp</label>
                        <input type="text" id="telp" class="form-control" placeholder="Name" />
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

<div class="modal fade" id="modalEditUniversitas" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header text-center d-block">
                <h5 class="modal-title" id="modalEditUniversitas">Edit Universitas</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col mb-2">
                        <label for="universitas" class="form-label">Nama Universitas</label>
                        <input type="text" id="universitas" class="form-control" placeholder="Nama Universitas" />
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-2">
                    <label for="jalan" class="form-label">Jalan</label>
                    <textarea class="form-control" id="kota" placeholder="Jalan"></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-2">
                        <label for="kota" class="form-label">Kota</label>
                        <input type="text" id="kota" class="form-control" placeholder="Kota" />
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-2">
                        <label for="telp" class="form-label">Telp</label>
                        <input type="text" id="telp" class="form-control" placeholder="Name" />
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
            "nama": "Univestitas Telkom",
            "jalan": "Jl. Telekomunikasi Terusan Buah Batu Bandung",
            "kota": "Bandung",
            "telp": "(022)",
           "aksi": "<a data-bs-toggle='modal' data-bs-target='#modalEditUniversitas' class='btn-icon text-warning waves-effect waves-light'><i class='tf-icons ti ti-edit' ></i><a onclick = deactive($(this))  class='btn-icon text-danger waves-effect waves-light'><i class='tf-icons ti ti-trash'></i></a>"
        },
        {
            "nomor": "2",
            "nama": "Univestitas Telkom",
            "jalan": "Jl. Telekomunikasi Terusan Buah Batu Bandung",
            "kota": "Bandung",
            "telp": "(022)",
            "aksi": "<a data-bs-toggle='modal' data-bs-target='#modalEditUniversitas' class='btn-icon text-warning waves-effect waves-light'><i class='tf-icons ti ti-edit' ></i><a onclick = deactive($(this))  class='btn-icon text-danger waves-effect waves-light'><i class='tf-icons ti ti-trash'></i></a>"
        },
        {
            "nomor": "3",
            "nama": "Univestitas Telkom",
            "jalan": "Jl. Telekomunikasi Terusan Buah Batu Bandung",
            "kota": "Bandung",
            "telp": "(022)",
            "aksi": "<a data-bs-toggle='modal' data-bs-target='#modalEditUniversitas' class='btn-icon text-warning waves-effect waves-light'><i class='tf-icons ti ti-edit' ></i><a onclick = deactive($(this))  class='btn-icon text-danger waves-effect waves-light'><i class='tf-icons ti ti-trash'></i></a>"
        }
    ];

    var table = $('#table-master-univ').DataTable({
        "data": jsonData,
        columns: [{
                data: "nomor"
            },

            {
                data: "nama"
            },
            {
                data: "jalan"
            },
            {
                data: "kota"
            },
            {
                data: "telp"
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