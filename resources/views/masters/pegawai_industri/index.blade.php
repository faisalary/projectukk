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
        <h4 class="fw-bold"><span class="text-muted fw-light">Master Data /</span> Pegawai Industri</h4>
    </div>
    <div class="col-md-6 col-12 text-end">
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalTambahPegawai">Tambah Pegawai Industri</button>
    </div>
</div>
<div class="row mt-2">
    <div class="col-12">
        <div class="card">
            <div class="card-datatable table-responsive">
                <table class="table" id="table-master-pegawai">
                    <thead>
                        <tr>
                            <th>NOMOR</th>
                            <th>NAMA PERUSAHAAN</th>
                            <th>NAMA PEGAWAI</th>
                            <th>NOMOR TELEPON</th>
                            <th>EMAIL</th>
                            <th>JABATAN</th>
                            <th>UNIT</th>
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
<div class="modal fade" id="modalTambahPegawai" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header text-center d-block">
                <h5 class="modal-title" id="modalTambahPegawai">Tambah Pegawai Industri</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col mb-2">
                        <label for="namaperusahaan" class="form-label">Nama Perusahaan</label>
                        <input type="text" id="namaperusahaan" class="form-control" placeholder="Nama Perusahaan" />
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-2">
                        <label for="namapegawai" class="form-label">Nama Pegawai</label>
                        <input type="text" id="namapegawai" class="form-control" placeholder="Nama Pegawai" />
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-2">
                        <label for="telp" class="form-label">No Telepon</label>
                        <input type="text" id="telp" class="form-control" placeholder="Nomor Telepon" />
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-2">
                        <label for="email" class ="form-label">Email</label>
                        <input type="text" id="email" class="form-control" placeholder="Email" />
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-2">
                        <label for="jabatan" class="form-label">Jabatan</label>
                        <input type="text" id="jabatan" class="form-control" placeholder="Jabatan" />
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-2">
                        <label for="unit" class="form-label">Unit</label>
                        <input type="text" id="unit" class="form-control" placeholder="Unit" />
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-2">
                        <label for="status" class="form-label">Status</label>
                        <input type="text" id="status" class="form-control" placeholder="Status" />
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success">Simpan</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalEditPegawai" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header text-center d-block">
                <h5 class="modal-title" id="modalEditPegawai">Edit Pegawai Industri</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col mb-2">
                        <label for="namaperusahaan" class="form-label">Nama Perusahaan</label>
                        <input type="text" id="namaperusahaan" class="form-control" placeholder="Nama Perusahaan" />
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-2">
                        <label for="namapegawai" class="form-label">Nama Pegawai</label>
                        <input type="text" id="namapegawai" class="form-control" placeholder="Nama Pegawai" />
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-2">
                        <label for="telp" class="form-label">No Telepon</label>
                        <input type="text" id="telp" class="form-control" placeholder="Nomor Telepon" />
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-2">
                        <label for="email" class ="form-label">Email</label>
                        <input type="text" id="email" class="form-control" placeholder="Email" />
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-2">
                        <label for="jabatan" class="form-label">Jabatan</label>
                        <input type="text" id="jabatan" class="form-control" placeholder="Jabatan" />
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-2">
                        <label for="unit" class="form-label">Unit</label>
                        <input type="text" id="unit" class="form-control" placeholder="Unit" />
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-2">
                        <label for="status" class="form-label">Status</label>
                        <input type="text" id="status" class="form-control" placeholder="Status" />
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
            "nama perusahaan": "Univestitas Techno Infinity",
            "nama pegawai": "John doe",
            "nomor telepon": "0898765432",
            "email": "johndoe@gmail.com",
            "jabatan": "Direktur Utama",
            "unit": "direktur",
            "status": "<a data-bs-toggle='modal' data-bs-target='#modalEditPegawai' class='btn-icon'><span class='badge bg-label-danger'>Non-aktif</span></a>",
            "aksi": "<a data-bs-toggle='modal' data-bs-target='#modalEditPegawai' class='btn-icon text-warning waves-effect waves-light'><i class='tf-icons ti ti-edit' ></i></a> <a onclick = active($(this))  class='btn-icon text-danger waves-effect waves-light'><i class='tf-icons ti ti-circle-x'></i></a>"
        },
        {
            "nomor": "2",
            "nama perusahaan": "Univestitas Techno Infinity",
            "nama pegawai": "John doe",
            "nomor telepon": "0898765432",
            "email": "johndoe@gmail.com",
            "jabatan": "Direktur Utama",
            "unit": "direktur",
            "status": "<a data-bs-toggle='modal' data-bs-target='#modalEditPegawai' class='btn-icon'><span class='badge bg-label-success'>Aktif</span></a>",
            "aksi": "<a data-bs-toggle='modal' data-bs-target='#modalEditPegawai' class='btn-icon text-warning waves-effect waves-light'><i class='tf-icons ti ti-edit' ></i></a> <a onclick = deactive($(this))  class='btn-icon text-danger waves-effect waves-light'><i class='far fa-check-circle text-success'></i></a>"
        },
        {
            "nomor": "3",
            "nama perusahaan": "Univestitas Techno Infinity",
            "nama pegawai": "John doe",
            "nomor telepon": "0898765432",
            "email": "johndoe@gmail.com",
            "jabatan": "Direktur Utama",
            "unit": "direktur",
            "status": "<a data-bs-toggle='modal' data-bs-target='#modalEditDosen' class='btn-icon'><span class='badge bg-label-success'>Aktif</span></a>",
            "aksi": "<a data-bs-toggle='modal' data-bs-target='#modalEditDosen' class='btn-icon text-warning waves-effect waves-light'><i class='tf-icons ti ti-edit' ></i></a> <a onclick = deactive($(this))  class='btn-icon text-danger waves-effect waves-light'><i class='far fa-check-circle text-success'></i></a>"
        }
    ];

    var table = $('#table-master-pegawai').DataTable({
        "data": jsonData,
        columns: [{
                data: "nomor"
            },
            {
                data: "nama perusahaan"
            },
            {
                data: "nama pegawai"
            },
            {
                data: "nomor telepon"
            },
            {
                data: "email"
            },
            {
                data: "jabatan"
            },
            {
                data: "unit"
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