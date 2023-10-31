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
        <h4 class="fw-bold"><span class="text-muted fw-light">Master Data /</span> Nilai Mutu</h4>
    </div>
    <div class="col-md-6 col-12 text-end">
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalTambahNilaiMutu">Tambah Nilai Mutu</button>
    </div>
    <!-- <div class="col-md-3 col-12 mb-2">
        <select class="select2 form-select" data-placeholder="Pilih Universitas">
            <option value="1">Universitas Telkom</option>
            <option value="2">Universitas Telkom</option>
            <option value="3">Universitas Telkom</option>
        </select>
    </div> -->
</div>
<div class="row mt-2">
    <div class="col-12">
        <div class="card">
            <div class="card-datatable table-responsive">
                <table class="table" id="table-master-nilai_mutu">
                    <thead>
                        <tr>
                            <th>NOMOR</th>
                            <th>NILAI MINIMAL</th>
                            <th>NILAI MAKSIMAL</th>
                            <th>NILAI MUTU</th>
                            <th>AKSI</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalTambahNilaiMutu" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header text-center d-block">
                <h5 class="modal-title" id="modalTambahProdi">Tambah Prodi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">                   
                <div class="row">
                    <div class="col mb-2">
                        <label for="minimal" class="form-label">Nilai Minimal</label>
                        <input type="text" id="minimal" class="form-control" placeholder="Nilai Minimal" />
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-2">
                        <label for="maksimal" class="form-label">Nilai Maksimal</label>
                        <input type="text" id="maksimal" class="form-control" placeholder="Nilai Maksimal" />
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-2">
                        <label for="mutu" class="form-label">Nilai Mutu</label>
                        <input type="text" id="mutu" class="form-control" placeholder="Nilai Mutu" />
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

<div class="modal fade" id="modalEditNilaiMutu" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header text-center d-block">
                <h5 class="modal-title" id="modalEditProdi">Edit Prodi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">                   
                <div class="row">
                    <div class="col mb-2">
                        <label for="minimal" class="form-label">Nilai Minimal</label>
                        <input type="text" id="minimal" class="form-control" placeholder="Nilai Minimal" />
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-2">
                        <label for="maksimal" class="form-label">Nilai Maksimal</label>
                        <input type="text" id="maksimal" class="form-control" placeholder="Nilai Maksimal" />
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-2">
                        <label for="mutu" class="form-label">Nilai Mutu</label>
                        <input type="text" id="mutu" class="form-control" placeholder="Nilai Mutu" />
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
<script src="../../app-assets/vendor/libs/jquery-repeater/jquery-repeater.js"></script>
<script src="../../app-assets/js/forms-extras.js"></script>
<script>
    var jsonData = [{
            "nomor": "1",
            "minimal":"69",
            "maksimal": "71,3",
            "mutu": "C",
            "aksi": "<a data-bs-toggle='modal' data-bs-target='#modalEditNilaiMutu' class='btn-icon text-warning waves-effect waves-light'><i class='tf-icons ti ti-edit' ></i></a> <a onclick = deactive($(this))  class='btn-icon text-danger waves-effect waves-light'><i class='tf-icons ti ti-trash'></i></a>"
        },
        {
            "nomor": "2",
            "minimal":"67",
            "maksimal": "66,2",
            "mutu": "D",
            "aksi": "<a data-bs-toggle='modal' data-bs-target='#modalEditNilaiMutu' class='btn-icon text-warning waves-effect waves-light'><i class='tf-icons ti ti-edit' ></i></a> <a onclick = deactive($(this))  class='btn-icon text-danger waves-effect waves-light'><i class='tf-icons ti ti-trash'></i></a>"
        },
        {
            "nomor": "3",
            "minimal":"78",
            "maksimal": "80",
            "mutu": "B",
            "aksi": "<a data-bs-toggle='modal' data-bs-target='#modalEditNilaiMutu' class='btn-icon text-warning waves-effect waves-light'><i class='tf-icons ti ti-edit' ></i></a> <a onclick = deactive($(this))  class='btn-icon text-danger waves-effect waves-light'><i class='tf-icons ti ti-trash'></i></a>"
        }
    ];

    var table = $('#table-master-nilai_mutu').DataTable({
        "data": jsonData,
        columns: [{
                data: "nomor"
            },
            {
                data: "minimal"
            },
            {
                data: "maksimal"
            },

            {
                data: "mutu"
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