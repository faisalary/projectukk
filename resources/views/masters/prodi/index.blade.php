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
        <h4 class="fw-bold"><span class="text-muted fw-light">Master Data /</span> Prodi</h4>
    </div>
    <div class="col-md-6 col-12 text-end">
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalTambahProdi">Tambah Prodi</button>
    </div>
</div>
<div class="row mt-2">
    <div class="col-12">
        <div class="card">
            <div class="card-datatable table-responsive">
                <table class="table" id="table-master-prodi">
                    <thead>
                        <tr>
                            <th>NOMOR</th>
                            <th>NAMA FAKULTAS</th>
                            <th>NAMA PRODI</th>
                            <th>AKSI</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalTambahProdi" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header text-center d-block">
                <h5 class="modal-title" id="modalTambahProdi">Tambah Prodi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="mb-2">
                        <label for="fakultas" class="form-label">Nama Fakultas</label>
                        <select id="fakultas" class="form-select">
                            <option>Nama Fakultas</option>
                            <option value="1">Fakultas Ilmu Terapan</option>
                            <option value="2">Fakultas Industri Kreatif</option>
                            <option value="3">Fakultas Teknik Elektro</option>
                            <option value="4">Fakultas Komunikasi dan Bisnis</option>
                            <option value="5">Fakultas Ekonomi dan Bisnis</option>
                            <option value="6">Fakultas Informatika</option>
                            <option value="7">Fakultas Rekayasa Industri</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-2">
                        <label for="prodi" class="form-label">Nama Prodi</label>
                        <input type="text" id="prodi" class="form-control" placeholder="Nama Prodi" />
                    </div>
                </div>
                <form class="form-repeater">
                    <div data-repeater-list="group-a">
                        <div data-repeater-item>
                            <div class="row">
                                <div class="mb-2 col-lg-6 col-xl-10 mb-0">
                                    <label class="form-label" for="form-repeater-1-1">Nama Prodi</label>
                                    <input type="text" id="form-repeater-1-1" class="form-control" placeholder="Nama Prodi" />
                                </div>                                
                                <div class="mb-3 col-lg-12 col-xl-2 col-12 d-flex align-items-center mb-0">
                                    <button class="btn btn-outline-danger waves-effect mt-4" data-repeater-delete>
                                    <i class='tf-icons ti ti-trash'></i>
                                    </button>
                                </div>
                            </div>
                            <hr />
                        </div>
                    </div>
                    <div class="mb-0">
                        <button class="btn btn-outline-success waves-effect" data-repeater-create>
                            <i class="ti ti-plus me-1"></i>
                            <span class="align-middle">Add</span>
                        </button>
                    </div>
                </form>
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

<div class="modal fade" id="modalEditProdi" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header text-center d-block">
                <h5 class="modal-title" id="modalEditProdi">Edit Prodi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="mb-2">
                        <label for="fakultas" class="form-label">Nama Fakultas</label>
                        <select id="fakultas" class="form-select">
                            <option>Nama Fakultas</option>
                            <option value="1">Fakultas Ilmu Terapan</option>
                            <option value="2">Fakultas Industri Kreatif</option>
                            <option value="3">Fakultas Teknik Elektro</option>
                            <option value="4">Fakultas Komunikasi dan Bisnis</option>
                            <option value="5">Fakultas Ekonomi dan Bisnis</option>
                            <option value="6">Fakultas Informatika</option>
                            <option value="7">Fakultas Rekayasa Industri</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-2">
                        <label for="prodi" class="form-label">Nama Prodi</label>
                        <input type="text" id="prodi" class="form-control" placeholder="Nama Prodi" />
                    </div>
                </div>
                <form class="form-repeater">
                    <div data-repeater-list="group-a">
                        <div data-repeater-item>
                            <div class="row">
                                <div class="mb-2 col-lg-6 col-xl-10 mb-0">
                                    <label class="form-label" for="form-repeater-1-1">Nama Prodi</label>
                                    <input type="text" id="form-repeater-1-1" class="form-control" placeholder="Nama Prodi" />
                                </div>                                
                                <div class="mb-3 col-lg-12 col-xl-2 col-12 d-flex align-items-center mb-0">
                                    <button class="btn btn-outline-danger waves-effect mt-4" data-repeater-delete>
                                    <i class='tf-icons ti ti-trash'></i>
                                    </button>
                                </div>
                            </div>
                            <hr />
                        </div>
                    </div>
                    <div class="mb-0">
                        <button class="btn btn-outline-success waves-effect" data-repeater-create>
                            <i class="ti ti-plus me-1"></i>
                            <span class="align-middle">Add</span>
                        </button>
                    </div>
                </form>
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
<script src="../../app-assets/vendor/libs/jquery-repeater/jquery-repeater.js"></script>
<script src="../../app-assets/js/forms-extras.js"></script>
<script>
    var jsonData = [{
            "nomor": "1",
            "fakultas": "Fakultas Ilmu Terpan",
            "prodi": "D3 Sistem Informasi",
            "aksi": "<a data-bs-toggle='modal' data-bs-target='#modalEditProdi' class='btn-icon text-warning waves-effect waves-light'><i class='tf-icons ti ti-edit' ></i></a> <a onclick = deactive($(this))  class='btn-icon text-danger waves-effect waves-light'><i class='tf-icons ti ti-trash'></i></a>"
        },
        {
            "nomor": "2",
            "fakultas": "Fakultas Ilmu Terpan",
            "prodi": "D3 Sistem Informasi",
            "aksi": "<a data-bs-toggle='modal' data-bs-target='#modalEditProdi' class='btn-icon text-warning waves-effect waves-light'><i class='tf-icons ti ti-edit' ></i></a> <a onclick = deactive($(this))  class='btn-icon text-danger waves-effect waves-light'><i class='tf-icons ti ti-trash'></i></a>"
        },
        {
            "nomor": "3",
            "fakultas": "Fakultas Ilmu Terpan",
            "prodi": "D3 Sistem Informasi",
            "aksi": "<a data-bs-toggle='modal' data-bs-target='#modalEditProdi' class='btn-icon text-warning waves-effect waves-light'><i class='tf-icons ti ti-edit' ></i></a> <a onclick = deactive($(this))  class='btn-icon text-danger waves-effect waves-light'><i class='tf-icons ti ti-trash'></i></a>"
        }
    ];

    var table = $('#table-master-prodi').DataTable({
        "data": jsonData,
        columns: [{
                data: "nomor"
            },

            {
                data: "fakultas"
            },

            {
                data: "prodi"
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