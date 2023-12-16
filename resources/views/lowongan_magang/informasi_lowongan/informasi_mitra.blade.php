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
                            <th>TOTAL PELAMAR</th>
                            <th>STATUS KERJASAMA</th>
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
            "statuskerjasama": "<span class='badge bg-label-success me-1'>Ya</span>",
            "aksi": "<a href='/informasi/lowongan/' class='btn-icon text-success waves-effect waves-light'><i class='tf-icons ti ti-file-invoice'></a>",
        },
        {
            "nomor": "2",
            "nama": "PT Teknologi Nirmala Olah Daya informasi",
            "totallowongan": "100",
            "lowonganbaru": "5",
            "totalpelamar": "500",
            "statuskerjasama": "<span class='badge bg-label-success me-1'>Ya</span>",
            "aksi": "<a href='' class='btn-icon text-success waves-effect waves-light'><i class='tf-icons ti ti-file-invoice'></a>",
        },
        {
            "nomor": "3",
            "nama": "PT Teknologi Nirmala Olah Daya informasi",
            "totallowongan": "100",
            "lowonganbaru": "5",
            "totalpelamar": "500",
            "statuskerjasama": "<span class='badge bg-label-info me-1'>Internal Tel-u</span>",
            "aksi": "<a href='' class='btn-icon text-success waves-effect waves-light'><i class='tf-icons ti ti-file-invoice'></a>",
        },
    ];

    var table = $('#table-informasi-mitra').DataTable({
        ajax: "{{route('mitra.show')}}",
        serverSide: false,
        processing: true,
        deferRender: true,
        type: 'GET',
        columns: [{
                data: "DT_RowIndex"
            },
            {
                data: "namaindustri"
            },
            {
                data: "total_lowongan"
            },
            {
                data: "total_pelamar"
            },
            {
                data: "status"
            },
            {
                data: "action"
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