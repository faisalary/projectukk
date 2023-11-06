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
        <h4 class="fw-bold"><span class="text-muted fw-light">Master Data /</span> Nilai Mutu</h4>
    </div>
    <div class="col-md-6 col-12 text-end">
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modal-nilai-mutu">Tambah Nilai Mutu</button>
    </div>
    <!-- <div class="col-md-3 col-12 mb-2">
        <select class="select2 form-select" data-placeholder="Pilih Universitas">
            <option value="1">Universitas Telkom</option>
            <option value="2">Universitas Telkom</option>
            <option value="3">Universitas Telkom</option>
        </select>
    </div> -->
</div>
<div class="row mt-2">
    <div class="col-12">
        <div class="card">
            <div class="card-datatable table-responsive">
                <table class="table" id="table-master-nilai-mutu">
                    <thead>
                        <tr>
                            <th>NOMOR</th>
                            <th>NILAI MINIMAL</th>
                            <th>NILAI MAKSIMAL</th>
                            <th>NILAI MUTU</th>
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
@include('masters.nilai_mutu.modal')

@endsection

@section('page_script')
<script src="../../app-assets/vendor/libs/jquery-repeater/jquery-repeater.js"></script>
<script src="../../app-assets/js/forms-extras.js"></script>
<script>
    // var jsonData = [{
    //         "nomor": "1",
    //         "minimal": "69",
    //         "maksimal": "71,3",
    //         "mutu": "C",
    //         "aksi": "<a data-bs-toggle='modal' data-bs-target='#modalEditNilaiMutu' class='btn-icon text-warning waves-effect waves-light'><i class='tf-icons ti ti-edit' ></i></a> <a onclick = deactive($(this))  class='btn-icon text-danger waves-effect waves-light'><i class='tf-icons ti ti-trash'></i></a>"
    //     },
    //     {
    //         "nomor": "2",
    //         "minimal": "67",
    //         "maksimal": "66,2",
    //         "mutu": "D",
    //         "aksi": "<a data-bs-toggle='modal' data-bs-target='#modalEditNilaiMutu' class='btn-icon text-warning waves-effect waves-light'><i class='tf-icons ti ti-edit' ></i></a> <a onclick = deactive($(this))  class='btn-icon text-danger waves-effect waves-light'><i class='tf-icons ti ti-trash'></i></a>"
    //     },
    //     {
    //         "nomor": "3",
    //         "minimal": "78",
    //         "maksimal": "80",
    //         "mutu": "B",
    //         "aksi": "<a data-bs-toggle='modal' data-bs-target='#modalEditNilaiMutu' class='btn-icon text-warning waves-effect waves-light'><i class='tf-icons ti ti-edit' ></i></a> <a onclick = deactive($(this))  class='btn-icon text-danger waves-effect waves-light'><i class='tf-icons ti ti-trash'></i></a>"
    //     }
    // ];

    $('#table-master-nilai-mutu').DataTable({
        ajax: '{{ route("nilai-mutu.show")}}',
        serverSide: false,
        processing: true,
        deferRender: true,
        type: 'GET',
        destroy: true,
        columns: [{
                data: 'DT_RowIndex'
            },
            {
                data: 'nilaimin',
                name: 'nilaimin'
            },
            {
                data: 'nilaimax',
                name: 'nilaimax'
            },

            {
                data: 'nilaimutu',
                name: 'nilaimutu'
            },

            {
                data: 'status',
                name: 'status'
            },

            {
                data: 'action',
                name: 'action'
            },
        ]
    });

    function edit(e) {
        let id = e.attr('data-id');

        let action = `{{ url('master/nilai-mutu/update/') }}/${id}`;
        var url = `{{ url('master/nilai-mutu/edit/') }}/${id}`;
        $.ajax({
            type: 'GET',
            url: url,
            success: function(response) {
                $("#modal-title").html("Edit Nilai Mutu");
                $("#modal-button").html("Update Data")
                $('#modal-nilai-mutu form').attr('action', action);
                $('#minimal').val(response.nilaimin);
                $('#maksimal').val(response.nilaimax);
                $('#mutu').val(response.nilaimutu);

                $('#modal-nilai-mutu').modal('show');
            }
        });
    }

    $("#modal-nilai-mutu").on("hide.bs.modal", function() {

        $("#modal-title").html("Tambah Nilai Mutu");
        $("#modal-button").html("Simpan")
        $('#modal-nilai-mutu form')[0].reset();
        $('#modal-nilai-mutu form').attr('action', "{{ url('master/nilai-mutu/store') }}");
        $('.invalid-feedback').removeClass('d-block');
        $('.form-control').removeClass('is-invalid');
    });
</script>

<script src="../../app-assets/vendor/libs/sweetalert2/sweetalert2.js"></script>
<script src="../../app-assets/js/extended-ui-sweetalert2.js"></script>
@endsection