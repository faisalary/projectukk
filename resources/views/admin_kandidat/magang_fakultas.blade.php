@extends('partials_admin.template')

@section('page_style')
<link rel="stylesheet" href="../../app-assets/vendor/libs/sweetalert2/sweetalert2.css" />
<link rel="stylesheet" href="../../app-assets/vendor/libs/tagify/tagify.css" />
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
<div class="row pe-2 ps-2">
    <div class="col-md-9 col-12">
        <h4 class="fw-bold text-sm"><span class="text-muted fw-light text-xs">Data Mahasiswa Magang / </span>
            Mahasiswa Magang Fakultas Tahun Ajaran 2023/2024
        </h4>
    </div>
    <div class="col-md-3 col-12 mb-3  d-flex align-items-center justify-content-between">
        <select class="select2 form-select" data-placeholder="Pilih Tahun Ajaran">
            <option value="1">2023/2024 Genap</option>
            <option value="2">2023/2024 Ganjil</option>
            <option value="3">2022/2023 Genap</option>
            <option value="4">2022/2023 Ganjil</option>
            <option value="5">2021/2022 Genap</option>
            <option value="6">2021/2022 Ganjil</option>
        </select>
        <button class="btn btn-success waves-effect waves-light" data-bs-toggle="offcanvas" data-bs-target="#modalSlide"><i class="tf-icons ti ti-filter"></i>
        </button>
    </div>

    <div class="nav-align-top">
        <div class="row">
            <div class="col-6">
                <ul class="nav nav-pills mb-3 " role="tablist">
                    <li class="nav-item" style="font-size: small;">
                        <button type="button" class="nav-link active showSingle" target="1" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-justified-diterima" aria-controls="navs-pills-justified-diterima" aria-selected="false" style="padding: 8px 9px;">
                            <i class="tf-icons ti ti-user-check ti-xs me-1"></i> Diterima
                            <span class="badge rounded-pill badge-center h-px-20 w-px-20 ms-1" style="background-color: #DCEEE3; color: #4EA971;"></span>
                        </button>
                    </li>
                    <li class="nav-item" style="font-size: small;">
                        <button type="button" class="nav-link showSingle" target="0" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-justified-ditolak" aria-controls="navs-pills-justified-ditolak" aria-selected="false" style="padding: 8px 9px;">
                            <i class="tf-icons ti ti-user-x ti-xs me-1"></i> Ditolak
                            <span class="badge rounded-pill badge-center h-px-20 w-px-20 ms-1" style="background-color: #DCEEE3; color: #4EA971;"></span>
                        </button>
                    </li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 col-12 ">
                <div class="text-secondary mt-3 mb-3 ">Filter Berdasarkan : <i class='tf-icons ti ti-alert-circle text-primary pb-1' data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Prodi:D3 Sistem Informasi" id="tooltip-filter"></i></div>
            </div>
            <div class="col-md-8 d-flex justify-content-end align-items-center mt-2 mb-3 cnt">
                <div id="div1" class="targetDiv">
                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalTambah">
                        <div class="d-flex align-items-center">
                            <span class="mt-1">Assign Dosen Pembimbing Akademik</span>
                        </div>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="tab-content p-0">
        <div class="tab-pane fade show active" id="navs-pills-justified-diterima" role="tabpanel">
            <div class="card">
                <div class="card-datatable table-responsive">
                    <table class="table table-diterima" id="table-diterima">
                        <thead>
                            <tr>
                                <th style="min-width: 10px;"></th>
                                <th style="min-width: 10px;"></th>
                                <th style="min-width: 50px;">NOMOR</th>
                                <th style="min-width: 125px;">NAMA/NIM</th>
                                <th style="min-width: 170px;">PROGRAM STUDI</th>
                                <th style="min-width: 170px;">NAMA PERUSAHAAN</th>
                                <th style="min-width: 150px;">POSISI MAGANG</th>
                                <th style="min-width: 100px;">TANGGAL MAGANG</th>
                                <th style="min-width: 100px;">DOKUMEN</th>
                                <th style="min-width: 100px;">PEMBIMBING LAPANGAN</th>
                                <th style="min-width: 100px;">PEMBIMBING AKADEMIK</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>

        <div class="tab-pane fade show" id="navs-pills-justified-ditolak" role="tabpanel">
            <div class="card">
                <div class="card-datatable table-responsive">
                    <table class="table table-ditolak" id="table-ditolak">
                        <thead>
                            <tr>
                                <th>NOMOR</th>
                                <th style="min-width: 125px;">NAMA/NIM</th>
                                <th>PROGRAM STUDI</th>
                                <th>NAMA PERUSAHAAN</th>
                                <th>POSISI MAGANG</th>
                                <th style="min-width: 100px;">TANGGAL MAGANG</th>
                                <th>DOKUMEN MAGANG</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
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
                </div>
            </div>
            <div class="mt-3 text-end">
                <button type="reset" class="btn btn-label-danger data-reset">Reset</button>
                <button type="submit" class="btn btn-success">Terapkan</button>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="modalTambah" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header text-center d-block">
                <h5 class="modal-title" id="modalTambah">Assign Dosen Pembimbing Akademik</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col mb-2">
                        <label for="TagifyBasic1" class="form-label">Nama Dosen Pembimbing Akademik<span style="color: red;">*</span></label>
                        <input id="TagifyBasic1" class="form-control" name="TagifyBasic1" value="" />
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalalert">Simpan</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Alert-->
<div class="modal fade" id="modalalert" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img src="../../app-assets/img/alert.png" alt="">
                <h5 class="modal-title" id="modal-title">Apakah anda yakin ingin menetapkan dosen pembimbing akademik?</h5>
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
<script src="../../app-assets/vendor/libs/jquery-repeater/jquery-repeater.js"></script>
<script src="../../app-assets/js/forms-extras.js"></script>
<script>
    var jsonData = [{
            "id": "",
            "id": "",
            "nomor": "1",
            "nama/nim": "Jennie Ruby Jane <br> 6701250405",
            "program_studi": "D3 Sistem Informasi",
            "nama_perusahaan": "Techno Infinity",
            "posisi_magang": "UI/UX Designer",
            "tanggal_magang": "Tanggal Mulai: <br>03 Juni 2023 <br> Tanggal Akhir: <br>03 Juni 2023",
            "dokumen_magang": "<a href='Bukti penerimaan.pdf' style='color:#4EA971;'>Bukti penerimaan.pdf</a>",
            "pembimbing_lapangan": "Mark Lee <br> 12345",
            "pembimbing_akademik": "Lee Haechan <br> 12345",
        },
        {
            "id": "",
            "id": "",
            "nomor": "2",
            "nama/nim": "Jennie Ruby Jane <br> 6701250405",
            "program_studi": "D3 Sistem Informasi",
            "nama_perusahaan": "Techno Infinity",
            "nama_perusahaan": "Techno Infinity",
            "posisi_magang": "UI/UX Designer",
            "tanggal_magang": "Tanggal Mulai: <br>03 Juni 2023 <br> Tanggal Akhir: <br>03 Juni 2023",
            "dokumen_magang": "<a href='Bukti penerimaan.pdf' style='color:#4EA971;'>Bukti penerimaan.pdf</a>",
            "pembimbing_lapangan": "-",
            "pembimbing_akademik": "-",
        },
    ];

    var table = $('#table-diterima').DataTable({
        "data": jsonData,
        scrollX: true,
        columns: [{
                data: 'id'
            },
            {
                data: 'id'
            },
            {
                data: "nomor"
            },
            {
                data: "nama/nim"
            },
            {
                data: "program_studi"
            },
            {
                data: "nama_perusahaan"
            },
            {
                data: "posisi_magang"
            },
            {
                data: "tanggal_magang"
            },
            {
                data: "dokumen_magang"
            },
            {
                data: "pembimbing_lapangan"
            },
            {
                data: "pembimbing_akademik"
            }
        ],
        "columnDefs": [{
                "width": "10px",
                "targets": 0
            },
            {
                "width": "10px",
                "targets": 1
            },
            {
                "width": "125px",
                "targets": 2
            },
            {
                "width": "170px",
                "targets": 3
            },
            {
                "width": "170px",
                "targets": 4
            },
            {
                "width": "150px",
                "targets": 5
            },
            {
                "width": "100px",
                "targets": 6
            },
            {
                "width": "10px",
                "targets": 7
            },
            {
                "width": "100px",
                "targets": 8
            },
            {
                "width": "100px",
                "targets": 9,
            },
            {
                "width": "100px",
                "targets": 10
            },
        ],
        columnDefs: [{
                // For Responsive
                className: 'control',
                orderable: false,
                searchable: false,
                responsivePriority: 2,
                targets: 0,
                render: function(data, type, full, meta) {
                    return '';
                }
            },
            {
                targets: 1,
                orderable: false,
                searchable: false,
                responsivePriority: 3,
                checkboxes: true,
                render: function() {
                    return '<input type="checkbox" class="dt-checkboxes form-check-input">';
                },
                checkboxes: {
                    selectAllRender: '<input type="checkbox" class="form-check-input">'
                }
            },
        ],
    });


    var jsonData = [{
            "nomor": "1",
            "nama/nim": "Jennie Ruby Jane <br> 6701250405",
            "program_studi": "D3 Sistem Informasi",
            "nama_perusahaan": "Techno Infinity",
            "posisi_magang": "UI/UX Designer",
            "tanggal_magang": "Tanggal Mulai: 03 Juni 2023 <br> Tanggal Akhir: 03 Juni 2023",
            "dokumen_magang": "<a href='Bukti penerimaan.pdf' style='color:#4EA971;'>Bukti penerimaan.pdf</a>",
        },
        {
            "nomor": "2",
            "nama/nim": "Jennie Ruby Jane <br> 6701250405",
            "program_studi": "D3 Sistem Informasi",
            "nama_perusahaan": "Techno Infinity",
            "posisi_magang": "UI/UX Designer",
            "tanggal_magang": "Tanggal Mulai: 03 Juni 2023 <br> Tanggal Akhir: 03 Juni 2023",
            "dokumen_magang": "<a href='Bukti penerimaan.pdf' style='color:#4EA971;'>Bukti penerimaan.pdf</a>",
        },
    ];

    var table = $('#table-ditolak').DataTable({
        "data": jsonData,
        columns: [{
                data: "nomor"
            },
            {
                data: "nama/nim"
            },
            {
                data: "program_studi"
            },
            {
                data: "nama_perusahaan"
            },
            {
                data: "posisi_magang"
            },
            {
                data: "tanggal_magang"
            },
            {
                data: "dokumen_magang"
            }
        ]
    });

    jQuery(function() {
        jQuery('.showSingle').click(function() {
            jQuery('.targetDiv').hide('.cnt');
            jQuery('#div' + $(this).attr('target')).slideToggle();
        });
    });
</script>

<script src="../../app-assets/vendor/libs/sweetalert2/sweetalert2.js"></script>
<script src="../../app-assets/js/extended-ui-sweetalert2.js"></script>
<script src="../../app-assets/vendor/libs/tagify/tagify.js"></script>
<script src="../../app-assets/js/forms-tagify.js"></script>
@endsection