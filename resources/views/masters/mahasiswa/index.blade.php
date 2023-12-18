@extends('partials_admin.template')

@section('meta_header')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('page_style')
    <link rel="stylesheet" href="../../app-assets/vendor/libs/sweetalert2/sweetalert2.css" />
    <link rel="stylesheet" href="{{ url('../../app-assets/css/yearpicker.css') }}" />
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


        .dropdown-item.active,
        .dropdown-item:active {
            color: #FFF;
            background-color: #4EA971 !important
        }
    </style>


@section('main')
    <div class="row">
        <div class="col-md-10 col-12">
            <h4 class="fw-bold"><span class="text-muted fw-light">Master Data /</span> Mahasiswa</h4>
        </div>
        <div class="col-md-2 col-12 text-end">
            <button class="btn btn-success waves-effect waves-light" data-bs-toggle="offcanvas"
                data-bs-target="#modalSlide"> <i class="tf-icons ti ti-filter"></i></button>
        </div>
        <div class="col-md-12 d-flex justify-content-between mt-2">
            <p class="text-secondary">Filter Berdasarkan : <i class='tf-icons ti ti-alert-circle text-primary pb-1'
                    data-bs-toggle="tooltip" data-bs-placement="right"
                    data-bs-original-title="Universitas : -, Fakultas : -, Prodi : -" id="tooltip-filter"></i></p>
            <div class="btn-group">
                <button type="button" class="btn btn-success dropdown-toggle waves-effect waves-light"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    Tambah Mahasiswa
                </button>
                <ul class="dropdown-menu" style="">
                    <li><a class="dropdown-item btn text-success ti ti-upload d-block pe-15" data-bs-toggle="modal"
                            data-bs-target="#modal-import">Import</a></li>
                    <li><a class="dropdown-item btn text-success" data-bs-toggle="modal"
                            data-bs-target="#modal-mahasiswa">Tambah Mahasiswa</a></li>
            </div>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-12">
            <div class="card">
                <div class="card-datatable table-responsive">
                    <table class="table" id="table-master-mahasiswa">
                        <thead>
                            <tr>
                                <th>NOMOR</th>
                                <th style="min-width:150px;">UNIVERSITAS</th>
                                <th>NIM</th>
                                <th>ANGKATAN</th>
                                <th>NAMA MAHASISWA</th>
                                <th>NOMOR TELEPON</th>
                                <th>EMAIL</th>
                                <th>ALAMAT</th>
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

@include('masters.mahasiswa.modal')

@endsection

