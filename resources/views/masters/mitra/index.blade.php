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
        <h4 class="fw-bold"><span class="text-muted fw-light">Master Data /</span> Mitra</h4>
    </div>
    <div class="col-md-6 col-12 text-end">
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalTambahMitra">Tambah Mitra</button>
    </div>
</div>
<div class="row mt-2">
    <div class="col-12">
        <div class="card">
            <div class="card-datatable table-responsive">
                <table class="table" id="table-master-mitra">
                    <thead>
                        <tr>
                            <th>NOMOR</th>
                            <th>NAMA</th>
                            <th>NO TELEPON</th>
                            <th>ALAMAT</th>
                            <th>KATEGORI STATUS</th>
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
    <div class="modal fade" id="modalTambahMitra" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">

            <div class="modal-content">
            <div class="modal-header text-center d-block">
                <h5 class="modal-title" id="modal-title">Tambah Mitra</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="default-form" method="POST" action="{{ route('mitra.store') }}">
                @csrf
               
            <div class="modal-body">

                <div class="row">
                    <div class="col mb-2 form-input">
                        <label for="mitra" class="form-label">Nama Mitra</label>
                        <input type="text" id="mitra" name="namaindustri" class="form-control"
                            placeholder="Nama Mitra" />
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-2 form-input">
                        <label for="telp" class="form-label">No Telepon</label>
                        <input type="text" id="telp" name="notelepon" class="form-control"
                            placeholder="No Telepon" />
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-2 form-input">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea class="form-control" id="alamat" name="alamatindustri"
                        placeholder="Alamat"></textarea>
                    <div class="invalid-feedback"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-2 form-input">
                        <label for="kmitra" class="form-label">Kategori Mitra</label>
                        <input type="text" id="kategori" name="kategorimitra" class="form-control"
                            placeholder="Kategori Mitra" />
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                {{-- <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">
                    Close
                </button> --}}
                <button type="submit" id="modal-button" class="btn btn-success">Simpan</button>
            </div>
        </form>

        </div>
    </div>
</div>
@endsection

@section('page_script')
    <script>
        var table = $('#table-master-mitra').DataTable({
            ajax: "{{ url('master-mitra/show') }}",
            // "{{ url('master-mitra/show') }}",
            serverSide: false,
            processing: true,
            deferRender: true,
            type: 'GET',
            destroy: true,
            columns: [{
                    data: 'DT_RowIndex'
                },

                {
                    data: 'namaindustri',
                    name: 'namaindustri'
                },
                {
                    data: 'notelpon',
                    name: 'notelpon'
                },
                {
                    data: 'alamatindustri',
                    name: 'alamatindustri'
                },
                {
                    data: 'kategori_industri',
                    name: 'kategori_industri'
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
                            url: `{{ url('master-mitra/destory') }}/${id}`,
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
                                        $('#table-master-mitra').DataTable().ajax
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
            let action = `{{ url('master-mitra/update/') }}/${id}`;
            var url = `{{ url('master-mitra/edit/') }}/${id}`;
            $.ajax({
                type: 'GET',
                url: url,
                success: function(response) {
                    console.log(response);
                    $("#modal-title").html("Edit Mitra");
                    $("#modal-button").html("Update Data")
                    $('#modalTambahMitra form').attr('action', action);
                    $('#mitra').val(response.namaindustri);
                    $('#telp').val(response.notelpon);
                    $('#alamat').val(response.alamatindustri);
                    $('#kategori').val(response.kategori_industri);

                    $('#modalTambahMitra').modal('show');
                }
            });
        }

        $("#modalTambahMitra").on("hide.bs.modal", function() {

            $("#modal-title").html("Tambah Mitra");
            $("#modal-button").html("Save Data")
            $('#modalTambahMita form').trigger('reset');
            $('#modalTambahMitra form').attr('action', "{{ url('master-mitra/store') }}");
            $('.invalid-feedback').removeClass('d-block');
            $('.form-control').removeClass('is-invalid');
            });

        </script>

    <script src="{{ url('app-assets/vendor/libs/sweetalert2/sweetalert2.js') }}"></script>
    <script src="{{ url('app-assets/js/extended-ui-sweetalert2.js') }}"></script>
@endsection

