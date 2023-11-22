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

    .swal2-deny {
        display: none !important;
    }
</style>
@endsection

@section('main')
<div class="row">
    <div class="col-md-6 col-12">
        <h4 class="fw-bold"><span class="text-muted fw-light">Master Data /</span> Jenis Magang</h4>
    </div>
    <div class="col-md-6 col-12 text-end">
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modal-jenismagang">Tambah Jenis
            Magang</button>
    </div>
</div>

<div class="row mt-2">
    <div class="col-12">
        <div class="card">
            <div class="card-datatable table-responsive">
                <table class="table" id="table-master-jenis_magang">
                    <thead>
                        <tr>
                            <th>NOMOR</th>
                            <th>JENIS MAGANG</th>
                            <th>DURASI MAGANG</th>
                            <th>DOKUMEN UPLOAD</th>
                            <th>REVIEW</th>
                            <th>TIPE</th>
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

@include('masters.jenis_magang.modal')
@endsection

@section('page_script')
<script>
    var table = $('#table-master-jenis_magang').DataTable({
        ajax: '{{ route("jenismagang.show") }}',
        serverSide: false,
        processing: true,
        deferRender: true,
        type: 'GET',
        destroy: true,
        columns: [{
                data: "DT_RowIndex"
            },

            {
                data: "namajenis"
            },
            {
                data: "durasimagang"
            },
            {
                data: "is_document_upload"
            },
            {
                data: "is_review_process"
            },
            {
                data: "type"
            },
            {
                data: "status"
            },
            {
                data: "action"
            }
        ]
    });

    function edit(e) {
        let id = e.attr('data-id');

        let action = `{{ url('master/jenis-magang/update/') }}/${id}`;
        var url = `{{ url('master/jenis-magang/edit/') }}/${id}`;
        $.ajax({
            type: 'GET',
            url: url,
            success: function(response) {
                $(".modal-title").html("Edit Jenis Magang");
                $("#modal-button").html("Update Data");
                $('#modal-jenismagang form').attr('action', action);
                $('#jenis').val(response.namajenis);
                $('#durasi').val(response.durasimagang).trigger('change');
                $('#dokumen').val(response.is_document_upload);
                $('#review').val(response.is_review_process);
                $('#type').val(response.type);

                $('#modal-jenismagang').modal('show');
            }
        });
    }

    $("#modal-jenismagang").on("hide.bs.modal", function() {
        $(".modal-title").html("Tambah Jenis Magang");
        $("#modal-button").html("Save Data");
        $('#modal-jenismagang form')[0].reset();
        $('#modal-jenismagang form #durasi').val('').trigger('change');
        $('#modal-jenismagang form').attr('action', "{{ url('master/jenis-magang/store') }}");
        $('.invalid-feedback').removeClass('d-block');
        $('.form-control').removeClass('is-invalid');
    });
</script>

<script src="../../app-assets/vendor/libs/sweetalert2/sweetalert2.js"></script>
<script src="../../app-assets/js/extended-ui-sweetalert2.js"></script>
@endsection