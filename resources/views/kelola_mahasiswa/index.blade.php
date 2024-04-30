@extends('partials_admin.template')

@section('page_style')
<link rel="stylesheet" href="../../app-assets/vendor/libs/sweetalert2/sweetalert2.css" />
<link rel="stylesheet" href="../../app-assets/vendor/libs/tagify/tagify.css" />
<link rel="stylesheet" href="../../app-assets/vendor/libs/datatables-fixedcolumns-bs5/fixedcolumns.bootstrap5.css" />
<link rel="stylesheet" href="../../app-assets/vendor/libs/datatables-fixedheader-bs5/fixedheader.bootstrap5.css" />
<style>
    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        color: #4EA971;
    }

    .light-style .tagify__tag .tagify__tag-text {
        color: #4EA971 !important;
    }
</style>
@endsection

@section('main')
<div class="row">
    <div class="col-md-9 col-12">
        <h4 class="fw-bold"><span class="text-muted fw-light">Kelola Mahasiswa</h4>
    </div>
    <div class="col-md-3 col-12 mb-3  d-flex align-items-center justify-content-between">
        <select class="select2 form-select" data-placeholder="Pilih Tahun Ajaran">
            <option value="1">21/10/2023-10/11/2023</option>
        </select>
        <button class="btn btn-success waves-effect waves-light" data-bs-toggle="offcanvas" data-bs-target="#modalSlide"><i class="tf-icons ti ti-filter"></i>
        </button>
    </div>
</div>

<div class="row ps-2 pe-3">
    <div class="card">
        <div class="card-datatable table-responsive">
            <table class="table" id="table-akademik">
                <thead>
                    <tr>
                        <th style="min-width: 50px;">NOMOR</th>
                        <th style="min-width:150px;">NAMA</th>
                        <th style="min-width:150px;">PROGRAM STUDI</th>
                        <th style="min-width:150px;">POSISI MAGANG</th>
                        <th style="min-width:150px;">PERUSAHAAN</th>
                        <th style="min-width:150px;">DURASI MAGANG</th>
                        <th style="min-width:150px;">JENIS MAGANG</th>
                        <th style="min-width:200px;">BERKAS AKHIR MAGANG</th>
                        <th style="min-width:100px;">NILAI AKHIR</th>
                        <th style="min-width:100px;">INDEKS</th>
                        <th style="min-width:100px;">AKSI</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>


<div class="offcanvas offcanvas-end" tabindex="-1" id="modalSlide" aria-labelledby="offcanvasAddUserLabel">
    <div class="offcanvas-header">
        <h5 id="offcanvasAddUserLabel" class="offcanvas-title">Filter Berdasarkan</h5>
    </div>
    <div class="offcanvas-body mx-0 flex-grow-0 pt-0 h-100">
        <form class="add-new-user pt-0" id="filter">
            <div class="col-12 mb-2">
                <div class="row">
                    <div class="mb-2">
                        <label for="nama/nim" class="form-label">Program Studi</label>
                        <select class="form-select select2" id="prodi" name="prodi" data-placeholder="Pilih Program Studi">
                            <option value="">Pilih Program Studi</option>
                        </select>
                    </div>
                    <div class="mb-2">
                        <label for="nama/nim" class="form-label">Jenis Magang</label>
                        <select class="form-select select2" id="magang" name="prodi" data-placeholder="Pilih Jenis Magang">
                            <option value="">Pilih Jenis Magang</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="mt-3 text-end">
                <button type="reset" class="btn btn-label-danger data-reset">Reset</button>
                <button type="submit" class="btn btn-success">Terapkan</button>
            </div>
        </form>
    </div>
</div>

@endsection

@section('page_script')
<script src="../../app-assets/vendor/libs/jquery-repeater/jquery-repeater.js"></script>
<script src="../../app-assets/js/forms-extras.js"></script>
<script src="https://cdn.datatables.net/fixedcolumns/5.0.0/js/dataTables.fixedColumns.js"></script>
<script>
    var jsonData = [{
            "nomor": "1",
            "nama": "Arvin Bagaskara",
            "program_studi": "D3 Sistem Informasi",
            "posisi_magang": "UI/UX Designer",
            "nama_perusahaan": "Techno Infinity",
            "durasi_magang": "2 Semester",
            "jenis_magang": "Magang Fakultas",
            "berkas_akhir": "<ul class='list-unstyled'><li><a href='Laporan Akhir Magang.pdf' style='color:#4EA971;'>Laporan Akhir Magang.pdf</a></li> <li><a href='Dokumen IA.pdf' style='color:#4EA971;'>Dokumen IA.pdf</a></li> <li><a href='Logbook.pdf' style='color:#4EA971;'>Logbook.pdf</a></li></ul>",
            "nilai_akhir": "85",
            "indeks": "A",
            "aksi": "<a href='/input/nilai/akademik' class='btn-icon text-warning waves-effect waves-light'><i class='tf-icons ti ti-clipboard-list'></i></a> <a href='/view/logbook' class='btn-icon text-info waves-effect waves-light'><i class='tf-icons ti ti-book'></i></a>"
        },
        {
            "nomor": "2",
            "nama": "Arvin Bagaskara",
            "program_studi": "D3 Sistem Informasi",
            "posisi_magang": "UI/UX Designer",
            "nama_perusahaan": "Techno Infinity",
            "durasi_magang": "2 Semester",
            "jenis_magang": "Magang Fakultas",
            "berkas_akhir": "<ul class='list-unstyled'><li><a href='Laporan Akhir Magang.pdf' style='color:#4EA971;'>Laporan Akhir Magang.pdf</a></li> <li><a href='' style='color:#4EA971;'>-</a></li> <li><a href='Logbook.pdf' style='color:#4EA971;'>Logbook.pdf</a></li></ul>",
            "nilai_akhir": "85",
            "indeks": "A",
            "aksi": "<a href='/input/nilai/akademik' class='btn-icon text-warning waves-effect waves-light'><i class='tf-icons ti ti-clipboard-list'></i></a> <a href='/view/logbook' class='btn-icon text-info waves-effect waves-light'><i class='tf-icons ti ti-book'></i></a>"
        },
    ];

    var table = $('#table-akademik').DataTable({
        "data": jsonData,
        scrollCollapse: true,
        scrollX: true,
        columns: [{
                data: "nomor"
            },
            {
                data: "nama"
            },
            {
                data: "program_studi"
            },
            {
                data: "posisi_magang"
            },
            {
                data: "nama_perusahaan"
            },
            {
                data: "durasi_magang"
            },
            {
                data: "jenis_magang"
            },
            {
                data: "berkas_akhir"
            },
            {
                data: "nilai_akhir"
            },
            {
                data: "indeks"
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
                "width": "150px",
                "targets": 3
            },
            {
                "width": "150px",
                "targets": 4
            },
            {
                "width": "150px",
                "targets": 5
            },
            {
                "width": "150px",
                "targets": 6
            },

            {
                "width": "200px",
                "targets": 6
            },
            {
                "width": "100px",
                "targets": 7
            },
            {
                "width": "100px",
                "targets": 8
            },
            {
                "width": "100px",
                "targets": 9
            }
        ],
        fixedColumns: {
            left: 2,
            right: 1
        },
    });
</script>
<script src="../../app-assets/vendor/libs/sweetalert2/sweetalert2.js"></script>
<script src="../../app-assets/js/extended-ui-sweetalert2.js"></script>
<script src="../../app-assets/vendor/libs/tagify/tagify.js"></script>
<script src="../../app-assets/js/forms-tagify.js"></script>
@endsection