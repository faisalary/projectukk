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
                                <th style="min-width:150px;">Universitas</th>
                                {{-- <th>NAMA FAKULTAS</th>
                                <th>NAMA PRODI</th> --}}
                                <th>NIP</th>
                                <th style="min-width:25px;">KODE DOSEN</th>
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
@endsection
    <!-- Modal -->

@include('masters.dosen.modal')

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

                // {
                //     data: 'univ.namauniv',
                //     name: 'namauniv'    
                // },
                // {
                //     data: function(data) {
                //         return (data.prodi.fakultas != null) ? data.prodi.fakultas.namafakultas : '-';
                //     },
                //     name: 'namafakultas'
                // },
                // {
                //     data: 'prodi.namaprodi',
                //     name: 'namaprodi'
                // },
                {
                    data: null,
                    name: 'combined_column',
                    render: function(data, type, row) {
                        return data.univ.namauniv + '<br>' + (data.prodi.fakultas ? data.prodi.fakultas.namafakultas + '<br>' : '') + data.prodi.namaprodi;
                    }
                },
                {
                    data: 'nip',
                    name: 'nip'
                },
                {
                    data: 'kode_dosen',
                    name: 'kode_dosen'
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
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'action',
                    name: 'action'
                }
            ]
        });

        
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
                    $('#id_univ').val(response.id_univ).change();
                    $('#namafakultas').val(response.id_fakultas).change();
                    $('#kode_dosen').val(response.kode_dosen);
                    $('#namaprodi').val(response.id_prodi).change();
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

    </script>

    <script src="{{ url('app-assets/vendor/libs/sweetalert2/sweetalert2.js') }}"></script>
    <script src="{{ url('app-assets/js/extended-ui-sweetalert2.js') }}"></script>

@endsection
