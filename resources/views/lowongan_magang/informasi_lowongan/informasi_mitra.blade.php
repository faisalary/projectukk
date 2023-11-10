@extends('partials_admin.template')

@section('page_style')
<link rel="stylesheet" href="../../app-assets/vendor/libs/sweetalert2/sweetalert2.css" />
<style>

</style>

@endsection

@section('main')
<div class="row">
    <div class="col-md-9 col-12">
        <h4 class="fw-bold"><span class="text-muted fw-light">Lowongan Magang /</span> Informasi Mitra Tahun Ajaran 2023/2024</h4>
    </div>
    <div class="col-md-3 col-12 mb-3 float-end d-flex justify-content-end">
        <select class="select2 form-select" data-placeholder="Pilih Tahun Ajaran" style="width: 95% !important;">
            <option value="1">2023/2024 Genap</option>
            <option value="2">2023/2024 Ganjil</option>
            <option value="3">2022/2023 Genap</option>
            <option value="4">2022/2023 Ganjil</option>
            <option value="5">2021/2022 Genap</option>
            <option value="6">2021/2022 Ganjil</option>
        </select>
    </div>
</div>

<div class="row g-4 mb-4">
    <div class="col-sm-6 col-xl-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-start justify-content-between">
                    <div class="content-left">
                        <div class="d-flex align-items-center my-1">
                            <h4 class="mb-0 me-2">150</h4>
                        </div>
                        <span>Total Perusahaan</span>
                    </div>
                    <span class="badge bg-label-primary rounded-pill mt-3 p-2">
                        <i class="ti ti-building ti-sm"></i>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-start justify-content-between">
                    <div class="content-left">
                        <div class="d-flex align-items-center my-1">
                            <h4 class="mb-0 me-2">140</h4>
                        </div>
                        <span>Aktif Merekrut </span>
                    </div>
                    <span class="badge bg-label-success rounded-pill mt-3 p-2">
                        <i class="ti ti-trending-up ti-sm"></i>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-start justify-content-between">
                    <div class="content-left">
                        <div class="d-flex align-items-center my-1">
                            <h4 class="mb-0 me-2">10</h4>
                        </div>
                        <span>Tidak Aktif Merekrut</span>
                    </div>
                    <span class="badge bg-label-danger rounded-pill mt-3 p-2">
                        <i class="ti ti-trending-down ti-sm"></i>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-md-3 col-12 mb-3">
    <select class="select2 form-select" data-placeholder="Pilih status Merekrut">
    <option disabled selected>Pilih status Merekrut</option>
        </select>
    </div>

<div class="row mt-2">
    <div class="col-12">
        <div class="card">
            <div class="card-datatable table-responsive">
                <table class="table" id="table-informasi-mitra">
                    <thead>
                        <tr>
                            <th>NOMOR</th>
                            <th>NAMA</th>
                            <th>TOTAL LOWONGAN</th>
                            <th>LOWONGAN BARU</th>
                            <th>TOTAL PELAMAR</th>
                            <th>STATUS</th>
                            <th>AKSI</th>
                        </tr>
                    </thead>
                </table>
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
            "nama": "PT Teknologi Nirmala Olah Daya informasi",
            "totallowongan": "100",
            "lowonganbaru": "5",
            "totalpelamar": "500",
            "status": "<span class='badge bg-label-success me-1'>Aktif</span>",
            "aksi": "<a href='/informasi/lowongan/admin' class='btn-icon text-success waves-effect waves-light'><i class='tf-icons ti ti-file-invoice'></a>",
        },
        {
            "nomor": "2",
            "nama": "PT Teknologi Nirmala Olah Daya informasi",
            "totallowongan": "100",
            "lowonganbaru": "5",
            "totalpelamar": "500",
            "status": "<span class='badge bg-label-danger me-1'>Non-Aktif</span>",
            "aksi": "<a href='' class='btn-icon text-success waves-effect waves-light'><i class='tf-icons ti ti-file-invoice'></a>",
        },
        {
            "nomor": "3",
            "nama": "PT Teknologi Nirmala Olah Daya informasi",
            "totallowongan": "100",
            "lowonganbaru": "5",
            "totalpelamar": "500",
            "status": "<span class='badge bg-label-success me-1'>Aktif</span>",
            "aksi": "<a href='' class='btn-icon text-success waves-effect waves-light'><i class='tf-icons ti ti-file-invoice'></a>",
        },
    ];

    var table = $('#table-informasi-mitra').DataTable({
        "data": jsonData,
        columns: [{
                data: "nomor"
            },
            {
                data: "nama"
            },
            {
                data: "totallowongan"
            },

            {
                data: "lowonganbaru"
            },
            {
                data: "totalpelamar"
            },
            {
                data: "status"
            },
            {
                data: "aksi"
            }
        ]
    });
