@extends('partials_admin.template')

@section('meta_header')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('page_style')
    <link rel="stylesheet" href="../../app-assets/vendor/libs/sweetalert2/sweetalert2.css" />
    <style>

    </style>
@endsection

@section('main')
<div class="row">
    <div class="col-md-6 col-12">
        <h4 class="fw-bold"><span class="text-muted fw-light">Mitra /</span> Kelola Mitra</h4>
    </div>
    <div class="col-md-6 col-12 text-end">
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalTambahMitra">Tambah Mitra</button>
    </div>
</div>
<div class="col-xl-12">
    <div class="nav-align-top">
        <ul class="nav nav-pills mb-3 " role="tablist">
            <li class="nav-item">
                <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-justified-users" aria-controls="navs-pills-justified-users" aria-selected="true">
                    <i class="tf-icons ti ti-users ti-xs me-1"></i> Created
                    <span class="badge rounded-pill badge-center h-px-20 w-px-20 bg-success ms-1">3</span>
                </button>
            </li>
            <li class="nav-item">
                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-justified-pending" aria-controls="navs-pills-justified-pending" aria-selected="false">
                    <i class="tf-icons ti ti-clock ti-xs me-1"></i> Pending
                    <span class="badge rounded-pill badge-center h-px-20 w-px-20 bg-success ms-1">2</span>
                </button>
            </li>
            <li class="nav-item">
                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-justified-verified" aria-controls="navs-pills-justified-verified" aria-selected="false">
                    <i class="tf-icons ti ti-user-check ti-xs me-1"></i> Verified
                    <span class="badge rounded-pill badge-center h-px-20 w-px-20 bg-success ms-1">4</span>
                </button>
            </li>
            <li class="nav-item">
                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-justified-rejected" aria-controls="navs-pills-justified-rejected" aria-selected="false">
                    <i class="tf-icons ti ti-user-x ti-xs me-1"></i> Rejected
                    <span class="badge rounded-pill badge-center h-px-20 w-px-20 bg-success ms-1">1</span>
                </button>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane fade show active" id="navs-pills-justified-users" role="tabpanel">
                <div class="card-datatable table-responsive">
                    <table class="table" id="table-kelola-mitra1">
                        <thead>
                            <tr>
                                <th>NOMOR</th>
                                <th style="min-width: 100px;">NAMA</th>
                                <th>EMAIL</th>
                                <th>ALAMAT</th>
                                <th>DESKRIPSI PERUSAHAAN</th>
                                <th>NPWP PERUSAHAAN</th>
                                <th>SOSIAL MEDIA</th>
                            </tr>
                        </thead>
                    </table>
                </div>

                </div>
                <div class="tab-pane fade" id="navs-pills-justified-pending" role="tabpanel">
                    <div class="card-datatable table-responsive">
                        <table class="table" id="table-kelola-mitra2">
                            <thead>
                                <tr>
                                    <th>NOMOR</th>
                                    <th style="min-width:100px;">NAMA</th>
                                    <th>EMAIL</th>
                                    <th>ALAMAT</th>
                                    <th>DESKRIPSI PERUSAHAAN</th>
                                    <th>NPWP PERUSAHAAN</th>
                                    <th style="min-width:100px;">NOMOR TELEPON</th>
                                    <th style="min-width:100px;">AKSI</th>
                                </tr>
                            </thead>
                        </table>
                    </div>

                <div class="modal fade" id="modalreject" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header text-center d-block">
                                <h5 class="modal-title" id="modalreject">Alasan Penolakan</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col mb-2">
                                        <label for="alasan" class="form-label">Alasan Penolakan</label>
                                        <textarea class="form-control" id="alasam" placeholder="Alasan Penolakan"></textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-success">Simpan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="navs-pills-justified-verified" role="tabpanel">
                <div class="card-datatable table-responsive">
                    <table class="table" id="table-kelola-mitra3">
                        <thead>
                            <tr>
                                <th>NOMOR</th>
                                <th style="min-width:100px;">NAMA</th>
                                <th>EMAIL</th>
                                <th>ALAMAT</th>
                                <th>DESKRIPSI PERUSAHAAN</th>
                                <th style="min-width:100px;">NPWP PERUSAHAAN</th>
                                <th style="min-width:100px;">SOSIAL MEDIA</th>
                                <th>AKSI</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <div class="modal fade" id="modalEditMitra" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header text-center d-block">
                                <h5 class="modal-title" id="modalEditMitra">Edit Mitra</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col mb-2">
                                        <label for="nama" class="form-label">Nama Mitra</label>
                                        <input type="text" id="nama" class="form-control" placeholder="Nama Mitra" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col mb-2">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="text" id="email" class="form-control" placeholder="Email" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col mb-2">
                                        <label for="alamat" class="form-label">Alamat</label>
                                        <textarea class="form-control" id="alamat" placeholder="Alamat"></textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col mb-2">
                                        <label for="deskripsi" class="form-label">Deskripsi Perusahaan</label>
                                        <textarea class="form-control" id="deskripsi" placeholder="Deskripsi Perusahaan"></textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col mb-2">
                                        <label for="formValidationFile" class="form-label">NPWP Perusahaan</label>
                                        <input class="form-control" type="file" id="formValidationFile" name="formValidationFile" />
                                        <label for="formValidationFile" class="form-label">Allowed JPG, PNG or PDF. Max
                                            size of 800Kb</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <form class="form-repeater">
                                        <div data-repeater-list="group-a">
                                            <div data-repeater-item>
                                                <div class="row">
                                                    <div class="col-4 mb-2" style="padding-right:0px;">
                                                        <label class="form-label" for="form-repeater-1-4">Sosial
                                                            Media</label>
                                                        <select id="form-repeater-1-4" class="form-select">
                                                            <option value="Instagram">Instagram</option>
                                                            <option value="LinkedIn">LinkedIn</option>
                                                            <option value="Facebook">Facebook</option>
                                                            <option value="Twitter">Twitter</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-7" style="margin-top:3px;">
                                                        <label class="form-label" for="form-repeater-1-1"></label>
                                                        <input type="text" id="form-repeater-1-1" class="form-control" placeholder="Usename" />
                                                    </div>
                                                    <div class="col-1" style="padding-left:0px;">
                                                        <button class="btn btn-outline-danger waves-effect" style="width: 10px;     margin-top: 25px;" data-repeater-delete>
                                                            <i class="tf-icons ti ti-trash"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-1 mb-0">
                                            <button class="btn btn-outline-success waves-effect" data-repeater-create>
                                                <i class="ti ti-plus me-1"></i>
                                                <span class="align-middle">Add</span>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-success">Simpan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="navs-pills-justified-rejected" role="tabpanel">
                <p>
                <div class="card-datatable table-responsive">
                    <table class="table" id="table-kelola-mitra4">
                        <thead>
                            <tr>
                                <th>NOMOR</th>
                                <th style="min-width: 100px;">NAMA</th>
                                <th>EMAIL</th>
                                <th style="min-width: 120px;">ALAMAT</th>
                                <th style="min-width: 140px;">DESKRIPSI PERUSAHAAN</th>
                                <th>NPWP PERUSAHAAN</th>
                                <th style="min-width: 100px;">SOSIAL MEDIA</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalTambahMitra" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header text-center d-block">
                <h5 class="modal-title" id="modalTambahMitra">Tambah Mitra</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col mb-2">
                        <label for="nama" class="form-label">Nama Perusahaan</label>
                        <input type="text" id="nama" class="form-control" placeholder="Nama Perusahaan" />
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-2">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" id="email" class="form-control" placeholder="Email" />
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
<script src="../../app-assets/vendor/libs/jquery-repeater/jquery-repeater.js"></script>
<script src="../../app-assets/js/forms-extras.js"></script>
<script>
    var jsonData = [{
            "nomor": "1",
            "nama": "PT Teknologi Nirmala Olah Daya informasi",
            "email": "info@technoinfinity.co.id",
            "alamat": "-",
            "deskripsi": "-",
            "npwp": "-",
            "sosial": "-",
        },
        {
            "nomor": "2",
            "nama": "PT Teknologi Nirmala Olah Daya informasi",
            "email": "info@technoinfinity.co.id",
            "alamat": "-",
            "deskripsi": "-",
            "npwp": "-",
            "sosial": "-",
        },
        {
            "nomor": "3",
            "nama": "PT Teknologi Nirmala Olah Daya informasi",
            "email": "info@technoinfinity.co.id",
            "alamat": "-",
            "deskripsi": "-",
            "npwp": "-",
            "sosial": "-",
        }
    ];

    var table = $('#table-kelola-mitra1').DataTable({
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

<script>
    var jsonData = [{
            "nomor": "1",
            "nama": "PT Teknologi Nirmala Olah Daya informasi",
            "email": "info@technoinfinity.co.id",
            "alamat": "Indonesia, Jawa Barat, Kota Bandung, Manjahlega, 40286",
            "deskripsi": "Techno infinity adalah sebuah perusahaan pengembang perangkat lunak yang berlokasi di Bandung, Jawa Barat.",
            "npwp": "<a href='#'>Dokumen NPWP</a>",
            "sosial": "Instagram : <a href='#'>techno-infinity</a> Linkedin : <a href='#'>techno-infinity</a> ",
            "aksi": "<a data-bs-toggle='modal' data-bs-target='#modalEditMitra' class='btn-icon text-warning waves-effect waves-light'><i class='tf-icons ti ti-edit' ></i></a>"
        },
        {
            "nomor": "2",
            "nama": "PT Teknologi Nirmala Olah Daya informasi",
            "email": "info@technoinfinity.co.id",
            "alamat": "Indonesia, Jawa Barat, Kota Bandung, Manjahlega, 40286",
            "deskripsi": "Techno infinity adalah sebuah perusahaan pengembang perangkat lunak yang berlokasi di Bandung, Jawa Barat.",
            "npwp": "<a href='#'>Dokumen NPWP</a>",
            "sosial": "Instagram : <a href='#'>techno-infinity</a> Linkedin : <a href='#'>techno-infinity</a> ",
            "aksi": "<a data-bs-toggle='modal' data-bs-target='#modalEditMitra' class='btn-icon text-warning waves-effect waves-light'><i class='tf-icons ti ti-edit' ></i></a>"
        },
        {
            "nomor": "3",
            "nama": "PT Teknologi Nirmala Olah Daya informasi",
            "email": "info@technoinfinity.co.id",
            "alamat": "Indonesia, Jawa Barat, Kota Bandung, Manjahlega, 40286",
            "deskripsi": "Techno infinity adalah sebuah perusahaan pengembang perangkat lunak yang berlokasi di Bandung, Jawa Barat.",
            "npwp": "<a href='#'>Dokumen NPWP</a>",
            "sosial": "Instagram : <a href='#'>techno-infinity</a> Linkedin : <a href='#'>techno-infinity</a> ",
            "aksi": "<a data-bs-toggle='modal' data-bs-target='#modalEditMitra' class='btn-icon text-warning waves-effect waves-light'><i class='tf-icons ti ti-edit' ></i></a>"
        }
    ];
    var table = $('#table-kelola-mitra3').DataTable({
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

<script>
    var jsonData = [{
            "nomor": "1",
            "nama": "PT Teknologi Nirmala Olah Daya informasi",
            "email": "info@technoinfinity.co.id",
            "alamat": "Indonesia, Jawa Barat, Kota Bandung, Manjahlega, 40286",
            "deskripsi": "Techno infinity adalah sebuah perusahaan pengembang perangkat lunak yang berlokasi di Bandung, Jawa Barat.",
            "npwp": "<a href='#'>Dokumen NPWP</a>",
            "sosial": "Instagram : <a href='#'>techno-infinity</a> Linkedin : <a href='#'>techno-infinity</a> ",
        },
        {
            "nomor": "2",
            "nama": "PT Teknologi Nirmala Olah Daya informasi",
            "email": "info@technoinfinity.co.id",
            "alamat": "Indonesia, Jawa Barat, Kota Bandung, Manjahlega, 40286",
            "deskripsi": "Techno infinity adalah sebuah perusahaan pengembang perangkat lunak yang berlokasi di Bandung, Jawa Barat.",
            "npwp": "<a href='#'>Dokumen NPWP</a>",
            "sosial": "Instagram : <a href='#'>techno-infinity</a> Linkedin : <a href='#'>techno-infinity</a> ",
        },
        {
            "nomor": "3",
            "nama": "PT Teknologi Nirmala Olah Daya informasi",
            "email": "info@technoinfinity.co.id",
            "alamat": "Indonesia, Jawa Barat, Kota Bandung, Manjahlega, 40286",
            "deskripsi": "Techno infinity adalah sebuah perusahaan pengembang perangkat lunak yang berlokasi di Bandung, Jawa Barat.",
            "npwp": "<a href='#'>Dokumen NPWP</a>",
            "sosial": "Instagram : <a href='#'>techno-infinity</a> Linkedin : <a href='#'>techno-infinity</a> ",
        }
    ];
    var table = $('#table-kelola-mitra4').DataTable({
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
            }
        ]
    });
</script>

    <script src="../../app-assets/vendor/libs/sweetalert2/sweetalert2.js"></script>
    <script src="../../app-assets/js/extended-ui-sweetalert2.js"></script>
@endsection
