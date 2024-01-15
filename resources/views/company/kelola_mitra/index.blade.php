@extends('partials_admin.template')

@section('meta_header')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('page_style')
    <link rel="stylesheet" href="../../app-assets/vendor/libs/sweetalert2/sweetalert2.css" />
    <style>

    </style>
@endsection

@section('main')
    <div class="row">
        <div class="col-md-6 col-12">
            <h4 class="fw-bold"><span class="text-muted fw-light">Mitra /</span> Kelola Mitra</h4>
        </div>
        <div class="col-md-6 col-12 text-end">
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalTambahMitra">Tambah Mitra</button>
        </div>
    </div>
    <div class="col-xl-12">
        <div class="nav-align-top">
            <ul class="nav nav-pills mb-3 " role="tablist">
                {{-- <li class="nav-item">
                    <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                        data-bs-target="#navs-pills-justified-users" aria-controls="navs-pills-justified-users"
                        aria-selected="true">
                        <i class="tf-icons ti ti-users ti-xs me-1"></i> Created
                        {{-- <span class="badge rounded-pill badge-center h-px-20 w-px-20 bg-success ms-1">3</span> --}}
                    {{--</button>
                </li> --}}
                <li class="nav-item">
                    <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                        data-bs-target="#navs-pills-justified-pending" aria-controls="navs-pills-justified-pending"
                        aria-selected="true">
                        <i class="tf-icons ti ti-clock ti-xs me-1"></i> Pending
                        {{-- <span class="badge rounded-pill badge-center h-px-20 w-px-20 bg-success ms-1">2</span> --}}
                    </button>
                </li>
                <li class="nav-item">
                    <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                        data-bs-target="#navs-pills-justified-verified" aria-controls="navs-pills-justified-verified"
                        aria-selected="false">
                        <i class="tf-icons ti ti-user-check ti-xs me-1"></i> Verified
                        {{-- <span class="badge rounded-pill badge-center h-px-20 w-px-20 bg-success ms-1">4</span> --}}
                    </button>
                </li>
                <li class="nav-item">
                    <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                        data-bs-target="#navs-pills-justified-rejected" aria-controls="navs-pills-justified-rejected"
                        aria-selected="false">
                        <i class="tf-icons ti ti-user-x ti-xs me-1"></i> Rejected
                        {{-- <span class="badge rounded-pill badge-center h-px-20 w-px-20 bg-success ms-1">1</span> --}}
                    </button>
                </li>
            </ul>
            <div class="tab-content">
                {{-- <div class="tab-pane fade show active" id="navs-pills-justified-users" role="tabpanel">
                    <div class="card-datatable table-responsive">
                        <table class="table" id="table-kelola-mitra1">
                            <thead>
                                <tr>
                                    <th>NOMOR</th>
                                    <th style="min-width: 100px;">NAMA</th>
                                    <th>EMAIL</th>
                                    <th>NOMOR TELEPON</th>
                                    <th>PENANGGUNG JAWAB</th>
                                    {{-- <th>DESKRIPSI PERUSAHAAN</th> --}}
                                    {{--<th>KATEGORI MITRA</th>
                                    <th>STATUS KERJASAMA</th>
                                    <th>AKSI</th>
                                    
                                </tr>
                            </thead>
                        </table>
                    </div>

                </div> --}}
                <div class="tab-pane fade show active" id="navs-pills-justified-pending" role="tabpanel">
                    <div class="card-datatable table-responsive">
                        <table class="table" id="table-kelola-mitra2">
                            <thead>
                                <tr>
                                    <th>NOMOR</th>
                                    <th style="min-width: 100px;">NAMA</th>
                                    <th>EMAIL</th>
                                    <th style="min-width: 120px;">NOMOR TELEPON</th>
                                    <th>PENANGGUNG JAWAB</th>
                                    <th>KATEGORI MITRA</th>
                                    <th>STATUS KERJASAMA</th>
                                    <th style="min-width: 100px;">AKSI</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>

                <div class="tab-pane fade" id="navs-pills-justified-verified" role="tabpanel">
                    <div class="card-datatable table-responsive">
                        <table class="table" id="table-kelola-mitra3">
                            <thead>
                                <tr>
                                    <th>NOMOR</th>
                                    <th style="min-width: 100px;">NAMA</th>
                                    <th>EMAIL</th>
                                    <th style="min-width: 120px;">NOMOR TELEPON</th>
                                    <th>PENANGGUNG JAWAB</th>
                                    <th style="min-width: 100px;">KATEGORI MITRA</th>
                                    <th>STATUS KERJASAMA</th>
                                    <th>ALAMAT</th>
                                    <th>DESKRIPSI PERUSAHAAN</th>
                                    <th>AKSI</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                <div class="tab-pane fade" id="navs-pills-justified-rejected" role="tabpanel">
                    <p>
                    <div class="card-datatable table-responsive">
                        <table class="table" id="table-kelola-mitra4">
                            <thead>
                                <tr>
                                    <th>NOMOR</th>
                                    <th style="min-width: 100px;">NAMA</th>
                                    <th>EMAIL</th>
                                    <th style="min-width: 120px;">NOMOR TELEPON</th>
                                    <th>ALAMAT</th>
                                    <th style="min-width: 100px;">KATEGORI MITRA</th>
                                    <th>STATUS KERJASAMA</th>
                                    <th>DESKRIPSI PERUSAHAAN</th>
                                    <th>STATUS</th>

                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @include('company.kelola_mitra.modal')
    </div>
@endsection

@section('page_script')
    <script src="../../app-assets/vendor/libs/jquery-repeater/jquery-repeater.js"></script>
    <script src="../../app-assets/js/forms-extras.js"></script>
    <script src="../../app-assets/vendor/libs/sweetalert2/sweetalert2.js"></script>
    <script src="../../app-assets/js/extended-ui-sweetalert2.js"></script>
    <script>
        var table = $('#table-kelola-mitra2').DataTable({
            ajax: "{{ url('company/kelola-mitra/show/0') }}",
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
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'notelpon',
                    name: 'notelpon'
                },
                {
                    data: 'penanggung_jawab',
                    name: 'penanggung_jawab'
                },
                {
                    data: 'kategori_industri',
                    name: 'kategori_industri'
                },
                {
                    data: 'statuskerjasama',
                    name: 'statuskerjasama'
                },
                {
                    data: 'aksi',
                    name: 'aksi'
                }

            ]
        });
    </script>

    <script>
        var table = $('#table-kelola-mitra3').DataTable({
            ajax: "{{ url('company/kelola-mitra/show/1') }}",
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
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'notelpon',
                    name: 'notelpon'
                },
                {
                    data: 'penanggung_jawab',
                    name: 'penanggung_jawab'
                },
                {
                    data: 'kategori_industri',
                    name: 'kategori_industri'
                },
                {
                    data: 'statuskerjasama',
                    name: 'statuskerjasama'
                },
                {
                    data: 'alamatindustri',
                    name: 'alamatindustri'
                },
                {
                    data: 'description',
                    name: 'description'
                },
                {
                    data: 'editverivied',
                    name: 'editverivied'
                }
            ]
        });
    </script>

    <script>
        var table = $('#table-kelola-mitra4').DataTable({
            ajax: "{{ url('company/kelola-mitra/show/2') }}",
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
                    data: 'email',
                    name: 'email'
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
                    data: 'statuskerjasama',
                    name: 'statuskerjasama'
                },
                {
                    data: 'description',
                    name: 'description'
                },
                // {
                //     data: 'status',
                //     name: 'status'
                // }
                {
                    data: 'editrejected',
                    name: 'editrejected'
                }   
            ]
        });

        function edit(e) {
            let id = e.attr('data-id');
            let action = `{{ url('company/kelola-mitra/update/') }}/${id}`;
            var url = `{{ url('company/kelola-mitra/edit/') }}/${id}`;
            $.ajax({
                type: 'GET',
                url: url,
                success: function(response) {
                    $("#modal-title").html("Edit Mitra");
                    $("#simpanButton").html("Update Data");
                    $('#modalTambahMitra form').attr('action', action);
                    $('#nama').val(response.namaindustri);
                    $('#email').val(response.email);
                    $('#kategori').val(response.kategori_industri).trigger('change');
                    $('#statuskerjasama').val(response.statuskerjasama).trigger('change');
                    $('#modalTambahMitra').modal('show');
                }
            });
        }

        $("#modalTambahMitra").on("hide.bs.modal", function() {

            $("#modal-title").html("Tambah Mitra");
            $("#simpanButton").html("Save Data")
            $('#modalTambahMitra form')[0].reset();
            $('#modalTambahMitra form #kategori').val('').trigger('change');
            $('#modalTambahMitra form #statuskerjasama').val('').trigger('change');
            $('#modalTambahMitra form').attr('action', "{{ route('kelola_mitra.store') }}");
            $('.invalid-feedback').removeClass('d-block');
            $('.form-control').removeClass('is-invalid');
        });

        function approved(e) {
            
            $('#modalapprove').modal('show');
            var approveUrl = '{{url("company/kelola-mitra/approved")}}/' + e.attr('data-id');

            $('#approve-confirm-button').on('click', function () {

                $.ajax({
                    url: approveUrl,
                    type: "POST",
                    headers: {
                        "X-CSRF-TOKEN" : "{{csrf_token()}}"
                    },
                    success: function (response) {
                        if (!response.error) {
                            alert('berhasil');
                        } else {
                            alert('tidak berhasil');
                        }
                    }
                });

                $('#modalapprove').modal('hide');
            });
        }
        function rejected(e) {
            $('#modalreject').modal('show');
            var rejectedUrl = '{{ url("company/kelola-mitra/rejected") }}/' + e.attr('data-id');

            $('#rejected-confirm-button').on('click', function () {
                var alasan = $('#alasan').val();

                $.ajax({
                    url: rejectedUrl,
                    type: "POST",
                    data: { alasan: alasan, _token: '{{ csrf_token() }}' },
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    success: function (response) {
                        if (!response.error) {
                            alert('berhasil');
                        } else {
                            alert('tidak berhasil');
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });

                $('#modalreject').modal('hide');
            });
        }
    </script>
@endsection