</script>

<script>
    var jsonData = [{
            "nomor": "1",
            "nama": "PT Teknologi Nirmala Olah Daya informasi",
            "email": "info@technoinfinity.co.id",
            "alamat": "Indonesia, Jawa Barat, Kota Bandung, Manjahlega, 40286",
            "deskripsi": "Techno infinity adalah sebuah perusahaan pengembang perangkat lunak yang berlokasi di Bandung, Jawa Barat.",
            "npwp": "<a href='#'>Dokumen NPWP</a>",
            "sosial": "Instagram : <a href='#'>techno-infinity</a> Linkedin : <a href='#'>techno-infinity</a> ",
            "aksi": "<a data-bs-toggle='modal' data-bs-target='' class='btn-icon text-success waves-effect waves-light'><i class='tf-icons ti ti-file-check' ></i></a> <a data-bs-toggle='modal' data-bs-target='#modalreject'  class='btn-icon text-danger waves-effect waves-light'><i class='tf-icons ti ti-file-x' ></i></i></a>"
        },
        {
            "nomor": "2",
            "nama": "PT Teknologi Nirmala Olah Daya informasi",
            "email": "info@technoinfinity.co.id",
            "alamat": "Indonesia, Jawa Barat, Kota Bandung, Manjahlega, 40286",
            "deskripsi": "Techno infinity adalah sebuah perusahaan pengembang perangkat lunak yang berlokasi di Bandung, Jawa Barat.",
            "npwp": "<a href='#'>Dokumen NPWP</a>",
            "sosial": "Instagram : <a href='#'>techno-infinity</a> Linkedin : <a href='#'>techno-infinity</a> ",
            "aksi": "<a data-bs-toggle='modal' data-bs-target='' class='btn-icon text-success waves-effect waves-light'><i class='tf-icons ti ti-file-check' ></i></a> <a data-bs-toggle='modal' data-bs-target='#modalreject'  class='btn-icon text-danger waves-effect waves-light'><i class='tf-icons ti ti-file-x' ></i></i></a>"
        },
        {
            "nomor": "3",
            "nama": "PT Teknologi Nirmala Olah Daya informasi",
            "email": "info@technoinfinity.co.id",
            "alamat": "Indonesia, Jawa Barat, Kota Bandung, Manjahlega, 40286",
            "deskripsi": "Techno infinity adalah sebuah perusahaan pengembang perangkat lunak yang berlokasi di Bandung, Jawa Barat.",
            "npwp": "<a href='#'>Dokumen NPWP</a>",
            "sosial": "Instagram : <a href='#'>techno-infinity</a> Linkedin : <a href='#'>techno-infinity</a> ",
            "aksi": "<a data-bs-toggle='modal' data-bs-target='' class='btn-icon text-success waves-effect waves-light'><i class='tf-icons ti ti-file-check' ></i></a> <a data-bs-toggle='modal' data-bs-target='#modalreject'  class='btn-icon text-danger waves-effect waves-light'><i class='tf-icons ti ti-file-x' ></i></i></a>"
        }
    ];
    var table = $('#table-kelola-mitra2').DataTable({
        "data": jsonData,
        columns: [{
                data: "nomor"
            },
            {
                data: "nama"
            },
            {
                data: "email"
            },

            {
                data: "alamat"
            },
            {
                data: "deskripsi"
            },
            {
                data: "npwp"
            },
            {
                data: "sosial"
            },
            {
                data: "aksi"
            }
        ]
    });
</script>


<script src="../../app-assets/vendor/libs/sweetalert2/sweetalert2.js"></script>
<script src="../../app-assets/js/extended-ui-sweetalert2.js"></script>
@endsection