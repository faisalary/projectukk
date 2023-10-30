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
                                <th>Universitas</th>
                                <th>NIP</th>
                                <th>KODE DOSEN</th>
                                <th>NAMA PRODI</th>
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

                {
                    data: 'univ.namauniv',
                    name: 'namauniv'
                },
                {
                    data: 'nip',
                    name: 'nip'
                },
                {
                    data: 'id_dosen',
                    name: 'id_dosen'
                },
                {
                    data: 'prodi.namaprodi',
                    name: 'namaprodi'
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

        // function status(e) {
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
        //             }
        //             jQuery.ajax({
        //                 method: "POST",
        //                 data: data,
        //                 headers: {
        //                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
        //                         'content')
        //                 },
        //                 url: `{{ url('master/dosen/status') }}/${id}`,
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
        //                             $('#table-master-dosen').DataTable().ajax
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
                    $('#namauniv').val(response.namauniv);
                    $('#kodedosen').val(response.kodedosen);
                    $('#namaprodi').val(response.namaprodi);
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
        $('#id_univ_add').on('change', function() {
                id_univx = $("#id_univ_add option:selected").val();

                $.ajax({
                    url: "{{ url('/master/mahasiswa/list-fakultas') }}" + '/' + id_univx,
                    method: "GET",
                    dataType: "json",
                    success: function(response) {
                        
                        if ($('#id_fakultas_add').data('select2')) {
                            $("#id_fakultas_add").val("");
                            $("#id_fakultas_add").trigger("change");
                            $('#id_fakultas_add').empty().trigger("change");
                        }
                        $("#id_fakultas_add").select2({
                            data: response.data,
                            dropdownParent: $('#modal-dosen'),
                        });
                    }
                })
            });
    </script>

    <script src="{{ url('app-assets/vendor/libs/sweetalert2/sweetalert2.js') }}"></script>
    <script src="{{ url('app-assets/js/extended-ui-sweetalert2.js') }}"></script>
@endsection
