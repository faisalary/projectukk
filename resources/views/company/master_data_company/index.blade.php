@extends('partials_admin.template')

@section('page_style')
    <link rel="stylesheet" href="../../app-assets/vendor/libs/sweetalert2/sweetalert2.css" />
    <style>
        .tooltip-inner {
            min-width: 100%;
            max-width: 100%;
        }

        .position-relative {
            padding-right: 15px;
            padding-left: 15px;
        }

        h6,
        .h6 {
            font-size: 0.9375rem;
            margin-bottom: 0px;
        }

        #more {
            display: none;
        }

        .u {
            font-size: 10px;
        }
    </style>
@endsection

@section('main')
    <div class="row">
        <div class="row">
            <div class="col-md-6 col-12 mb-4">
                <h4 class="fw-bold"><span class="text-muted fw-light">Master Data /</span> Template Email</h4>
            </div>
            <div class="col-md-6 col-12 text-end">
                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalTambahEmail">Tambah Template
                    Email</button>
            </div>
        </div>
    </div>

    <div class="col-12">
        <div class="card">
            <div class="card-datatable table-responsive">
                <table class="table tab1c" id="table-master-email" style="width: 100%;">
                    <thead>
                        <tr>
                            <th style="max-width: 70px;">NOMOR</th>
                            <th style="min-width: 300px;">SUBJEK EMAIL</th>
                            <th>DOKUMEN PENDUKUNG</th>
                            <th style="max-width:80px;">STATUS</th>
                            <th style="max-width:80px;">AKSI</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Tambah-->
    <div class="modal fade" id="modalTambahEmail" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header d-block">
                    <h5 class="modal-title" id="modal-title">Tambahkan Template Email</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form class="default-form" method="POST" action="">
                    @csrf
                    <div class="modal-body pt-2">
                        <div class="row">
                            <div class="col mb-2 form-input">
                                <label for="subjek" class="form-label">Subjek</label>
                                <input type="text" class="form-control" placeholder="Subjek Email"
                                    aria-describedby="defaultFormControlHelp" name="subjek">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-2 form-input">
                                <label for="headline" class="form-label">Headline</label>
                                <input type="text" class="form-control" placeholder="Headline Email"
                                    aria-describedby="defaultFormControlHelp" name="headline">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-2">
                                <label for="konten" class="form-label">Konten</label>
                                <textarea class="form-control" placeholder="Konten Email" id="konten" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="formFileMultiple" class="form-label">Attachment</label>
                                <input class="form-control" type="file" id="formFileMultiple" multiple="">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit"class="btn btn-success">Simpan</button>
                    </div>
                </form>
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
                "subject": "Undangan Seleksi Tahap 1",
                "dokumen": "<i class='tf-icons ti ti-link'style='color: blue; cursor:pointer;'><u style='color: blue; font-size:18px;'>File Dokumen</u></i>",
                "status": "<div class='badge bg-label-success'>Aktif</div></div>",
                "aksi": "<a data-bs-toggle='modal' data-bs-target='#modalTambahEmail' class='btn-icon text-warning waves-effect waves-light'><i class='tf-icons ti ti-edit' ></i><a onclick = active($(this))  class='btn-icon text-danger waves-effect waves-light'><i class='tf-icons ti ti-circle-x'></i></a>",
            },
            {
                "nomor": "2",
                "subject": "Undangan Seleksi Tahap 2",
                "dokumen": "<i class='tf-icons ti ti-link'style='color: blue; cursor:pointer;'><u style='color: blue; font-size:18px;'>File Dokumen</u></i>",
                "status": "<div class='badge bg-label-danger'>Non Aktif</div></div>",
                "aksi": "<a data-bs-toggle='modal' data-bs-target='#modalTambahEmail' class='btn-icon text-warning waves-effect waves-light'><i class='tf-icons ti ti-edit' ></i><a onclick = active($(this))  class='btn-icon text-success waves-effect waves-light'><i class='tf-icons ti ti-circle-check'></i></a>",
            },
            {
                "nomor": "3",
                "subject": "Undangan Seleksi Tahap 3",
                "dokumen": "<i class='tf-icons ti ti-link'style='color: blue; cursor:pointer;'><u style='color: blue; font-size:18px;'>File Dokumen</u></i>",
                "status": "<div class='badge bg-label-success'>Aktif</div></div>",
                "aksi": "<a data-bs-toggle='modal' data-bs-target='#modalTambahEmail' class='btn-icon text-warning waves-effect waves-light'><i class='tf-icons ti ti-edit' ></i><a onclick = active($(this))  class='btn-icon text-danger waves-effect waves-light'><i class='tf-icons ti ti-circle-x'></i></a>",
            }
        ];

        var table = $('#table-master-email').DataTable({
            "data": jsonData,
            scrollX: true,
            columns: [{
                    data: "nomor"
                },
                {
                    data: "subject"
                },
                {
                    data: "dokumen"
                },
                {
                    data: "status"
                },
                {
                    data: "aksi"
                }
            ],
            "columnDefs": [{
                    "width": "100px",
                    "targets": 0
                },
                {
                    "width": "100px",
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
                    "width": "100px",
                    "targets": 4
                }
            ]
        });
    </script>

    <script src="../../app-assets/vendor/libs/sweetalert2/sweetalert2.js"></script>
    <script src="../../app-assets/js/extended-ui-sweetalert2.js"></script>
@endsection
