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
        <h4 class="fw-bold"><span class="text-muted fw-light">Master Data /</span> Pegawai Industri</h4>
    </div>
    <div class="col-md-6 col-12 text-end">
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalTambahPegawai">Tambah Pegawai Industri</button>
    </div>
</div>
<div class="row mt-2">
    <div class="col-12">
        <div class="card">
            <div class="card-datatable table-responsive">
                <table class="table" id="table-master-pegawai">
                    <thead>
                        <tr>
                            <th>NOMOR</th>
                            <th>NAMA PEGAWAI</th>
                            <th>kONTAK</th>
                            <th>JABATAN</th>
                            <th>UNIT</th>
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
@include('masters.pegawai_industri.modal')
@endsection

@section('page_script')
<script>
    var table = $('#table-master-pegawai').DataTable({
            ajax: "{{ route('pegawaiindustri.show') }}",
            serverSide: false,
            processing: true,
            deferRender: true,
            type: 'GET',
            destroy: true,
            columns: [{
                    data: 'DT_RowIndex'
                },
                {
                    data: 'pegawai_industri',
                    name: 'pegawai_industri'
                },
                {
                    data: 'kontak',
                    name: 'kontak'
                },
                {
                    data: 'jabatan',
                    name: 'jabatan'
                },
                {
                    data: 'unit',
                    name: 'unit'
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

    function status(e) {
            var status = e.attr('data-status');
            var text = "";
            if (status == 0) {
                text = "Active";
            } else {
                text = "Inactive";
            }
            Swal.fire({

                title: 'Are you sure?',
                text: "The selected data will be " + text,
                icon: 'warning',
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, ' + text + '!',
                showConfirmButton: true
                }).then(function(result) {

                    if (result.value) {
                        var id = e.attr('data-id');
                        let data = {
                            'id': id,

                        }
                        jQuery.ajax({
                            method: "DELETE",
                            data: data,
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                    'content')
                            },
                            url: `{{ url('master/pegawai-industri/status') }}/${id}`,
                            success: function(data) {

                                if (data.error) {

                                    Swal.fire({
                                        type: "error",
                                        title: 'Oops...',
                                        text: data.message,
                                        confirmButtonClass: 'btn btn-success',
                                    })

                                } else {

                                    setTimeout(function() {
                                        $('#table-master-pegawai').DataTable().ajax
                                            .reload();

                                    }, 1000);

                                    Swal.fire({
                                        icon: "success",
                                        title: 'Succeed!',
                                        text: data.message,
                                        showConfirmButton: false,
                                        timer: 2000,
                                    })
                                }
                            }
                        });
                    }
            });
        }

        function edit(e) {
            let id = e.attr('data-id');
            console.log(id);
            let action = `{{ url('master/pegawai-industri/update/') }}/${id}`;
            var url = `{{ url('master/pegawai-industri/edit/') }}/${id}`;
            $.ajax({
                type: 'GET',
                url: url,
                success: function(response) {
                    console.log(response);
                    $(".modal-title").html("Edit Pegawai");
                    $("#modal-button").html("Update Data")
                    $('#modalTambahPegawai form').attr('action', action);
                    $('#namaperusahaan').val(response.id_industri).trigger('change');
                    $('#namapegawai').val(response.namapeg);
                    $('#telp').val(response.nohppeg);
                    $('#email').val(response.emailpeg);
                    $('#jabatan').val(response.jabatan);
                    $('#unit').val(response.unit);

                    $('#modalTambahPegawai').modal('show');
                }
            });
        }

        $("#modalTambahPegawai").on("hide.bs.modal", function() {

            $(".modal-title").html("Tambah Pegawai");
            $("#modal-button").html("Save Data")
            $('#modalTambahPegawai form').trigger('reset');
            $('#modalTambahPegawai form').attr('action', "{{ url('master/pegawai-industri/store') }}");
            $('.invalid-feedback').removeClass('d-block');
            $('.form-control').removeClass('is-invalid');
            });
        </script>

    <script src="{{ url('app-assets/vendor/libs/sweetalert2/sweetalert2.js') }}"></script>
    <script src="{{ url('app-assets/js/extended-ui-sweetalert2.js') }}"></script>
@endsection

