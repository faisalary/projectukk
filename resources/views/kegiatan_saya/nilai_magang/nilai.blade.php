@extends('partials_mahasiswa.template')

@section('page_style')
<link rel="stylesheet" href="../../app-assets/vendor/libs/sweetalert2/sweetalert2.css" />
<style>
    .nav~.tab-content {
        background: none !important;
    }

    .nav-pills .nav-link.active,
    .nav-pills .nav-link.active:hover,
    .nav-pills .nav-link.active:focus {
        background-color: #4EA971 !important;
        color: #fff;
    }

    .nav-pills .nav-link:not(.active):hover,
    .nav-pills .nav-link:not(.active):focus {
        color: #4EA971 !important;
    }

    .btn-success {
        color: #fff;
        background-color: #4EA971 !important;
        border-color: #4EA971 !important;
    }
</style>
@endsection

@section('main')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="col-md-12 col-12 mt-3">
        <h4 class="fw-bold"><span class="text-muted fw-light">Kegiatan Saya /</span> Nilai Magang</h4>
    </div>

    <div class="row ps-3">
        <ul class="nav nav-pills mb-3 " role="tablist">
            <li class="nav-item" style="font-size: small">
                <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-justified-lapangan" aria-controls="navs-pills-justified-lapangan" aria-selected="false">
                    Pembimbing Lapangan
                </button>
            </li>
            <li class="nav-item" style="font-size: small">
                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-justified-akademik" aria-controls="navs-pills-justified-akademik" aria-selected="false">
                    Pembimbing akademik
                </button>
            </li>
            <li class="nav-item" style="font-size: small">
                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-justified-nilai" aria-controls="navs-pills-justified-nilai" aria-selected="false">
                    Nilai Akhir Magang
                </button>
            </li>
        </ul>

        <div class="tab-content p-0">
            <!-- Pembimbing lapangan -->
            <div class="tab-pane fade show active" id="navs-pills-justified-lapangan" role="tabpanel">
                <div class="card">
                    <div class="card-body">
                        <div class="card-datatable table-responsive pb-0">
                            <table class="table border rounded mb-0" id="table-pembimbing-lapangan">
                                <thead>
                                    <tr>
                                        <th>NOMOR</th>
                                        <th>ASPEK PENILAIAN</th>
                                        <th style="min-width:500px;">DESKRIPSI ASPEK PENILAIAN</th>
                                        <th>NILAI MAX</th>
                                        <th>Nilai</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th class="text-center" colspan="4">Total Nilai</th>
                                        <th>50</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Nilai akhir magang -->
            <div class="tab-pane fade show" id="navs-pills-justified-akademik" role="tabpanel">
                <div class="card">
                    <div class="card-body">
                        <div class="card-datatable table-responsive pb-0">
                            <table class="table border rounded mb-0" id="table-pembimbing-akademik">
                                <thead>
                                    <tr>
                                        <th>NOMOR</th>
                                        <th style="min-width:300px;">ASPEK PENILAIAN</th>
                                        <th style="min-width:300px;">DESKRIPSI ASPEK PENILAIAN</th>
                                        <th style="min-width:100px;">NILAI MAX</th>
                                        <th>Nilai</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th class="text-center" colspan="4">Nilai Akhir</th>
                                        <th>50</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade show" id="navs-pills-justified-nilai" role="tabpanel">
            <div class="card">
                    <div class="card-body">
                        <div class="card-datatable table-responsive pb-0">
                            <table class="table border rounded mb-0" id="table-nilai-akhir">
                                <thead>
                                    <tr>
                                        <th>NOMOR</th>
                                        <th>JENIS PEMBIMBING</th>
                                        <th>NAMA PEMBIMBING</th>
                                        <th>BOBOT</th>
                                        <th>Nilai</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th class="text-center" colspan="4">Nilai Akhir</th>
                                        <th>50</th>
                                    </tr>
                                    <tr>
                                        <th class="text-center" colspan="4">Indeks Nilai Akhir</th>
                                        <th>A</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('page_script')
