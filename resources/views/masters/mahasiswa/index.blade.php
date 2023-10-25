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
                    <select id="univ" class="select2 form-select">
                        <option value="1">Telkom</option>
                        <option value="2">Telyu</option>
                    </select>
                </div>
            </div>
            <div class="col-md-10 col-12 text-end">
                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modal-mahasiswa">Tambah
                    Mahasiswa</button>
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

        <div class="modal fade" id="modal-mahasiswa" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">

                <div class="modal-content">
                    <div class="modal-header text-center d-block">
                        <h5 class="modal-title">Tambah Mahasiswa</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form class="default-form" id="" method="POST" action="{{ route('mahasiswa.store') }}">
                        @csrf
                        <div class="modal-body">

                            <div class="row">
                                <div class="col mb-2 form-input">
                                    <label for="univ" class="form-label">Universitas</label>
                                    <select class="form-select select2" data-placeholder="Pilih Universitas" name="id_univ">
                                        <option>Pilih Universitas</option>
                                        @foreach ($universitas as $u)
                                            <option value="{{ $u->id_univ }}">{{ $u->namauniv }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-2 form-input">
                                    <label for="fakultas" class="form-label">Fakultas</label>
                                    <select class="form-select select2" data-placeholder="Pilih Fakultas"
                                        name="id_fakultas">
                                        @foreach ($fakultas as $f)
                                            <option value="{{ $f->id_fakultas }}">{{ $f->namafakultas }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-2 form-input">
                                    <label for="prodi" class="form-label">Prodi</label>
                                    <select class="form-select select2" data-placeholder="Pilih Prodi" name="id_prodi">
                                        @foreach ($prodi as $p)
                                            <option value="{{ $p->id_prodi }}">{{ $p->namaprodi }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-2 form-input">
                                    <label for="nim" class="form-label">NIM</label>
                                    <input type="text" name="nim" class="form-control" placeholder="NIM" />
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-2 form-input">
                                    <label for="angkatan" class="form-label">Angkatan</label>
                                    <input type="text" name="angkatan" class="form-control" placeholder="Angkatan" />
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-2 form-input">
                                    <label for="namamhs" class="form-label">Nama Mahasiswa</label>
                                    <input type="text" name="namamhs" class="form-control"
                                        placeholder="Nama Mahasiswa" />
                                    <div class="invalid-feedback"></div>
                                </div>
                                <div class="row">
                                    <div class="col mb-2 form-input">
                                        <label for="nohpmhs" class="form-label">Nomor Telepon</label>
                                        <input type="text" name="nohpmhs" class="form-control"
                                            placeholder="Nomor Telepon" />
                                        <div class="invalid-feedback"></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col mb-2 form-input">
                                        <label for="emailmhs" class ="form-label">Email</label>
                                        <input type="text" name="emailmhs" class="form-control"
                                            placeholder="Email" />
                                        <div class="invalid-feedback"></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col mb-2 form-input">
                                        <label for="alamatmhs" class="form-label">Alamat</label>
                                        <textarea class="form-control" name="alamatmhs" placeholder="Alamat"></textarea>
                                        <div class="invalid-feedback"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">
                                    Close
                                </button>
                                <button type="submit" id="modal-button" class="btn btn-success">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endsection

    @section('page_script')    
        <script>
            var table = $('#table-master-mahasiswa').DataTable({
                ajax: '{{ route('mahasiswa.show') }}',
                serverSide: false,
                processing: true,
                deferRender: true,
                type: 'GET',
                destroy: true,
                columns: [{
                        data: "DT_RowIndex"
                    },
                    {
                        data: "namauniv",
                        name: "namauniv"
                    },
                    {
                        data: "namafakultas",
                        name: "namafakultas"
                    },
                    {
                        data: "namaprodi",
                        name: "namaprodi"
                    },
                    {
                        data: "nim",
                        name: "nim"
                    },
                    {
                        data: "angkatan",
                        name: "angkatan"
                    },
                    {
                        data: "namamhs",
                        name: "namamhs"
                    },
                    {
                        data: "nohpmhs",
                        name: "nohpmhs"
                    },
                    {
                        data: "emailmhs",
                        name: "emailmhs"
                    },
                    {
                        data: "alamatmhs",
                        name: "alamatmhs"
                    },
                    {
                        data: "action",
                        name: "action"
                    },
                ]
            });

            function status(e) {
            var status = e.attr('data-status');
            var text = "";
            Swal.fire({

                title: 'Are you sure?',
                text: "The selected data will be " + text,
                icon: 'warning',
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, ' + text + '!',
                showConfirmButton: true
                }).then(function(result) {

                    if (result.value) {
                        var id = e.attr('data-id');
                        let data = {
                            'id': id,
                        }
                        jQuery.ajax({
                            method: "POST",
                            data: data,
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                    'content')
                            },
                            url: `{{ url('master/mahasiswa/status') }}/${id}`,
                            success: function(data) {

                                if (data.error) {

                                    Swal.fire({
                                        type: "error",
                                        title: 'Oops...',
                                        text: data.message,
                                        confirmButtonClass: 'btn btn-success',
                                    })

                                } else {

                                    setTimeout(function() {
                                        $('#table-master-mahasiswa').DataTable().ajax
                                            .reload();

                                    }, 1000);

                                    Swal.fire({
                                        icon: "success",
                                        title: 'Succeed!',
                                        text: data.message,
                                        showConfirmButton: false,
                                        timer: 2000,
                                    })

                                }
                            }
                        });

                    }
            });
        }

        function edit(e) {
            let id = e.attr('data-id');

            let action = `{{ url('master/mahasiswa/update/') }}/${id}`;
            var url = `{{ url('master/mahasiswa/edit/') }}/${id}`;
            $.ajax({
                type: 'GET',
                url: url,
                success: function(response) {
                    $("#modal-title").html("Edit Mahasiswa");
                    $("#modal-button").html("Update Data")
                    $('#modal-mahasiswa form').attr('action', action);
                    $('#nim').val(response.nim);
                    $('#angkatan').val(response.angkatan);
                    $('#id_prodi').val(response.id_prodi);
                    $('#id_univ').val(response.id_univ);
                    $('#id_fakultas').val(response.id_fakultas);
                    $('#namamhs').val(response.namamhs);
                    $('#alamatmhs').val(response.alamatmhs);
                    $('#emailmhs').val(response.emailmhs);
                    $('#nohpmhs').val(response.nohpmhs);

                    $('#modal-mahasiswa').modal('show');
                }
            });
        }

        $("#modal-mahasiswa").on("hide.bs.modal", function() {

            $("#modal-title").html("Add Mahasiswa");
            $("#modal-button").html("Save Data")
            $('#modal-mahasiswa form')[0].reset();
            $('#modal-mahasiswa form').attr('action', "{{ url('master/mahasiswa/store') }}");
            $('.invalid-feedback').removeClass('d-block');
            $('.form-control').removeClass('is-invalid');
        });
    </script>

    <script src="{{ url('app-assets/vendor/libs/sweetalert2/sweetalert2.js') }}"></script>
    <script src="{{ url('app-assets/js/extended-ui-sweetalert2.js') }}"></script>
@endsection
