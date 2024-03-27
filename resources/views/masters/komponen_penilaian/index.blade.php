@extends('partials_admin.template')

@section('meta_header')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

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

    .trash-icon {
        border: 2px solid red;
        border-radius: 5px;
        padding: 3px;
    }
</style>
@endsection

@section('main')
<div class="row">
    <div class="col-md-6 col-12">
        <h4 class="fw-bold"><span class="text-muted fw-light">Master Data /</span> Komponen Penilaian</h4>
    </div>
    <div class="col-md-6 col-12 text-end">
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modal-komponen-nilai">Tambah Komponen
            Penilaian</button>
    </div>

    <div class="nav-align-top">
        <div class="row">
            <div class="col-6">
                <ul class="nav nav-pills mb-3 " role="tablist">
                    <li class="nav-item" style="font-size: small;">
                        <button type="button" class="nav-link active" target="1" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-justified-akademik" aria-controls="navs-pills-justified-akademik" aria-selected="false" style="padding: 8px 9px;"> Pembimbing Akademik
                        </button>
                    </li>
                    <li class="nav-item" style="font-size: small;">
                        <button type="button" class="nav-link" target="0" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-justified-lapangan" aria-controls="navs-pills-justified-lapangan" aria-selected="false" style="padding: 8px 9px;"> Pembimbing Lapangan
                        </button>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    
    <div class="tab-content p-0">
        <div class="tab-pane fade show active" id="navs-pills-justified-akademik" role="tabpanel">
            <div class="card">
                <div class="card-datatable table-responsive">
                    <table class="table table-bordered" id="table-akademik">
                        <thead>
                            <tr>
                                <th>NOMOR</th>
                                <th style="min-width:150px;">JENIS MAGANG</th>
                                <th style="min-width:250px;">ASPEK PENILAIAN</th>
                                <th style="min-width:250px;">DESKRIPSI ASPEK PENILAIAN</th>
                                <th style="min-width:100px;">NILAI MAX</th>
                                <th style="min-width:100px;">BOBOT</th>
                                <th style="min-width:100px;">STATUS</th>
                                <th style="min-width:100px;">AKSI</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>

        <div class="tab-pane fade show" id="navs-pills-justified-lapangan" role="tabpanel">
            <div class="card">
                <div class="card-datatable table-responsive">
                    <table class="table table-bordered" id="table-lapangan">
                        <thead>
                            <tr>
                                <th>NOMOR</th>
                                <th style="min-width:150px;">JENIS MAGANG</th>
                                <th style="min-width:250px;">ASPEK PENILAIAN</th>
                                <th style="min-width:250px;">DESKRIPSI ASPEK PENILAIAN</th>
                                <th style="min-width:100px;">NILAI MAX</th>
                                <th style="min-width:100px;">BOBOT</th>
                                <th style="min-width:100px;">STATUS</th>
                                <th style="min-width:100px;">AKSI</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
@include('masters.komponen_penilaian.modal')


@endsection

@section('page_script')

<script src="https://cdn.jsdelivr.net/gh/ashl1/datatables-rowsgroup@fbd569b8768155c7a9a62568e66a64115887d7d0/dataTables.rowsGroup.js"></script>

