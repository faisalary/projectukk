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
            <h4 class="fw-bold"><span class="text-muted fw-light">Master Data /</span> Mahasiswa</h4>
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
                    <table class="table" id="table-master-mahasiswa">
                        <thead>
                            <tr>
                                <th>NOMOR</th>
                                <th>UNIVERSITAS</th>
                                <th>FAKULTAS</th>
                                <th>PRODI</th>
                                <th>NIM</th>
                                <th>ANGKATAN</th>
                                <th>NAMA MAHASISWA</th>
                                <th>NOMOR TELEPON</th>
                                <th>EMAIL</th>
                                <th>ALAMAT</th>
                                <th style="min-width:100px;">AKSI</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>



    <!-- Modal -->
    <div class="modal fade" id="modalTambahMahasiswa" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header text-center d-block">
                    <h5 class="modal-title">Tambah Mahasiswa</h5>
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
                            <label for="Fakultas" class="form-label">Fakultas</label>
                            <select id="Fakultas" class="form-select">
                                <option>Pilih Fakultas</option>
                                <option value="1">FIT</option>
                                <option value="2">FEB</option>
                                <option value="2">FIK</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-2">
                            <label for="prodi" class="form-label">Prodi</label>
                            <select id="prodi" class="form-select">
                                <option>Pilih Prodi</option>
                                <option value="1">D3 Sistem Informasi</option>
                                <option value="2">S1 Design Interior</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-2">
                            <label for="nim" class="form-label">NIM</label>
                            <input type="text" id="nip" class="form-control" placeholder="NIM" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-2">
                            <label for="angkatan" class="form-label">Angkatan</label>
                            <input type="text" id="angkatan" class="form-control" placeholder="Angkatan" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-2">
                            <label for="namaMahasiswa" class="form-label">Nama Mahasiswa</label>
                            <input type="text" id="NamaMahasiswa" class="form-control" placeholder="Nama Mahasiswa" />
                        </div>
                        <div class="row">
                            <div class="col mb-2">
                                <label for="telp" class="form-label">Nomor Telepon</label>
                                <input type="text" id="telp" class="form-control" placeholder="Nomor Telepon" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-2">
                                <label for="email" class ="form-label">Email</label>
                                <input type="text" id="email" class="form-control" placeholder="Email" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-2">
                                <label for="alamat" class="form-label">Alamat</label>
                                <textarea class="form-control" id="alamat" placeholder="Alamat"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalEditMahasiswa" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header text-center d-block">
                    <h5 class="modal-title">Edit Mahasiswa</h5>
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
                            <label for="Fakultas" class="form-label">Fakultas</label>
                            <select id="Fakultas" class="form-select">
                                <option>Pilih Fakultas</option>
                                <option value="1">FIT</option>
                                <option value="2">FEB</option>
                                <option value="2">FIK</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-2">
                            <label for="prodi" class="form-label">Prodi</label>
                            <select id="prodi" class="form-select">
                                <option>Pilih Prodi</option>
                                <option value="1">D3 Sistem Informasi</option>
                                <option value="2">S1 Design Interior</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-2">
                            <label for="nim" class="form-label">NIM</label>
                            <input type="text" id="nip" class="form-control" placeholder="NIM" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-2">
                            <label for="angkatan" class="form-label">Angkatan</label>
                            <input type="text" id="angkatan" class="form-control" placeholder="Angkatan" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-2">
                            <label for="namaMahasiswa" class="form-label">Nama Mahasiswa</label>
                            <input type="text" id="NamaMahasiswa" class="form-control"
                                placeholder="Nama Mahasiswa" />
                        </div>
                        <div class="row">
                            <div class="col mb-2">
                                <label for="telp" class="form-label">Nomor Telepon</label>
                                <input type="text" id="telp" class="form-control" placeholder="Nomor Telepon" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-2">
                                <label for="email" class ="form-label">Email</label>
                                <input type="text" id="email" class="form-control" placeholder="Email" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-2">
                                <label for="alamat" class="form-label">Alamat</label>
                                <textarea class="form-control" id="alamat" placeholder="Alamat"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page_script')
    <script src="../../app-assets/vendor/libs/sweetalert2/sweetalert2.js"></script>
    <script src="../../app-assets/js/extended-ui-sweetalert2.js"></script>

    <script>
        var jsonData = [{
                "nomor": "1",
                "universitas": "Univestitas Telkom",
                "fakultas": "Fakultas Ilmu Terapan",
                "prodi": "D3 Sistem informasi",
                "nim": "6701215679",
                "angkatan": "46",
                "nama mahasiswa": "Roseanne Park",
                "nomor telepon": "081222376426",
                "email": "rosepark@gmail.com",
                "alamat": "jln. rancabolang no.123",
                "aksi": "<a data-bs-toggle='modal' data-bs-target='#modalEditMahasiswa' class='btn-icon text-warning waves-effect waves-light'><i class='tf-icons ti ti-edit' ></i></a> <a onclick = deactive($(this))  class='btn-icon text-danger waves-effect waves-light'><i class='tf-icons ti ti-trash'></i></a>"
            },
            {
                "nomor": "2",
                "universitas": "Univestitas Telkom",
                "fakultas": "Fakultas Ilmu Terapan",
                "prodi": "D3 Sistem informasi",
                "nim": "6701215679",
                "angkatan": "46",
                "nama mahasiswa": "Roseanne Park",
                "nomor telepon": "081222376426",
                "email": "rosepark@gmail.com",
                "alamat": "jln. rancabolang no.123",
                "aksi": "<a data-bs-toggle='modal' data-bs-target='#modalEditMahasiswa' class='btn-icon text-warning waves-effect waves-light'><i class='tf-icons ti ti-edit' ></i><a onclick = deactive($(this))  class='btn-icon text-danger waves-effect waves-light'><i class='tf-icons ti ti-trash'></i></a>"
            },
            {
                "nomor": "3",
                "universitas": "Univestitas Telkom",
                "fakultas": "Fakultas Ilmu Terapan",
                "prodi": "D3 Sistem informasi",
                "nim": "6701215679",
                "angkatan": "46",
                "nama mahasiswa": "Roseanne Park",
                "nomor telepon": "081222376426",
                "email": "rosepark@gmail.com",
                "alamat": "jln. rancabolang no.123",
                "aksi": "<a data-bs-toggle='modal' data-bs-target='#modalEditMahasiswa' class='btn-icon text-warning waves-effect waves-light'><i class='tf-icons ti ti-edit' ></i><a onclick = deactive($(this))  class='btn-icon text-danger waves-effect waves-light'><i class='tf-icons ti ti-trash'></i></a>"
            }

        ];

        var table = $('#table-master-mahasiswa').DataTable({
            "data": jsonData,
            columns: [{
                    data: "nomor"
                },
                {
                    data: "universitas"
                },
                {
                    data: "fakultas"
                },
                {
                    data: "prodi"
                },
                {
                    data: "nim"
                },
                {
                    data: "angkatan"
                },
                {
                    data: "nama mahasiswa"
                },
                {
                    data: "nomor telepon"
                },
                {
                    data: "email"
                },
                {
                    data: "alamat"
                },
                {
                    data: "aksi"
                },
            ]
        });

        function deactive(e) {
            Swal.fire({
                title: 'Apakah anda yakin ingin menghapus data?',
                text: ' Data yang dipilih akan dihapus!',
                iconHtml: '<img src="{{ url('/app-assets/img/alert.png') }}">',
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Hapus",
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
@endsection
