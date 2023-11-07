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
                                <th>NOMOR</th>
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
    <script>         
        var table = $('#table-master-komponen').DataTable({
            ajax: '{{ route('komponen_penilaian.show') }}',
            serverSide: false,
            processing: true,
            deferRender: true,
            type: 'GET',
            destroy: true,
            columns: [{
                    data: "DT_RowIndex"
                },
                {
                    data: "jenismagang.namajenis"
                },
                {
                    data: "namakomponen"
                },
               
                {
                    data: "scoredby"
                },
                {
                    data: "bobot"
                },
                {
                    data: "total_bobot"
                },
                {
                    data: "status"
                },
                {
                    data: "action"
                }
            ]
        });

        function deactive(e) {
            Swal.fire({
                title: 'Apakah anda yakin ingin menonaktifkan data?',
                text: ' Data yang dipilih akan dihapus!',
                iconHtml: '<img src="{{ url('/app-assets/img/alert.png') }}">',
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yakin",
                cancelButtonText: "Batal",
                closeOnConfirm: false,
                closeOnCancel: false,
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger',
                    iconHtml: 'no-border'
                },
                buttonsStyling: false
            });
        }

        function alert(e) {
            Swal.fire({
                title: 'Bobot nilai melebihi 100%',
                text: ' Pastikan anda memasukkan bobot yang sesuai',
                iconHtml: '<img src="{{ url('/app-assets/img/alert.png') }}">',
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Oke",
                closeOnConfirm: false,
                customClass: {
                    confirmButton: 'btn btn-success',
                    iconHtml: 'no-border'
                },
                buttonsStyling: false
            });
        }

        function alertt(e) {
            Swal.fire({
                title: 'Bobot kurang dari 100%',
                text: ' Pastikan anda memasukkan bobot yang sesuai',
                iconHtml: '<img src="{{ url('/app-assets/img/alert.png') }}">',
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Oke",
                closeOnConfirm: false,
                customClass: {
                    confirmButton: 'btn btn-success',
                    iconHtml: 'no-border'
                },
                buttonsStyling: false
            });
        }

        function active(e) {
            Swal.fire({
                title: 'Apakah anda yakin ingin mengaktifkan data?',
                text: ' Data yang dipilih akan diaktifkan!',
                iconHtml: '<img src="{{ url('/app-assets/img/alert.png') }}">',
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yakin",
                cancelButtonText: "Batal",
                closeOnConfirm: false,
                closeOnCancel: false,
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger',
                    iconHtml: 'no-border'
                },
                buttonsStyling: false
            });
        }
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
                    $('#jenismagang').val(response.id_jenismagang);
                    $('#namakomponen').val(response.namakomponen);
                    $('#bobot').val(response.bobot);
                    $('#scoredby').val(response.scoredby);
                    $('#modal-komponen-nilai').modal('show');
                }
            });
        }
        var i = 0;
        $('#add').click(function(){
            if (i < 5) {
                ++i;
                $('#komponen-input-nilai').append(
                `<div class="row">
                    <div class="col-md-4 col-12">
                        <label class="form-label" for="form-repeater-1-1">Nama Komponen</label>
                        <input name="namakomponen" type="text" id="namakomponen" class="form-control"
                            placeholder="Nama Komponen">
                    </div>
                    <div class="col-md-4 col-15" style="margin-right: -1rem; margin-left: -1rem;">
                        <label class="form-label" for="form-repeater-1-2">Bobot Penilaian</label>
                        <input name="bobot" type="text" id="bobot" class="form-control"
                            placeholder="Bobot Penilaian">
                    </div>
                    <div class="col-md-3 col-12">
                        <label class="form-label" for="form-repeater-1-2">Dinilai Oleh</label>
                        <input name="scoredby" type="text" id="scoredby" class="form-control"
                            placeholder="Dinilai Oleh">
                    </div>
                    <div class="col-md-1 col-12 d-flex align-items-center mb-3" id="remove-row"
                        style="margin-right: -1rem; margin-left: -1rem; margin-top: 1.3rem;">
                        <button class="btn waves-effect remove-table-row" >
                            <i class="tf-icons ti ti-trash text-danger trash-icon"></i>
                        </button>
                    </div>
                    </div>`
                );
            }
        });
        $(document).on('click', '.remove-table-row', function(){
            $(this).closest('.row').remove();
        } );
        
    </script>
    
    <script src="../../app-assets/vendor/libs/sweetalert2/sweetalert2.js"></script>
    <script src="../../app-assets/js/extended-ui-sweetalert2.js"></script>

@endsection
