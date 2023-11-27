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
@include('masters.universitas.modal')

@endsection

@section('page_script')
<script>
    var table = $('#table-master-univ').DataTable({
        ajax: '{{ route("universitas.show")}}',
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