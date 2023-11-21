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

    .trash-icon {
        border: 2px solid red;
        border-radius: 5px;
        padding: 3px;
    }
</style>
@endsection

@section('main')
<div class="row">
    <div class="col-md-6 col-12">
        <h4 class="fw-bold"><span class="text-muted fw-light">Master Data /</span> Komponen Penilaian</h4>
    </div>
    <div class="col-md-6 col-12 text-end">
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modal-komponen-nilai">Tambah Komponen
            Penilaian</button>
    </div>
</div>
<div class="row mt-2">
    <div class="col-12">
        <div class="card">
            <div class="card-datatable table-responsive">
                <table class="table" id="table-master-komponen">
                    <thead>
                        <tr>

                            <th>JENIS MAGANG</th>
                            <th>NAMA KOMPONEN</th>
                            <th>DINILAI OLEH</th>
                            <th>BOBOT</th>
                            <th>TOTAL BOBOT</th>
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
@include('masters.komponen_penilaian.modal')


@endsection

@section('page_script')
<script src="https://cdn.jsdelivr.net/npm/jquery.repeater@1.2.1/jquery.repeater.min.js"></script>
<!-- <script src="https://datatables.net/download/build/nightly/jquery.dataTables.js"></script>
<script src="https://cdn.rawgit.com/ashl1/datatables-rowsgroup/v1.0.0/dataTables.rowsGroup.js"></script> -->
<!-- <script src="dataTables.rowsGroup.js"></script> -->

<script>
    let firstId = null;
    let no = 0;
    var table = $('#table-master-komponen').DataTable({
        ajax: '{{ route("komponen-penilaian.show")}}',
        serverSide: false,
        processing: true,
        // deferRender: true,
        type: 'GET',
        destroy: true,
        columns: [{
                data: "jenismagang.namajenis",
                visible: false,


            },
            {
                data: "namakomponen"
            },

            {
                data: "scoredby"
            },
            {
                data: "bobot",
                render: function(data) {
                    return data + "%"
                }
            },
            {
                data: "total_bobot",
                render: function(data) {
                    return data + "%"
                }
            },
            {
                data: "status"
            },
            {
                data: "action"
            }
        ],
        rowGroup: {
            dataSrc: "jenismagang.namajenis",
            className: 'text-center text-dark '
            // "startRender": function(row, group) {
            //     return `<span class="text-end" >${group}</span>`;
            // },
        }
    });

    function edit(e) {
        let id = e.attr('data-id');
        let action = `{{ url('master/komponen-penilaian/update/') }}/${id}`;
        var url = `{{ url('master/komponen-penilaian/edit/') }}/${id}`;
        $.ajax({
            type: 'GET',
            url: url,
            success: function(response) {
                $("#modal-title").html("Edit Komponen Nilai");
                $("#modal-button").html("Update Data")
                $('#modal-komponen-nilai form').attr('action', action);
                $('#jenismagang').val(response.id_jenismagang).trigger('change');
                $('#namakomponen').val(response.namakomponen);
                $('#bobot').val(response.bobot);
                $('#scoredby').val(response.scoredby);
                $('#modal-komponen-nilai').modal('show');
            }
        });
    }
    $('.repeater').repeater();

    $("#modal-komponen-nilai").on("hide.bs.modal", function() {

        let repeater = $('.nilai');
        let items = repeater.children();
        items.each((i, item) => {
            if (i > 0) {
                $(item).remove();
            }
        });

        $("#modal-title").html("Tambah Komponen Penilaian");
        $("#modal-button").html("Simpan")
        $('#modal-komponen-nilai form')[0].reset();
        $('#modal-komponen-nilai form #jenismagang').val('').trigger('change');
        $('#modal-komponen-nilai form').attr('action', "{{ url('master/komponen-penilaian/store') }}");
        $('.invalid-feedback').removeClass('d-block');
        $('.form-control').removeClass('is-invalid');

    });
</script>

<script src="../../app-assets/vendor/libs/sweetalert2/sweetalert2.js"></script>
<script src="../../app-assets/js/extended-ui-sweetalert2.js"></script>

@endsection