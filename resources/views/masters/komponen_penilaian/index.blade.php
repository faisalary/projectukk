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

        <div class="nav-align-top">
            <div class="row">
                <div class="col-6">
                    <ul class="nav nav-pills mb-3 " role="tablist">
                        <li class="nav-item" style="font-size: small;">
                            <button type="button" class="nav-link active" target="1" role="tab"
                                data-bs-toggle="tab" data-bs-target="#navs-pills-justified-akademik"
                                aria-controls="navs-pills-justified-akademik" aria-selected="false"
                                style="padding: 8px 9px;"> Pembimbing Akademik
                            </button>
                        </li>
                        <li class="nav-item" style="font-size: small;">
                            <button type="button" class="nav-link" target="0" role="tab" data-bs-toggle="tab"
                                data-bs-target="#navs-pills-justified-lapangan"
                                aria-controls="navs-pills-justified-lapangan" aria-selected="false"
                                style="padding: 8px 9px;"> Pembimbing Lapangan
                            </button>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="tab-content p-0">
            <div class="tab-pane fade show active" id="navs-pills-justified-akademik" role="tabpanel">
                <div class="card">
                    <div class="card-datatable table-responsive">
                        <table class="table table-bordered" id="table-akademik">
                            <thead>
                                <tr>
                                    <th>NOMOR</th>
                                    <th>JENIS MAGANG</th>
                                    <th>BOBOT</th>
                                    <th>ASPEK PENILAIAN</th>
                                    <th>DESKRIPSI ASPEK PENILAIAN</th>
                                    <th>NILAI MAX</th>
                                    <th>STATUS</th>
                                    <th>AKSI</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade show" id="navs-pills-justified-lapangan" role="tabpanel">
                <div class="card">
                    <div class="card-datatable table-responsive">
                        <table class="table table-bordered" id="table-lapangan">
                            <thead>
                                <tr>
                                    <th>NOMOR</th>
                                    <th>JENIS MAGANG</th>
                                    <th>BOBOT</th>
                                    <th>ASPEK PENILAIAN</th>
                                    <th>DESKRIPSI ASPEK PENILAIAN</th>
                                    <th>NILAI MAX</th>
                                    <th>STATUS</th>
                                    <th>AKSI</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    @include('masters.komponen_penilaian.modal')
@endsection

@section('page_script')
    <script
        src="https://cdn.jsdelivr.net/gh/ashl1/datatables-rowsgroup@fbd569b8768155c7a9a62568e66a64115887d7d0/dataTables.rowsGroup.js">
    </script>

    <script>
        var table = $('#table-akademik').DataTable({
            ajax: "{{ url('master/komponen-penilaian/show/1') }}",
            serverSide: false,
            processing: true,
            deferRender: true,
            type: 'GET',
            destroy: true,
            columns: [{
                    data: "DT_RowIndex"
                },
                {
                    data: 'jenismagang.namajenis',
                    name: 'namajenis'
                },
                {
                    data: 'bobot',
                    name: 'bobot'
                },
                {
                    data: 'aspek_penilaian',
                    name: 'aspek_penilaian'
                },
                {
                    data: 'deskripsi_penilaian',
                    name: 'deskripsi_penilaian'
                },
                {
                    data: 'nilai_max',
                    name: 'nilai_max'
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

        var table = $('#table-lapangan').DataTable({
            ajax: "{{ url('master/komponen-penilaian/show/2') }}",
            serverSide: false,
            processing: true,
            deferRender: true,
            type: 'GET',
            destroy: true,
            columns: [{
                    data: "DT_RowIndex"
                },
                {
                    data: 'jenismagang.namajenis',
                    name: 'namajenis'
                },
                {
                    data: 'bobot',
                    name: 'bobot'
                },
                {
                    data: 'aspek_penilaian',
                    name: 'aspek_penilaian'
                },
                {
                    data: 'deskripsi_penilaian',
                    name: 'deskripsi_penilaian'
                },
                {
                    data: 'nilai_max',
                    name: 'nilai_max'
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
            console.log(id);
            let action = `{{ url('master/komponen-penilaian/update/') }}/${id}`;
            var url = `{{ url('master/komponen-penilaian/edit/') }}/${id}`;
            $.ajax({
                type: 'GET',
                url: url,
                success: function(response) {
                    console.log(response);
                    $("#modal-title").html("Edit Komponen Nilai");
                    $("#modal-button").html("Update Data")
                    $('#modal-komponen-nilai form').attr('action', action);
                    $('#id_jenismagang').val(response.id_jenismagang).trigger('change');
                    $('#bobot').val(response.bobot);
                    $('#aspek_penilaian').val(response.aspek_penilaian);
                    $('#deskripsi_penilaian').val(response.deskripsi_penilaian);
                    $('#scored_by').val(response.scored_by).trigger('change');
                    $('#nilai_max').val(response.nilai_max);


                    $('#modal-komponen-nilai').modal('show');
                }
            });
        }

        $("#modal-komponen-nilai").on("hide.bs.modal", function() {

            $("#modal-title").html("Tambah Komponen Nilai");
            $("#modal-button").html("Save Data");
            $('#modal-komponen-nilai form')[0].reset();
            $('#modal-komponen-nilai form #kategori').val('').trigger('change');
            $('#modal-komponen-nilai form #status').val('').trigger('change');
            $('#modal-komponen-nilai form').attr('action', "{{ url('master/komponen-penilaian/store') }}");
            $('.invalid-feedback').removeClass('d-block');
        });
    </script>

    <script src="../../app-assets/vendor/libs/sweetalert2/sweetalert2.js"></script>
    <script src="../../app-assets/js/extended-ui-sweetalert2.js"></script>
    <script src="../../app-assets/js/forms-extras.js"></script>
    <script src="../../app-assets/vendor/libs/jquery-repeater/jquery-repeater.js"></script>
@endsection
