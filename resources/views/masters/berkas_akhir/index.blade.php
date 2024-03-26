@extends('partials_admin.template')

@section('page_style')
<link rel="stylesheet" href="../../app-assets/vendor/libs/sweetalert2/sweetalert2.css" />
<link rel="stylesheet" href="../../app-assets/vendor/libs/flatpickr/flatpickr.css" />
<link rel="stylesheet" href="../../app-assets/vendor/libs/bootstrap-datepicker/bootstrap-datepicker.css" />
<link rel="stylesheet" href="../../app-assets/vendor/libs/bootstrap-daterangepicker/bootstrap-daterangepicker.css" />
<link rel="stylesheet" href="../../app-assets/vendor/libs/jquery-timepicker/jquery-timepicker.css" />
<link rel="stylesheet" href="../../app-assets/vendor/libs/pickr/pickr-themes.css" />
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

    .flatpickr-wrapper {
        display: block;
    }
</style>
@endsection

@section('main')
<div class="row">
    <div class="col-md-6 col-12">
        <h4 class="fw-bold"><span class="text-muted fw-light">Master Data /</span> Laporan Akhir Tahun Ajaran 2023/2024</h4>
    </div>
    <div class="col-md-6 col-12 text-end">
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalTambah">Tambah Laporan Akhir </button>
    </div>
</div>

<div class="col-2 mb-3">
    <select class="select2 form-select" data-placeholder="Filter Status">
        <option value="0">2023/2024 Ganjil</option>
        <option value="1">2024/2025 Genap</option>
        <option value="2">2025/2026 Ganjil</option>
        <option value="3">2026/2027 Genap</option>
    </select>
</div>

<div class="card">
    <div class="card-datatable table-responsive">
        <table class="table" id="table-laporan-akhir">
            <thead>
                <tr>
                    <th style="min-width:50px;">NOMOR</th>
                    <th style="min-width:150px;">JENIS MAGANG</th>
                    <th style="min-width:150px;">DURASI MAGANG</th>
                    <th style="min-width:170px;">BERKAS MAGANG</th>
                    <th style="min-width:200px;">TENGGAT PENGUMPULAN BERKAS MAGANG</th>
                    <th style="min-width:200px;">TENGGAT PENILAIAN MAGANG</th>
                    <th style="min-width:50px;">STATUS</th>
                    <th style="min-width:100px;">AKSI</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<!-- modal tambah-->
<div class="modal fade" id="modalTambah" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header text-center d-block">
                <h5 class="modal-title" id="modalTolak">Tambah Master Laporan Akhir Magang Tahun 2023/2024</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="mb-3 col-12 mb-0">
                        <label for="jenis" class="form-label">Jenis Magang<span style="color: red;">*</span></label>
                        <select name="jenismagang" id="jenismagang" class="form-select select2" data-placeholder="Jenis Magang">
                            <option value="">Jenis Magang</option>
                            <option value="1">Magang Fakultas</option>
                            <option value="2">Magang Mandiri</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3 col-12 mb-0">
                        <label for="durasi" class="form-label">Durasi Magang<span style="color: red;">*</span></label>
                        <select name="durasimagang" id="durasimagang" class="form-select select2" data-placeholder="Durasi Magang">
                            <option value="">Durasi Magang</option>
                            <option value="1">1 Semester</option>
                            <option value="2">2 Semester</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3 col-12 mb-0">
                        <label for="select2Success" class="form-label"> Berkas Magang<span style="color: red;">*</span></label>
                        <div class="select2-success">
                            <select id="select2Success" class="select2 form-select" multiple>
                                <option value="1">Laporan Akhir</option>
                                <option value="2">Dokumen IA</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3 col-12 mb-0">
                        <label for="flatpickr-datetime" class="form-label">Tenggat Pengumpulan Berkas Magang<span style="color: red;">*</span></label>
                        <input type="text" class="form-control flatpickr-input" placeholder="YYYY-MM-DD HH:MM" id="flatpickr-datetime" readonly="readonly">
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3 col-12 mb-0">
                        <label for="flatpickr-datetime2" class="form-label">Tenggat Penilaian Berkas Magang<span style="color: red;">*</span></label>
                        <input type="text" class="form-control flatpickr-input" placeholder="YYYY-MM-DD HH:MM" id="flatpickr-datetime2" readonly="readonly">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="">Simpan</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Alert-->
