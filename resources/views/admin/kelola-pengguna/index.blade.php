@extends('partials_admin.template')

@section('page_style')
    <link rel="stylesheet" href="../../app-assets/vendor/libs/sweetalert2/sweetalert2.css" />
    <style>
        .tooltip-inner {
            max-width: 210px;
            /* If max-width does not work, try using width instead */
            width: 900px;
        }
    </style>
@endsection

@section('main')
    <div class="row">
        <div class="col-md-9 col-12">
            <nav aria-label="breadcrumb">
                <div class="row ">
                    <div class="">
                        <h4 class="fw-bold text-sm"><span class="text-muted fw-light text-xs"></span>
                            Kelola Pengguna
                        </h4>
                    </div>
                </div>
        </div>
        <div class="col-md-3 col-12 mb-3 ps-5 d-flex align-items-center justify-content-between">
            <select class="select2 form-select" data-placeholder="Pilih Tahun Ajaran">
                <option value="1">2023/2024 Genap</option>
                <option value="2">2023/2024 Ganjil</option>
                <option value="3">2022/2023 Genap</option>
                <option value="4">2022/2023 Ganjil</option>
                <option value="5">2021/2022 Genap</option>
                <option value="6">2021/2022 Ganjil</option>
            </select>
            {{-- <button class="btn btn-success waves-effect waves-light" data-bs-toggle="offcanvas" data-bs-target="#modalSlide"><i class="tf-icons ti ti-filter"></i>
    </button> --}}
            <div class="col-md-6 col-12 text-end">
                <button class="btn btn-success waves-effect waves-light" data-bs-toggle="modal"
                    data-bs-target="#modalTambahMitra">Tambah Mitra</button>
            </div>
        </div>
        <div class="col-xl-12">
            <div class="nav-align-top">
                <div class="tab-content mt-4">
                    <div class="tab-pane fade show active" id="navs-pills-justified-users" role="tabpanel">
                        <div class="card-datatable table-responsive">
                            <table class="table" id="table-kelola-mitra1">
                                <thead>
                                    <tr>
                                        <th>NOMOR</th>
                                        <th style="min-width: 125px;">NAMA</th>
                                        <th>EMAIL</th>
                                        <th>TELEPON</th>
                                        <th>ROLE</th>
                                        <th>STATUS</th>
                                        <th>AKSI</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Modal Edit> --}}

        {{-- <div class="modal fade" id="modalEditMitra" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTambahMitraTitle">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="nameWithTitle" class="form-label">Nama Pengguna</label>
                                    <input type="text" id="nameWithTitle" class="form-control"
                                        placeholder="Masukkan Nama Pengguna" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="teleponWithTitle" class="form-label">No.Telepon</label>
                                    <input type="text" id="teleponWithTitle" class="form-control"
                                        placeholder="Masukan No. Telepon" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="emailWithTitle" class="form-label">Email</label>
                                    <input type="text" id="emailWithTitle" class="form-control"
                                        placeholder="Masukan Email" />
                                </div>
                            </div>
                            <label for="select2Basic" class="form-label">Role</label>
                            <select id="select2Basic" class="select2 form-select form-select-lg" data-allow-clear="true">
                                <option value="AK">Dosen Wali</option>
                                <option value="HI">Pembimbing Akademik</option>
                                <option value="CA">Kaprodi</option>
                                <option value="NV">Koordinator Magang</option>
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">
                                Close
                            </button>
                            <button type="button" class="btn btn-success">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div> --}}

        {{--  Modal Form --}}
        @include('admin.kelola-pengguna.modal')


        {{-- Modal Alert --}}
        <div class="modal fade" id="modalalert" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center">
                        <img src="../../app-assets/img/alert.png" alt="">
                        <h5 class="modal-title" id="modal-title">Apakah anda yakin ingin menonaktifkan data</h5>
                        <div class="swal2-html-container" id="swal2-html-container" style="display: block;">
                            Data yang dipilih akan non-aktif</div>
                    </div>
                    <div class="modal-footer" style="display: flex; justify-content:center;">
                        <button type="submit" id="modal-button" class="btn btn-success">Ya, Yakin</button>
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
                    "nomor": "1",
                    "nama": "Jennie Ruby Jane <br> 6701250405",
                    "email": "angkasahr@gmail.com",
                    "telepon": "+6281298076589",
                    "role": "Dosen Wali",
                    "status": "<span class='badge bg-label-success'>Aktif</span>",
                    "aksi": "<a class='btn-icon text-warning waves-effect waves-light' data-bs-toggle='modal' data-bs-target='#modalTambahMitra'><i class='ti ti-edit'></i></a><a class='btn-icon text-danger waves-effect waves-light'><i class='ti ti-circle-x' data-bs-toggle='modal' data-bs-target='#modalalert'></i></a>",
                },
                {
                    "nomor": "2",
                    "nama": "Jennie Ruby Jane <br> 6701250405",
                    "email": "arvinbgskr@gmail.com",
                    "telepon": "+6281298076589",
                    "role": "Pembimbing Akademik",
                    "status": "<span class='badge bg-label-success'>Aktif</span>",
                    "aksi": "<a class='btn-icon text-warning waves-effect waves-light' data-bs-toggle='modal' data-bs-target='#modalTambahMitra''><i class='ti ti-edit'></i></a><a class='btn-icon text-danger waves-effect waves-light'><i class='ti ti-circle-x' data-bs-toggle='modal' data-bs-target='#modalalert'></i></a>",
                },
                {
                    "nomor": "3",
                    "nama": "Jennie Ruby Jane <br> 6701250405",
                    "email": "kdviws@gmail.com",
                    "telepon": "+6281298076589",
                    "role": "Kaprodi",
                    "status": "<span class='badge bg-label-success'>Aktif</span>",
                    "aksi": "<a class='btn-icon text-warning waves-effect waves-light' data-bs-toggle='modal' data-bs-target='#modalTambahMitra''><i class='ti ti-edit'></i></a><a class='btn-icon text-danger waves-effect waves-light'><i class='ti ti-circle-x' data-bs-toggle='modal' data-bs-target='#modalalert'></i></a>",
                },
                {
                    "nomor": "4",
                    "nama": "Jennie Ruby Jane <br> 6701250405",
                    "email": "kevnath@gmail.com",
                    "telepon": "+6281298076589",
                    "role": "Koordinator Magang",
                    "status": "<span class='badge bg-label-success'>Aktif</span>",
                    "aksi": "<a class='btn-icon text-warning waves-effect waves-light'  data-bs-toggle='modal' data-bs-target='#modalTambahMitra''><i class='ti ti-edit'></i></a><a class='btn-icon text-danger waves-effect waves-light'><i class='ti ti-circle-x' data-bs-toggle='modal' data-bs-target='#modalalert'></i></a>",
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
                        data: "telepon"
                    },
                    {
                        data: "role"
                    },
                    {
                        data: "status"
                    },
                    {
                        data: "aksi"
                    }
                ]
            });

            function edit(e) {
                let id = e.attr('data-id');

                let action = `{{ url('sesuaikan') }}/${id}`;
                var url = `{{ url('sesuaikan') }}/${id}`;
                $.ajax({
                    type: 'GET',
                    url: url,
                    success: function(response) {
                        $("#modalTambahMitraTitle").html("Edit Pengguna");
                        $("#modal-button").html("Update Data")
                        $('#modalTambahMitra form').attr('action', action);
                        $('#nama').val(response.nama);
                        $('#nohp').val(response.nohp);
                        $('#email').val(response.email);
                        $('#role').val(response.role).trigger('change');

                        $('#modal-thn-akademik').modal('show');
                    }
                });
            }

            $("#modalTambahMitra").on("hide.bs.modal", function() {

                $("#modalTambahMitraTitle").html("Tambah Pengguna");
                $("#modal-button").html("Simpan")
                $('#modalTambahMitra form')[0].reset();
                $('#modalTambahMitra form #role').val('').trigger('change');
                $('#modalTambahMitra form').attr('action', "{{ url('sesuaikan') }}");
                $('.invalid-feedback').removeClass('d-block');
                $('.form-control').removeClass('is-invalid');
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
    @endsection
