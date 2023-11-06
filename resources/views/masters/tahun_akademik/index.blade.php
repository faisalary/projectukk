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
        <h4 class="fw-bold"><span class="text-muted fw-light">Master Data /</span> Tahun Akademik</h4>
    </div>
    <div class="col-md-6 col-12 text-end">
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modal-thn-akademik">Tambah Tahun Akademik</button>
    </div>
</div>
<div class="row mt-2">
    <div class="col-12">
        <div class="card">
            <div class="card-datatable table-responsive">
                <table class="table" id="table-master-tahun-akademik">
                    <thead>
                        <tr>
                            <th>NOMOR</th>
                            <th>TAHUN AJARAN</th>
                            <th>SEMESTER</th>
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
@include('masters.tahun_akademik.modal')


@endsection

@section('page_script')
<script>
    $('#table-master-tahun-akademik').DataTable({
        ajax: '{{ route("thn-akademik.show")}}',
        serverSide: false,
        processing: true,
        deferRender: true,
        type: 'GET',
        destroy: true,
        columns: [{
                data: "DT_RowIndex"
            },
            {
                data: 'tahun',
                name: 'tahun'
            },
            {
                data: 'semester',
                name: 'semester'
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

        let action = `{{ url('master/tahun-akademik/update/') }}/${id}`;
        var url = `{{ url('master/tahun-akademik/edit/') }}/${id}`;
        $.ajax({
            type: 'GET',
            url: url,
            success: function(response) {
                $("#modal-title").html("Edit Tahun Akademik");
                $("#modal-button").html("Update Data")
                $('#modal-thn-akademik form').attr('action', action);
                $('#tahun').val(response.tahun);
                $('#semester').val(response.semester).trigger('change');

                $('#modal-thn-akademik').modal('show');
            }
        });
    }

    $("#modal-thn-akademik").on("hide.bs.modal", function() {

        $("#modal-title").html("Tambah Tahun Akademik");
        $("#modal-button").html("Simpan")
        $('#modal-thn-akademik form')[0].reset();
        $('#modal-thn-akademik form #semester').val('').trigger('change');
        $('#modal-thn-akademik form').attr('action', "{{ url('master/tahun-akademik/store') }}");
        $('.invalid-feedback').removeClass('d-block');
        $('.form-control').removeClass('is-invalid');
    });
</script>

<script src="../../app-assets/vendor/libs/sweetalert2/sweetalert2.js"></script>
<script src="../../app-assets/js/extended-ui-sweetalert2.js"></script>
@endsection