<div class="modal fade" id="modalalertnonaktif" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img src="../../app-assets/img/alert.png" alt="">
                <h5 class="modal-title" id="modal-title">Apakah anda yakin ingin menonaktifkan data?</h5>
                <p>Data yang dipilih akan non-aktif!</p>
            </div>
            <div class="modal-footer" style="display: flex; justify-content:center;">
                <button type="submit" id="modal-button" class="btn btn-success">Ya, yakin</button>
                <button type="submit" id="modal-button" class="btn btn-danger">Batal</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalalertaktif" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img src="../../app-assets/img/alert.png" alt="">
                <h5 class="modal-title" id="modal-title">Apakah anda yakin ingin mengaktifkan data?</h5>
                <p>Data yang dipilih akan aktif!</p>
            </div>
            <div class="modal-footer" style="display: flex; justify-content:center;">
                <button type="submit" id="modal-button" class="btn btn-success">Ya, yakin</button>
                <button type="submit" id="modal-button" class="btn btn-danger">Batal</button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('page_script')
<script>
    var jsonData = [{
            "nomor": "1",
            "jenis_magang": "Magang Fakultas",
            "durasi_magang": "1 Semester",
            "berkas_magang": "<ul><li>Laporan akhir</li><li>Dokumen IA</li></ul>",
            "tenggat_pengumpulan_berkas_magang": "15-07-2024 23:59",
            "tenggat_penilaian_magang": "15-07-2024 23:59",
            "status": "<span class='badge bg-label-success'>Aktif</span>",
            "aksi": "<a data-bs-toggle='modal' data-bs-target='#modalTambah' class='btn-icon text-warning waves-effect waves-light'><i class='tf-icons ti ti-edit'></i></a><a data-bs-toggle='modal' data-bs-target='#modalalertnonaktif' class='btn-icon text-danger waves-effect waves-light'><i class='tf-icons ti ti-circle-x'></i></a>",

        },
        {
            "nomor": "2",
            "jenis_magang": "Magang Fakultas",
            "durasi_magang": "2 Semester",
            "berkas_magang": "<ul><li>Laporan akhir</li><li>Dokumen IA</li></ul>",
            "tenggat_pengumpulan_berkas_magang": "15-07-2024 23:59",
            "tenggat_penilaian_magang": "15-07-2024 23:59",
            "status": "<span class='badge bg-label-danger'>Non-Aktif</span>",
            "aksi": "<a data-bs-toggle='modal' data-bs-target='#modalTambah' class='btn-icon text-warning waves-effect waves-light'><i class='tf-icons ti ti-edit'></i></a><a data-bs-toggle='modal' data-bs-target='#modalalertaktif' class='btn-icon text-success waves-effect waves-light'><i class='tf-icons ti ti-circle-check'></i></a>",

        },
    ];

    var table = $('#table-laporan-akhir').DataTable({
        "data": jsonData,
        scrollX: true,
        columns: [{
                data: "nomor"
            },
            {
                data: "jenis_magang"
            },
            {
                data: "durasi_magang"
            },
            {
                data: "berkas_magang"
            },
            {
                data: "tenggat_pengumpulan_berkas_magang"
            },
            {
                data: "tenggat_penilaian_magang"
            },
            {
                data: "status"
            },
            {
                data: "aksi"
            }
        ],
        "columnDefs": [{
                "width": "50px",
                "targets": 0
            },
            {
                "width": "150px",
                "targets": 1
            },
            {
                "width": "150px",
                "targets": 2
            },
            {
                "width": "170px",
                "targets": 3
            },
            {
                "width": "200px",
                "targets": 4
            },
            {
                "width": "200px",
                "targets": 5
            },
            {
                "width": "50px",
                "targets": 6
            },
            {
                "width": "100px",
                "targets": 7
            }
        ],
    });
</script>
<script src="../../app-assets/vendor/libs/sweetalert2/sweetalert2.js"></script>
<script src="../../app-assets/js/extended-ui-sweetalert2.js"></script>
<script src="../../app-assets/vendor/libs/flatpickr/flatpickr.js"></script>
<script src="../../app-assets/vendor/libs/bootstrap-datepicker/bootstrap-datepicker.js"></script>
<script src="../../app-assets/vendor/libs/bootstrap-daterangepicker/bootstrap-daterangepicker.js"></script>
<script src="../../app-assets/vendor/libs/jquery-timepicker/jquery-timepicker.js"></script>
<script src="../../app-assets/vendor/libs/pickr/pickr.js"></script>
<script src="../../app-assets/js/forms-pickers.js"></script>
@endsection