@section('page_script')
<script>
    $("#modal-mahasiswa").on("hide.bs.modal", function() {

        $("#modal-title").html("Tambah Prodi");
        $("#modal-button").html("Save Data");
        $('#modal-mahasiswa form #pilihuniversitas_add').val('').trigger('change');
        $('#modal-mahasiswa form #pilihfakultas_add').val('').trigger('change');
        $('#modal-mahasiswa form #pilihprodi_add').val('').trigger('change');
    });

    $("#modal-import").on("hide.bs.modal", function() {

         $("#buttonImport").html("Save Data");
    });

    function edit(e) {
        let id = e.attr('data-id');

        let action = `{{ url('master/mahasiswa/update/') }}/${id}`;
        var url = `{{ url('master/mahasiswa/edit/') }}/${id}`;
        $.ajax({
            type: 'GET',
            url: url,
            success: function(response) {
                $("#modal-title").html("Edit Mahasiswa");
                $("#modal-button").html("Update Data")
                $('#modal-mahasiswa form').attr('action', action);
                $('#nim').val(response.nim);
                $('#pilihuniversitas_add').val(response.id_univ).change();
                $('#pilihfakultas_add').val(response.id_fakultas).change();
                $('#angkatan').val(response.angkatan);
                $('#pilihprodi_add').val(response.id_prodi).change();
                $('#namamhs').val(response.namamhs);
                $('#nohpmhs').val(response.nohpmhs);
                $('#emailmhs').val(response.emailmhs);
                $('#alamatmhs').val(response.alamatmhs);

                $('#modal-mahasiswa').modal('show');
            }
        });
    }

    $('#pilihuniversitas_add').on('change', function() {
        id_univ = $("#pilihuniversitas_add option:selected").val();

        $.ajax({
            url: "{{ url('/master/mahasiswa/list-fakultas') }}" + '/' + id_univ,
            method: "GET",
            dataType: "json",
            success: function(response) {
                if ($('#pilihfakultas_add').data('select2')) {
                    $("#pilihfakultas_add form").val("");
                    $("#pilihfakultas_add").trigger("change");
                    $('#pilihfakultas_add').empty().trigger("change");
                }
                $("#pilihfakultas_add").select2({
                    data: response.data,
                    dropdownParent: $('#modal-mahasiswa'),
                });
            }

        })
    });
    $('#pilihfakultas_add').on('change', function() {
        id_univ = $("#pilihfakultas_add option:selected").val();

        $.ajax({
            url: "{{ url('/master/mahasiswa/list-prodi') }}" + '/' + id_univ,
            method: "GET",
            dataType: "json",
            success: function(response) {
                if ($('#pilihprodi_add').data('select2')) {
                    $("#pilihprodi_add form").val("");
                    $("#pilihprodi_add").trigger("change");
                    $('#pilihprodi_add').empty().trigger("change");
                }
                $("#pilihprodi_add").select2({
                    data: response.data,
                    dropdownParent: $('#modal-mahasiswa'),
                });
            }

        })
    });


    $('#univ').on('change', function() {
        id_univ = $("#univ option:selected").val();

        $.ajax({
            url: "{{ url('/master/mahasiswa/list-fakultas') }}" + '/' + id_univ,
            method: "GET",
            dataType: "json",
            success: function(response) {
                if ($('#fakultas').data('select2')) {
                    $("#fakultas form").val("");
                    $("#fakultas").trigger("change");
                    $('#fakultas').empty().trigger("change");
                }
                $("#fakultas").select2({
                    data: response.data,
                    dropdownParent: $('#modalSlide'),
                });
            }

        })
    });

    $('#fakultas').on('change', function() {
        id_fakultas = $("#fakultas option:selected").val();

        $.ajax({
            url: "{{ url('/master/mahasiswa/list-prodi') }}" + '/' + id_fakultas,
            method: "GET",
            dataType: "json",
            success: function(response) {
                if ($('#prodi').data('select2')) {
                    $("#prodi form").val("");
                    $("#prodi").trigger("change");
                    $('#prodi').empty().trigger("change");
                }
                $("#prodi").select2({
                    data: response.data,
                    dropdownParent: $('#modalSlide'),
                });
            }

        })
    });

    $(document).ready(function() {
        table_master_mahasiswa();
    });

    $(document).on('submit', '#filter', function(e) {
        const offcanvasFilter = $('#modalSlide');
        e.preventDefault();
        table_master_mahasiswa();
        $('#tooltip-filter').attr('data-bs-original-title', 'Universitas: ' + $('#univ :selected').text() +
            ', Fakultas: ' + $('#fakultas :selected').text() + ', Prodi: ' + $('#prodi :selected').text());
        offcanvasFilter.offcanvas('hide');
    });

    $('.data-reset').on('click', function() {
        $('#univ').val(null).trigger('change');
        $('#fakultas').val(null).trigger('change');
        $('#prodi').val(null).trigger('change');
    });

    function table_master_mahasiswa() {
        var table = $('#table-master-mahasiswa').DataTable({
            ajax: {
                url: "{{ url('master/mahasiswa/show') }}",
                type: 'POST',
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                data: function(d) {
                    var frm_data = $('#filter').serializeArray();
                    $.each(frm_data, function(key, val) {
                        d[val.name] = val.value;
                    });
                }
            },
            serverSide: false,
            processing: true,
            // deferRender: true,
            destroy: true,
            columns: [{
                    data: "DT_RowIndex"
                },
                {
                    data: null,
                    name: 'combined_column',
                    render: function(data, type, row) {
                        return data.univ.namauniv + '<br>' + data.fakultas.namafakultas + '<br>' + data
                            .prodi.namaprodi;
                    }
                },
                {
                    data: "nim",
                    name: "nim"
                },
                {
                    data: "angkatan",
                    name: "angkatan"
                },
                {
                    data: "namamhs",
                    name: "namamhs"
                },
                {
                    data: "nohpmhs",
                    name: "nohpmhs"
                },
                {
                    data: "emailmhs",
                    name: "emailmhs"
                },
                {
                    data: "alamatmhs",
                    name: "alamatmhs"
                },
                {
                    data: "status",
                    name: "status"
                },
                {
                    data: "action",
                    name: "action"
                }
            ]
        });
    }

    $(document).ready(function() {
        $(".yearpicker").yearpicker({
            startYear: new Date().getFullYear() - 10,
            endYear: new Date().getFullYear() + 10,
        });
    });
</script>

<script src="{{ url('app-assets/vendor/libs/sweetalert2/sweetalert2.js') }}"></script>
<script src="{{ url('app-assets/js/extended-ui-sweetalert2.js') }}"></script>
<script src="{{ url('app-assets/js/yearpicker.js') }}"></script>
@endsection
