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
        <button class="btn btn-success waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#modalPopUp"> <i class="tf-icons ti ti-filter"></i></button>
    </div>
    
    <div class="col-md-12 col-12 mb-2 text-end">
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

    var table = $('#table-master-prodi').DataTable({
        ajax:'{{ route('prodi.show') }}',
        serverSide: false,
        processing: true,
        deferRender: true,
        type: 'GET',
        destory: true,
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

    $("#modalTambahProdi").on("hide.bs.modal", function() {

        $("#modal-title").html("Tambah Prodi");
        // $("#modal-button").html("Save Data")
        // $('#modal-mahasiswa form')[0].reset();
        // $('#modal-mahasiswa form').attr('action', "{{ url('master/mahasiswa/store') }}");
        // $('.invalid-feedback').removeClass('d-block');
        // $('.form-control').removeClass('is-invalid');
    });

    function edit(e){
            let id = e.attr('data-id');

            let action = `{{ url('master/master-prodi/update/') }}/${id}`;
            var url = `{{ url('master/master-prodi/edit/') }}/${id}`;
            $.ajax({
                 type: 'GET',
                 url: url,
                 success: function (response) {
                    $("#modal-title").html("Edit Prodi");
                    $("#modal-button").html("Update Data");
                    $('#modalTambahProdi form').attr('action',action);
                    $('#pilihuniversitas_add').val(response.id_univ).trigger("change");
                    $('#pilihfakultas_add').val(response.id_fakultas).trigger("change");;
                    $('#namaprodi').val(response.namaprodi);

                    $('#modalTambahProdi').modal('show');

                }
            });
        }

        $("#modal-prodi").on("hide.bs.modal",function() {
           $("#modal-title").html("Edit Prodi");
           $("#modal-button") .html("Save Data");
           $('#modalTambahProdi form')[0].reset();
           $('#modalTambahProdi form').attr('action',"{{ url('master/master-prodi/store') }}");
           $('.invalid-feedback').removeCLass('d-block');
           $('.form-control').removeClass('is-invalid');
        });

        $('#pilihuniversitas_add').on('change',function(){
            id_univ = $("#pilihuniversitas_add option:selected").val();
            
            $.ajax({
                url: "{{ url('/master/master-prodi/list-fakultas') }}"+'/'+id_univ,
                method: "GET",
                dataType: "json",
                success: function(response){
                    if ($('#pilihfakultas_add').data('select2')) {
                        $("#pilihfakultas_add").val("");
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

//     function status(e) {
//     var status = e.attr('data-status');
//     var text = "";
//     if (status == 0) {
//         text = "Active";
//     } else {
//         text = "Inactive";
//     }
//     Swal.fire({

//         title: 'Are you sure?',
//         text: "The selected data will be " + text,
//         icon: 'warning',
//         confirmButtonColor: '#3085d6',
//         cancelButtonColor: '#d33',
//         confirmButtonText: 'Yes, ' + text + '!',
//         showConfirmButton: true
//     }).then(function(result) {

//         if (result.value) {
//             var id = e.attr('data-id');
//             let data = {
//                 'id': id,
//                 '_token': `{{csrf_token()}}`
//             }
//             jQuery.ajax({
//                 method: "POST",
//                 data: data,
//                 url: `{{url("master-prodi/status")}}/${id}`,
//                 success: function(data) {

//                     if (data.error) {

//                         Swal.fire({
//                             type: "error",
//                             title: 'Oops...',
//                             text: data.message,
//                             confirmButtonClass: 'btn btn-success',
//                         })

//                     } else {

//                         setTimeout(function() {
//                             $('#table-master-prodi').DataTable().ajax
//                                 .reload();

//                         }, 1000);

//                         Swal.fire({
//                             icon: "success",
//                             title: 'Succeed!',
//                             text: data.message,
//                             showConfirmButton: false,
//                             timer: 2000,
//                         })

//                     }
//                 }
//             });

//         }
//     });
// }

    // function deactive(e) {
    //     Swal.fire({
    //         title: 'Apakah anda yakin ingin menghapus data?',
    //         text: ' Data yang dipilih akan dihapus!',
    //         iconHtml: '<img src="{{ url("/app-assets/img/alert.png")}}">',
    //         showCancelButton: true,
    //         confirmButtonColor: "#DD6B55",
    //         confirmButtonText: "Hapus",
    //         cancelButtonText: "Batal",
    //         closeOnConfirm: false,
    //         closeOnCancel: false,
    //         customClass: {
    //             confirmButton: 'btn btn-success',
    //             cancelButton: 'btn btn-danger',
    //             iconHtml: 'no-border'
    //         },
            // buttonsStyling: false


        // }).then(function(result){
        //     if(result.value){
        //         var id = e.attr('data-id');
                
        //         let data ={
        //             'id':id,
        //         }

        //         jQuery.ajax({
        //             method:"GET",
        //             data:data,
        //             url:`{{ url('/master-prodi/${id}/delete') }}`,
        //         });

        //         window.location.reload(true);
        //     }
    //      });
    // }

</script>

<script src="../../app-assets/vendor/libs/sweetalert2/sweetalert2.js"></script>
<script src="../../app-assets/js/extended-ui-sweetalert2.js"></script>
@endsection