<script>
    $(document).ready(function() {
        var dataAkademik = [
            ['1', 'Magang Fakultas', 'Buku Laporan Akhir <li>Penulisan dan Tata Bahasa</li> <li>Latar Belakang dan Tujuan</li><li>Uraian Mengenai Permasalahan dan Solusinya</li>', 'Evaluasi kemampuan magang dalam menyampaikan ide, bertanya, dan menjelaskan secara jelas dan efektif.', '0-70', '40%', '<span class="badge bg-label-success">Aktif</span>', '<a data-bs-toggle="modal" data-bs-target="#modal-komponen-nilai-edit" class="btn-icon text-warning waves-effect waves-light"><i class="tf-icons ti ti-edit"></i></a><a class="btn-icon text-danger waves-effect waves-light"><i class="tf-icons ti ti-circle-x"></i></a>'],
            ['1', 'Magang Fakultas', 'Presentasi dan Tanya Jawab <li> Mahasiswa Mempresentasikan Ruang Lingkup Pekerjaan selama Magang </li><li>Dosen memberi nilai terkait tingkat kesulitan dan ruang lingkup magang untuk dijadikan dasar penilaian</li>', 'Evaluasi kemampuan magang dalam menyampaikan ide, bertanya, dan menjelaskan secara jelas dan efektif.', '0-30', '40%', '<span class="badge bg-label-success">Aktif</span>', '<a data-bs-toggle="modal" data-bs-target="#modal-komponen-nilai-edit" class="btn-icon text-warning waves-effect waves-light"><i class="tf-icons ti ti-edit"></i></a><a class="btn-icon text-danger waves-effect waves-light"><i class="tf-icons ti ti-circle-x"></i></a>'],
        ];

        var tableAkademik = $('#table-akademik').DataTable({
            scrollX: true,
            columns: [{
                    title: 'NOMOR'
                },
                {
                    title: 'JENIS MAGANG'
                },
                {
                    title: 'ASPEK PENILAIAN',
                },
                {
                    title: 'DESKRIPSI ASPEK PENILAIAN',
                },
                {
                    title: 'NILAI MAX',
                },
                {
                    title: 'BOBOT',
                },
                {
                    title: 'STATUS',
                },
                {
                    title: 'AKSI',
                },
            ],
            "columnDefs": [{
                    "width": "150px",
                    "targets": 0
                },
                {
                    "width": "100px",
                    "targets": 1
                },
                {
                    "width": "250px",
                    "targets": 2
                },
                {
                    "width": "250px",
                    "targets": 3
                },
                {
                    "width": "100px",
                    "targets": 4
                },
                {
                    "width": "100px",
                    "targets": 5
                },
                {
                    "width": "100px",
                    "targets": 6
                },
                {
                    "width": "100px",
                    "targets": 7
                }
            ],
            data: dataAkademik,
            'rowsGroup': [0, 1, 5],
        });


        var dataLapangan = [
            ['1', 'Magang Fakultas', 'Komunikasi, Adaptasi, Kerjasama', 'Evaluasi kemampuan magang dalam menyampaikan ide, bertanya, dan menjelaskan secara jelas dan efektif.', '0-30', '60%', '<span class="badge bg-label-success">Aktif</span>', '<a data-bs-toggle="modal" data-bs-target="#modal-komponen-nilai-edit" class="btn-icon text-warning waves-effect waves-light"><i class="tf-icons ti ti-edit"></i></a><a class="btn-icon text-danger waves-effect waves-light"><i class="tf-icons ti ti-circle-x"></i></a>'],
            ['1', 'Magang Fakultas', 'Disiplin dan Tanggung Jawab dalam pengerjaan tugas', 'Evaluasi kemampuan magang dalam menyampaikan ide, bertanya, dan menjelaskan secara jelas dan efektif.', '0-30', '60%', '<span class="badge bg-label-success">Aktif</span>', '<a data-bs-toggle="modal" data-bs-target="#modal-komponen-nilai-edit" class="btn-icon text-warning waves-effect waves-light"><i class="tf-icons ti ti-edit"></i></a><a class="btn-icon text-danger waves-effect waves-light"><i class="tf-icons ti ti-circle-x"></i></a>'],
            ['1', 'Magang Fakultas', 'Kemampuan/Skill Mahasiswa Sesuai (memenuhi) posisi magang', 'Evaluasi kemampuan magang dalam menyampaikan ide, bertanya, dan menjelaskan secara jelas dan efektif.', '0-40', '60%', '<span class="badge bg-label-success">Aktif</span>', '<a data-bs-toggle="modal" data-bs-target="#modal-komponen-nilai-edit" class="btn-icon text-warning waves-effect waves-light"><i class="tf-icons ti ti-edit"></i></a><a class="btn-icon text-danger waves-effect waves-light"><i class="tf-icons ti ti-circle-x"></i></a>'],
        ];

        var tableLapangan = $('#table-lapangan').DataTable({
            scrollX: true,
            columns: [{
                    title: 'NOMOR',
                },
                {
                    title: 'JENIS MAGANG',
                },
                {
                    title: 'ASPEK PENILAIAN',
                },
                {
                    title: 'DESKRIPSI ASPEK PENILAIAN',
                },
                {
                    title: 'NILAI MAX',
                },
                {
                    title: 'BOBOT',
                },
                {
                    title: 'STATUS',
                },
                {
                    title: 'AKSI',
                },
            ],
            "columnDefs": [{
                    "width": "150px",
                    "targets": 0
                },
                {
                    "width": "100px",
                    "targets": 1
                },
                {
                    "width": "250px",
                    "targets": 2
                },
                {
                    "width": "250px",
                    "targets": 3
                },
                {
                    "width": "100px",
                    "targets": 4
                },
                {
                    "width": "100px",
                    "targets": 5
                },
                {
                    "width": "100px",
                    "targets": 6
                },
                {
                    "width": "100px",
                    "targets": 7
                }
            ],
            data: dataLapangan,
            'rowsGroup': [0, 1, 5],
        });
    });
</script>

<script src="../../app-assets/vendor/libs/sweetalert2/sweetalert2.js"></script>
<script src="../../app-assets/js/extended-ui-sweetalert2.js"></script>
<script src="../../app-assets/js/forms-extras.js"></script>
<script src="../../app-assets/vendor/libs/jquery-repeater/jquery-repeater.js"></script>

@endsection