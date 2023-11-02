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
        <div class="col-md-12 col-12">
            <h4 class="fw-bold"><span class="text-muted fw-light">Master Data /</span> Fakultas</h4>
        </div>
        <div class="col-md-3 col-12 mb-2">
            <select class="form-select select2" id="id_univ" name="namauniv" data-placeholder="Pilih Universitas">
                <option disabled selected>Pilih Universitas</option>
                @foreach ($universitas as $u)
                    <option value="{{ $u->id_univ }}">{{ $u->namauniv }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-9 col-12 text-end">
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modal-fakultas">Tambah Fakultas</button>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-12">
            <div class="card">
                <div class="card-datatable table-responsive">
                    <table class="table" id="table-master-fakultas">
                        <thead>
                            <tr>
                                <th>NOMOR</th>
                                <th>UNIVERSITAS</th>
                                <th>NAMA FAKULTAS</th>
                                <th>STATUS</th>
                                <th>AKSI</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    @include('masters.fakultas.modal')
@endsection

@section('page_script')
    <script>
        $(document).ready(function() {
            fakultasList();
            // $(".custom-select2").select2();
        });



        $("#id_univ").on('change', function() {
            // alert($('#namauniv').val());
            fakultasList($('#id_univ').val());
        })

        function fakultasList(id_univ = 'all') {
            var table = $('#table-master-fakultas').DataTable({
                ajax: `{{ url('master/fakultas/show/${id_univ}') }}`,
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
                        data: 'namafakultas',
                        name: 'namafakultas'
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
        }



        function edit(e) {
            let id = e.attr('data-id');

            let action = `{{ url('master/fakultas/update/') }}/${id}`;
            var url = `{{ url('master/fakultas/edit/') }}/${id}`;
            $.ajax({
                type: 'GET',
                url: url,
                success: function(response) {
                    $("#modal-title").html("Edit Fakultas");
                    $("#modal-button").html("Update Data")
                    $('#modal-fakultas form').attr('action', action);
                    $('#id_univ').val(response.id_univ).change();
                    $('#namafakultas').val(response.namafakultas);
                    $('#modal-fakultas').modal('show');
                }
            });
        }

        $("#modal-fakultas").on("hide.bs.modal", function() {

            $("#modal-title").html("Add Fakultas");
            $("#modal-button").html("Save Data")
            $('#modal-fakultas form')[0].reset();
            $('#modal-fakultas form').attr('action', "{{ url('master/fakultas/store') }}");
            $('.invalid-feedback').removeClass('d-block');
            $('.form-control').removeClass('is-invalid');
        });
    </script>

    <script src="{{ url('app-assets/vendor/libs/sweetalert2/sweetalert2.js') }}"></script>
    <script src="{{ url('app-assets/js/extended-ui-sweetalert2.js') }}"></script>
@endsection
