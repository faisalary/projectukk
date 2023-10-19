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
            <h4 class="fw-bold"><span class="text-muted fw-light">Master Data /</span> Dosen</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-md-2 col-12 text-start">
            <div class="col mb-2">
                <select id="universitas" class="form-select">
                    <option>Pilih Universitas</option>
                    <option value="1">Telkom</option>
                    <option value="2">Telyu</option>
                </select>
            </div>
        </div>
        <div class="col-md-10 col-12 text-end">
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalTambahDosen">Tambah Dosen</button>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-12">
            <div class="card">
                <div class="card-datatable table-responsive">
                    <table class="table" id="table-master-dosen">
                        <thead>
                            <tr>
                                <th>NOMOR</th>
                                <th>UNIVERSITAS</th>
                                <th>NIP</th>
                                <th>KODE DOSEN</th>
                                <th>NAMA PRODI</th>
                                <th>NAMA DOSEN</th>
                                <th>NOMOR TELEPON</th>
                                <th>EMAIL</th>
                                <th>STATUS</th>
                                <th style="min-width:100px;">AKSI</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalTambahDosen" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header text-center d-block">
                    <h5 class="modal-title" id="modalTambahDosen">Tambah Dosen</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-2">
                            <label for="universitas" class="form-label">Universitas</label>
                            <select id="universitas" class="form-select">
                                <option>Pilih Universitas</option>
                                <option value="1">Telkom</option>
                                <option value="2">Telyu</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-2">
                            <label for="nip" class="form-label">NIP</label>
                            <input type="text" id="nip" class="form-control" placeholder="NIP" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-2">
                            <label for="kode" class="form-label">Kode Dosen</label>
                            <input type="text" id="kode" class="form-control" placeholder="Kode Dosen" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-2">
                            <label for="namaDosen" class="form-label">Nama Dosen</label>
                            <input type="text" id="namaDosen" class="form-control" placeholder="Nama Dosen" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-2">
                            <label for="prodi" class="form-label">Nama Prodi</label>
                            <input type="text" id="prodi" class="form-control" placeholder="Nama Prodi" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-2">
                            <label for="telp" class="form-label">No Telepon</label>
                            <input type="text" id="telp" class="form-control" placeholder="Nomor Telepon" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-2">
                            <label for="email" class ="form-label">Email</label>
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

    <div class="modal fade" id="modalEditDosen" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header text-center d-block">
                    <h5 class="modal-title" id="modalEditDosen">Edit Dosen</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-2">
                            <label for="universitas" class="form-label">Universitas</label>
                            <select id="universitas" class="form-select">
                                <option>Pilih Universitas</option>
                                <option value="1">Telkom</option>
                                <option value="2">Telyu</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-2">
                            <label for="nip" class="form-label">NIP</label>
                            <input type="text" id="nip" class="form-control" placeholder="NIP" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-2">
                            <label for="kode" class="form-label">Kode Dosen</label>
                            <input type="text" id="kode" class="form-control" placeholder="Kode Dosen" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-2">
                            <label for="namaDosen" class="form-label">Nama Dosen</label>
                            <input type="text" id="namaDosen" class="form-control" placeholder="Nama Dosen" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-2">
                            <label for="prodi" class="form-label">Nama Prodi</label>
                            <input type="text" id="prodi" class="form-control" placeholder="Nama Prodi" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-2">
                            <label for="telp" class="form-label">No Telepon</label>
                            <input type="text" id="telp" class="form-control" placeholder="Nomor Telepon" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-2">
                            <label for="email" class ="form-label">Email</label>
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
    <script>
        var jsonData = [{
                "nomor": "1",
                "universitas": "Univestitas Telkom",
                "nip": "009876772467",
                "kode dosen": "MSH",
                "nama prodi": "D3 Sistem Informasi",
                "nama dosen": "John Doe",
                "nomor telepon": "0898765432",
                "email": "johndoe@gmail.com",
                "status": "<a data-bs-toggle='modal' data-bs-target='#modalEditDosen' class='btn-icon'><span class='badge bg-label-success'>Aktif</span></a>",
                "aksi": "<a data-bs-toggle='modal' data-bs-target='#modalEditDosen' class='btn-icon text-warning waves-effect waves-light'><i class='tf-icons ti ti-edit' ></i></a> <a onclick = deactive($(this))  class='btn-icon text-danger waves-effect waves-light'><i class='far fa-check-circle text-success'></i></a>"
            },
            {
                "nomor": "2",
                "universitas": "Univestitas Telkom",
                "nip": "009876772467",
                "kode dosen": "MSH",
                "nama prodi": "D3 Sistem Informasi",
                "nama dosen": "John Doe",
                "nomor telepon": "0898765432",
                "email": "johndoe@gmail.com",
                "status": "<a data-bs-toggle='modal' data-bs-target='#modalEditDosen' class='btn-icon'><span class='badge bg-label-danger'>Non-aktif</span></a>",
                "aksi": "<a data-bs-toggle='modal' data-bs-target='#modalEditDosen' class='btn-icon text-warning waves-effect waves-light'><i class='tf-icons ti ti-edit' ></i></a> <a onclick = active($(this))  class='btn-icon text-danger waves-effect waves-light'><i class='tf-icons ti ti-circle-x'></i></a>"
            },
            {
                "nomor": "3",
                "universitas": "Univestitas Telkom",
                "nip": "009876772467",
                "kode dosen": "MSH",
                "nama prodi": "D3 Sistem Informasi",
                "nama dosen": "John Doe",
                "nomor telepon": "0898765432",
                "email": "johndoe@gmail.com",
                "status": "<a data-bs-toggle='modal' data-bs-target='#modalEditDosen' class='btn-icon'><span class='badge bg-label-success'>Aktif</span></a>",
                "aksi": "<a data-bs-toggle='modal' data-bs-target='#modalEditDosen' class='btn-icon text-warning waves-effect waves-light'><i class='tf-icons ti ti-edit' ></i></a> <a onclick = deactive($(this))  class='btn-icon text-danger waves-effect waves-light'><i class='far fa-check-circle text-success'></i></a>"
            }
        ];

        var table = $('#table-master-dosen').DataTable({
            "data": jsonData,
            columns: [{
                    data: "nomor"
                },
                {
                    data: "universitas"
                },
                {
                    data: "nip"
                },
                {
                    data: "kode dosen"
                },
                {
                    data: "nama prodi"
                },
                {
                    data: "nama dosen"
                },
                {
                    data: "nomor telepon"
                },
                {
                    data: "email"
                },
                {
                    data: "status"
                },
                {
                    data: "aksi"
                }
            ]
        });

        function deactive(e) {
            Swal.fire({
                title: 'Apakah anda yakin ingin menonaktifkan data?',
                text: ' Data yang dipilih akan dihapus!',
                iconHtml: '<img src="{{ url('/app-assets/img/alert.png') }}">',
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yakin",
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

        function active(e) {
            Swal.fire({
                title: 'Apakah anda yakin ingin mengaktifkan data?',
                text: ' Data yang dipilih akan diaktifkan!',
                iconHtml: '<img src="{{ url('/app-assets/img/alert.png') }}">',
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yakin",
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
