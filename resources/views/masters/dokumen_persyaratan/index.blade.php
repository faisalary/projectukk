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
        <h4 class="fw-bold"><span class="text-muted fw-light">Master Data /</span> Dokumen Persyaratan</h4>
    </div>
    <div class="col-md-6 col-12 text-end">
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modal-dokumen">Tambah Dokumen Persyaratan</button>
    </div>
</div>
<div class="row mt-2">
    <div class="col-12">
        <div class="card">
            <div class="card-datatable table-responsive">
                <table class="table" id="table-master-dokumen">
                    <thead>
                        <tr>
                            <th>NOMOR</th>
                            <th>JENIS MAGANG</th>
                            <th>NAMA DOKUMEN</th>
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
@include('masters.dokumen_persyaratan.modal')
@endsection

@section('page_script')
<script>
    var table = $('#table-master-dokumen').DataTable({
        ajax: '{{ route("doc-syarat.show")}}',
        serverSide: false,
        processing: true,
        deferRender: true,
        type: 'GET',
        destroy: true,
        columns: [{
                data: "DT_RowIndex"
            },
            {
                data: 'jenis.namajenis',
                name: 'namajenis'
            },
            {
                data: 'namadocument',
                name: 'namadocument'
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

        let action = `{{ url('master/dokumen-persyaratan/update/') }}/${id}`;
        var url = `{{ url('master/dokumen-persyaratan/edit/') }}/${id}`;
        $.ajax({
            type: 'GET',
            url: url,
            success: function(response) {
                $("#modal-title").html("Edit Dokumen Persyaratan");
                $("#modal-button").html("Update Data")
                $('#modal-dokumen form').attr('action', action);
                $('#jenis').val(response.id_jenismagang).trigger('change');
                $('#namadokumen').val(response.namadocument);

                $('#modal-dokumen').modal('show');
            }
        });
    }

    $("#modal-dokumen").on("hide.bs.modal", function() {

        $("#modal-title").html("Tambah Dokumen Syarat");
        $("#modal-button").html("Simpan")
        $('#modal-dokumen form')[0].reset();
        $('#modal-dokumen form #jenis').val('').trigger('change');
        $('#modal-dokumen form').attr('action', "{{ url('master/dokumen-persyaratan/store') }}");
        $('.invalid-feedback').removeClass('d-block');
        $('.form-control').removeClass('is-invalid');
    });
</script>

<script src="../../app-assets/vendor/libs/sweetalert2/sweetalert2.js"></script>
<script src="../../app-assets/js/extended-ui-sweetalert2.js"></script>
@endsection