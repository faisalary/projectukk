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
    <div class="col-md-10 col-12">
        <h4 class="fw-bold"><span class="text-muted fw-light">Master Data /</span> Prodi</h4>
    </div>
    <div class="col-md-2 col-12 text-end">
        <button class="btn btn-success waves-effect waves-light" data-bs-toggle="offcanvas" data-bs-target="#modalSlide"> <i class="tf-icons ti ti-filter"></i></button>
    </div>
    <div class="col-md-12 d-flex justify-content-between mt-2">
        <p class="text-secondary">Filter Berdasarkan : <i class='tf-icons ti ti-alert-circle text-primary pb-1' data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Universitas : -, Fakultas : -, Prodi : -" id="tooltip-filter"></i></p>
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalTambahProdi">Tambah Prodi</button>
    </div>
</div>
<div class="row mt-2">
    <div class="col-12">
        <div class="card">
            <div class="card-datatable table-responsive">
                <table class="table" id="table-master-prodi">
                    <thead>
                        <tr>
                            <th>NOMOR</th>
                            <th>UNIVERSITAS</th>
                            <th>NAMA FAKULTAS</th>
                            <th>NAMA PRODI</th>
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

@include('masters.prodi.modal')
@endsection

@section('page_script')
<script src="../../app-assets/vendor/libs/jquery-repeater/jquery-repeater.js"></script>
<script src="../../app-assets/js/forms-extras.js"></script>
<script>

    

    $("#modalTambahProdi").on("hide.bs.modal", function() {

        $("#modal-title").html("Tambah Prodi");
        $("#modal-button").html("Save Data");
        $('#modalTambahProdi form #pilihuniversitas_add').val('').trigger('change');
        $('#modalTambahProdi form #pilihfakultas_add').val('').trigger('change');
        $('#modalTambahProdi form #namaprodi').val('').trigger('change');
    });

    function edit(e){
            let id = e.attr('data-id');

            let action = `{{ url('master/prodi/update/') }}/${id}`;
            var url = `{{ url('master/prodi/edit/') }}/${id}`;
            $.ajax({
                 type: 'GET',
                 url: url,
                 success: function (response) {
                    $("#modal-title").html("Edit Prodi");
                    $("#modal-button").html("Update Data");
                    $('#modalTambahProdi form').attr('action',action);
                    $('#pilihuniversitas_add').val(response.id_univ).trigger("change");
                    $('#pilihfakultas_add').val(response.id_fakultas).trigger("change");
                    $('#namaprodi').val(response.namaprodi).trigger("change");

                    $('#modalTambahProdi').modal('show');

                }
            });
        }

        $('#pilihuniversitas_add').on('change',function(){
            id_univ = $("#pilihuniversitas_add option:selected").val();
            
            $.ajax({
                url: "{{ url('/master/prodi/list-fakultas') }}"+'/'+id_univ,
                method: "GET",
                dataType: "json",
                success: function(response){
                    if ($('#pilihfakultas_add').data('select2')) {
                        $("#pilihfakultas_add form").val(""); 
                        $("#pilihfakultas_add").trigger("change");
                        $('#pilihfakultas_add').empty().trigger("change");
                    }
                    $("#pilihfakultas_add").select2({
                        data: response.data,
                        dropdownParent: $('#modalTambahProdi'),
                    });
                }

            })
        });

        $('#univ').on('change',function(){
            id_univ = $("#univ option:selected").val();
            
            $.ajax({
                url: "{{ url('/master/prodi/list-fakultas') }}"+'/'+id_univ,
                method: "GET",
                dataType: "json",
                success: function(response){
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

        $('#fakultas').on('change',function(){
            id_fakultas = $("#fakultas option:selected").val();
            
            $.ajax({
                url: "{{ url('/master/prodi/list-prodi') }}"+'/'+id_fakultas,
                method: "GET",
                dataType: "json",
                success: function(response){
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

        $( document ).ready(function() {
            table_master_prodi();
        });

        $(document).on('submit','#filter',function(e){
            const offcanvasFilter = $('#modalSlide');
            e.preventDefault();
            table_master_prodi();
            $('#tooltip-filter').attr('data-bs-original-title', 'Universitas: ' + $('#univ :selected').text() + ', Fakultas: ' + $('#fakultas :selected').text() + ', Prodi: ' + $('#prodi :selected').text());
            offcanvasFilter.offcanvas('hide');
        });

        $('.data-reset').on('click',function () {
            $('#univ').val(null).trigger('change');
            $('#fakultas').val(null).trigger('change');
            $('#prodi').val(null).trigger('change');
        });

        function table_master_prodi() {
            var table = $('#table-master-prodi').DataTable({
                ajax: {
                    url:"{{ url('master/prodi/show') }}",
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
                        data: "univ.namauniv"
                    },
                    {
                        data: "fakultas.namafakultas"
                    },
                    {
                        data: "namaprodi"
                    },
                    {
                        data: "status"
                    },
                    {
                        data: "action"
                    }
                ]
            });
        }

</script>

<script src="../../app-assets/vendor/libs/sweetalert2/sweetalert2.js"></script>
<script src="../../app-assets/js/extended-ui-sweetalert2.js"></script>
@endsection