<script>
    var jsonData = [{
            "nomor": "1",
            "aspek_penilain": "Komunikasi, Adaptasi, Kerjasama",
            "deskripsi_aspek_penilain": "Evaluasi kemampuan magang dalam menyampaikan ide, bertanya, dan menjelaskan secara jelas dan efektif.",
            "nilai_max": "30",
            "nilai": "70"
        },
        {
            "nomor": "2",
            "aspek_penilain": "Disiplin dan Tanggung Jawab dalam pengerjaan tugas",
            "deskripsi_aspek_penilain": "Evaluasi kemampuan magang dalam menyampaikan ide, bertanya, dan menjelaskan secara jelas dan efektif.",
            "nilai_max": "30",
            "nilai": "30"
        },
        {
            "nomor": "3",
            "aspek_penilain": "Kemampuan/Skill Mahasiswa Sesuai (memenuhi) posisi magang",
            "deskripsi_aspek_penilain": "Evaluasi kemampuan magang dalam menyampaikan ide, bertanya, dan menjelaskan secara jelas dan efektif.",
            "nilai_max": "40",
            "nilai": "30"
        },
    ];
    var table = $('#table-pembimbing-lapangan').DataTable({
        "data": jsonData,
        "paging": false,
        "ordering": false,
        "info": false,
        "searching": false,
        columns: [{
                data: "nomor"
            },
            {
                data: "aspek_penilain"
            },
            {
                data: "deskripsi_aspek_penilain"
            },
            {
                data: "nilai_max"
            },
            {
                data: "nilai"
            }
        ],
    });

    var jsonData = [{
            "nomor": "1",
            "aspek_penilain": "Buku Laporan Akhir <li>Penulisan dan Tata Bahasa</li><li>Latar Belakang dan Tujuan</li><li>Uraian Mengenai Permasalahan dan Solusinya</li> ",
            "deskripsi_aspek_penilain": "Evaluasi kemampuan magang dalam menyampaikan ide, bertanya, dan menjelaskan secara jelas dan efektif.",
            "nilai_max": "70",
            "nilai": "70"
        },
        {
            "nomor": "2",
            "aspek_penilain": "Presentasi dan Tanya Jawab <li>Mahasiswa Mempresentasikan Ruang Lingkup Pekerjaan selama Magang</li> <li>Dosen memberi nilai terkait tingkat kesulitan dan ruang lingkup magang untuk dijadikan dasar penilaian</li>",
            "deskripsi_aspek_penilain": "Evaluasi kemampuan magang dalam menyampaikan ide, bertanya, dan menjelaskan secara jelas dan efektif.",
            "nilai_max": "30",
            "nilai": "30"
        },
    ];
    var table = $('#table-pembimbing-akademik').DataTable({
        "data": jsonData,
        "paging": false,
        "ordering": false,
        "info": false,
        "searching": false,
        columns: [{
                data: "nomor"
            },
            {
                data: "aspek_penilain"
            },
            {
                data: "deskripsi_aspek_penilain"
            },
            {
                data: "nilai_max"
            },
            {
                data: "nilai"
            }
        ],
    });

    var jsonData = [{
            "nomor": "1",
            "jenis_pembimbing": "Pembimbing Lapangan ",
            "nama_pembimbing": "Elly Suanggi, S.Kom., M.Kom.",
            "bobot": "60%",
            "nilai": "80"
        },
        {
            "nomor": "2",
            "jenis_pembimbing": "Pembimbing Akademik",
            "nama_pembimbing": "Dr. Evi Kumahasia, S.Kom., M.Kom.",
            "bobot": "40%",
            "nilai": "30"
        },
    ];
    var table = $('#table-nilai-akhir').DataTable({
        "data": jsonData,
        "paging": false,
        "ordering": false,
        "info": false,
        "searching": false,
        columns: [{
                data: "nomor"
            },
            {
                data: "jenis_pembimbing"
            },
            {
                data: "nama_pembimbing"
            },
            {
                data: "bobot"
            },
            {
                data: "nilai"
            }
        ],
    });
</script>
<script src="../../app-assets/vendor/libs/sweetalert2/sweetalert2.js"></script>
<script src="../../app-assets/js/extended-ui-sweetalert2.js"></script>
@endsection