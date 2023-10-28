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
            <h4 class="fw-bold"><span class="text-muted fw-light">Master Data /</span> Dosen</h4>
        </div>
        <div class="col-md-6 col-12 text-end">
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modal-dosen">Tambah
                Dosen</button>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-12">
            <div class="card">
                <div class="card-datatable table-responsive">
                    <table class="table" id="table-master-dosen">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Universitas</th>
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

    <div class="modal fade" id="modal-dosen" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">

            <div class="modal-content">
                <div class="modal-header text-center d-block">
                    <h5 class="modal-title" id="modal-title">Tambah Dosen</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form class="default-form" id="" method="POST" action="{{ route('dosen.store') }}">
                    @csrf
                    <div class="modal-body">

                        <div class="row">
                            <div class="col mb-2 form-input">
                                <label for="univ" class="form-label">Universitas</label>
                                <select class="form-select select2" data-placeholder="Pilih Universitas" name="id_univ"
                                    id="id_univ_add">
                                    <option>Pilih Universitas</option>
                                    @foreach ($dosen as $u)
                                        <option value="{{ $u->id_univ }}">{{ $u->namauniv }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-2 form-input">
                                <label for="nip" class="form-label">NIP</label>
                                <input class="form-control" id="nip" name="nip" placeholder="NIP" />
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-2 form-input">
                                <label for="kodedosen" class="form-label">Kode Dosen</label>
                                <input type="text" id="kodedosen" name="kodedosen" class="form-control"
                                    placeholder="Kode Dosen" />
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-2 form-input">
                                <label for="namadosen" class="form-label">Nama Dosen</label>
                                <input type="text" id="namadosen" name="namadosen" class="form-control"
                                    placeholder="Nama Dosen" />
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-2 form-input">
                                <label for="prodi" class="form-label">Prodi</label>
                                <select class="form-select select2" data-placeholder="Nama Prodi" name="id_prodi"
                                    id="id_prodi">
                                    <option>Pilih prodi</option>
                                    @foreach ($dosen as $p)
                                        <option value="{{ $p->id_prodi }}">{{ $p->namaprodi }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-2 form-input">
                                <label for="nohpdosen" class="form-label">No Telepon</label>
                                <input type="text" id="nohpdosen" name="nohpdosen" class="form-control"
                                    placeholder="No Telepon" />
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-2 form-input">
                                <label for="emaildosen" class="form-label">Email</label>
                                <input type="text" id="emaildosen" name="emaildosen" class="form-control"
                                    placeholder="Email" />
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
                </form>

            </div>
        </div>
    </div>
@endsection

@section('page_script')
    <script>
        var table = $('#table-master-dosen').DataTable({
            ajax: '{{ route('dosen.show') }}',
            serverSide: false,
            processing: true,
            deferRender: true,
            type: 'GET',
            destroy: true,
            columns: [{
                    data: 'DT_RowIndex'
                },

                {
                    data: 'univ.namauniv',
                    name: 'namauniv'
                },
                {
                    data: 'nip',
                    name: 'nip'
                },
                {
                    data: 'id_dosen',
                    name: 'id_dosen'
                },
                {
                    data: 'prodi.namaprodi',
                    name: 'namaprodi'
                },
                {
                    data: 'namadosen',
                    name: 'namadosen'
                },
                {
                    data: 'nohpdosen',
                    name: 'nohpdosen'
                },
                {
                    data: 'emaildosen',
                    name: 'emaildosen'
                },
                {
                    data: 'statusdosen',
                    name: 'statusdosen'
                },
                {
                    data: 'action',
                    name: 'action'
                }
            ]
        });

        function status(e) {
            var status = e.attr('data-status');
            var text = "";
            if (status == 0) {
                text = "Active";
            } else {
                text = "Inactive";
            }
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
                        url: `{{ url('master/dosen/status') }}/${id}`,
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
                                    $('#table-master-dosen').DataTable().ajax
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

            let action = `{{ url('master/dosen/update/') }}/${id}`;
            var url = `{{ url('master/dosen/edit/') }}/${id}`;
            $.ajax({
                type: 'GET',
                url: url,
                success: function(response) {
                    $("#modal-title").html("Edit Dosen");
                    $("#modal-button").html("Update Data")
                    $('#modal-dosen form').attr('action', action);
                    $('#nip').val(response.nip);
                    $('#namauniv').val(response.namauniv);
                    $('#kodedosen').val(response.kodedosen);
                    $('#namaprodi').val(response.namaprodi);
                    $('#namadosen').val(response.namadosen);
                    $('#nohpdosen').val(response.nohpdosen);
                    $('#emaildosen').val(response.emaildosen);

                    $('#modal-dosen').modal('show');
                }
            });
        }

        $("#modal-dosen").on("hide.bs.modal", function() {

            $("#modal-title").html("Add Dosen");
            $("#modal-button").html("Save Data")
            $('#modal-dosen form')[0].reset();
            $('#modal-dosen form').attr('action', "{{ url('master/dosen/store') }}");
            $('.invalid-feedback').removeClass('d-block');
            $('.form-control').removeClass('is-invalid');
        });
        $('#id_univ_add').on('change', function() {
                id_univx = $("#id_univ_add option:selected").val();

                $.ajax({
                    url: "{{ url('/master_mahasiswa/list-fakultas') }}" + '/' + id_univx,
                    method: "GET",
                    dataType: "json",
                    success: function(response) {
                        
                        if ($('#id_fakultas_add').data('select2')) {
                            $("#id_fakultas_add").val("");
                            $("#id_fakultas_add").trigger("change");
                            $('#id_fakultas_add').empty().trigger("change");
                        }
                        $("#id_fakultas_add").select2({
                            data: response.data,
                            dropdownParent: $('#modalTambahMahasiswa'),
                        });
                    }
                })
            });
    </script>

    <script src="{{ url('app-assets/vendor/libs/sweetalert2/sweetalert2.js') }}"></script>
    <script src="{{ url('app-assets/js/extended-ui-sweetalert2.js') }}"></script>
@endsection
