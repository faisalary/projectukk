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
            <h4 class="fw-bold"><span class="text-muted fw-light">Master Data /</span> Universitas</h4>
        </div>
        <div class="col-md-6 col-12 text-end">
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modal-universitas">Tambah
                Universitas</button>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-12">
            <div class="card">
                <div class="card-datatable table-responsive">
                    <table class="table" id="table-master-univ">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Universitas</th>
                                <th>Alamat</th>
                                <th>Kota</th>
                                <th>Telp</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->

    <div class="modal fade" id="modal-universitas" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">

            <div class="modal-content">
                <div class="modal-header text-center d-block">
                    <h5 class="modal-title" id="modal-title">Tambah Universitas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form class="default-form" id="" method="POST" action="{{ route('universitas.store') }}">
                    @csrf
                    <div class="modal-body">

                        <div class="row">
                            <div class="col mb-2 form-input">
                                <label for="universitas" class="form-label">Nama Universitas</label>
                                <input type="text" id="namauniv" name="namauniv" class="form-control"
                                    placeholder="Nama Universitas" />
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-2 form-input">
                                <label for="jalan" class="form-label">Jalan</label>
                                <textarea class="form-control" id="jalan" name="jalan" placeholder="Jalan"></textarea>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-2 form-input">
                                <label for="kota" class="form-label">Kota</label>
                                <input type="text" id="kota" name="kota" class="form-control"
                                    placeholder="Kota" />
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-2 form-input">
                                <label for="telp" class="form-label">Telp</label>
                                <input type="text" id="telp" name="telp" class="form-control"
                                    placeholder="telp" />
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
        var table = $('#table-master-univ').DataTable({
            ajax: '{{ route('universitas.show') }}',
            serverSide: false,
            processing: true,
            deferRender: true,
            type: 'GET',
            destroy: true,
            columns: [{
                    data: 'DT_RowIndex'
                },

                {
                    data: 'namauniv',
                    name: 'namauniv'
                },
                {
                    data: 'jalan',
                    name: 'jalan'
                },
                {
                    data: 'kota',
                    name: 'kota'
                },
                {
                    data: 'telp',
                    name: 'telp'
                },
                {
                    data: 'status',
                    name: 'status'
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
                            url: `{{ url('master/universitas/status') }}/${id}`,
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
                                        $('#table-master-univ').DataTable().ajax
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

            let action = `{{ url('master/universitas/update/') }}/${id}`;
            var url = `{{ url('master/universitas/edit/') }}/${id}`;
            $.ajax({
                type: 'GET',
                url: url,
                success: function(response) {
                    $("#modal-title").html("Edit Universitas");
                    $("#modal-button").html("Update Data")
                    $('#modal-universitas form').attr('action', action);
                    $('#namauniv').val(response.namauniv);
                    $('#jalan').val(response.jalan);
                    $('#kota').val(response.kota);
                    $('#telp').val(response.telp);

                    $('#modal-universitas').modal('show');
                }
            });
        }

        $("#modal-universitas").on("hide.bs.modal", function() {

            $("#modal-title").html("Add Universitas");
            $("#modal-button").html("Save Data")
            $('#modal-universitas form')[0].reset();
            $('#modal-universitas form').attr('action', "{{ url('master/universitas/store') }}");
            $('.invalid-feedback').removeClass('d-block');
            $('.form-control').removeClass('is-invalid');
        });
    </script>

    <script src="{{ url('app-assets/vendor/libs/sweetalert2/sweetalert2.js') }}"></script>
    <script src="{{ url('app-assets/js/extended-ui-sweetalert2.js') }}"></script>
@endsection
