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
            <h4 class="fw-bold"> Pengajuan Surat Pengantar Magang </h4>
        </div>
    </div>
    <div class="col-xl-12">
        <div class="nav-align-top">
            <ul class="nav nav-pills mb-3 " role="tablist">

                <li class="nav-item">
                    <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                        data-bs-target="#navs-pills-justified-pending" aria-controls="navs-pills-justified-pending"
                        aria-selected="true">
                        <i class="tf-icons ti ti-clock ti-xs me-1"></i> Pending
                    </button>
                </li>
                <li class="nav-item">
                    <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                        data-bs-target="#navs-pills-justified-verified" aria-controls="navs-pills-justified-verified"
                        aria-selected="false">
                        <i class="tf-icons ti ti-user-check ti-xs me-1"></i> Verified
                    </button>
                </li>
                <li class="nav-item">
                    <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                        data-bs-target="#navs-pills-justified-rejected" aria-controls="navs-pills-justified-rejected"
                        aria-selected="false">
                        <i class="tf-icons ti ti-user-x ti-xs me-1"></i> Rejected
                    </button>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade show active" id="navs-pills-justified-pending" role="tabpanel">
                    <div class="card-datatable table-responsive">
                        <table class="table" id="table-approve1">
                            <thead>
                                <tr>
                                    <th>NOMOR</th>
                                    <th style="min-width: 100px;">DATA MAHASISWA</th>
                                    <th>PROGRAM STUDI</th>
                                    <th style="min-width: 120px;">POSISI MAGANG</th>
                                    <th style="min-width: 120px;">TANGGAL MAGANG</th>
                                    <th>NAMA PERUSAHAAN</th>
                                    <th>JABATAN YANG DITUJU</th>
                                    <th>KONTAK PERUSAHAAN</th>
                                    <th>ALAMAT PERUSAHAAN</th>
                                    <th style="min-width: 100px;">AKSI</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>

                <div class="tab-pane fade" id="navs-pills-justified-verified" role="tabpanel">
                    <div class="card-datatable table-responsive">
                        <table class="table" id="table-approve2">
                            <thead>
                                <tr>
                                    <th>NOMOR</th>
                                    <th style="min-width: 100px;">DATA MAHASISWA</th>
                                    <th>PROGRAM STUDI</th>
                                    <th style="min-width: 120px;">POSISI MAGANG</th>
                                    <th style="min-width: 120px;">TANGGAL MAGANG</th>
                                    <th>NAMA PERUSAHAAN</th>
                                    <th>JABATAN YANG DITUJU</th>
                                    <th>KONTAK PERUSAHAAN</th>
                                    <th>ALAMAT PERUSAHAAN</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                <div class="tab-pane fade" id="navs-pills-justified-rejected" role="tabpanel">
                    <p>
                    <div class="card-datatable table-responsive">
                        <table class="table" id="table-approve3">
                            <thead>
                                <tr>
                                    <th>NOMOR</th>
                                    <th style="min-width: 100px;">DATA MAHASISWA</th>
                                    <th>PROGRAM STUDI</th>
                                    <th style="min-width: 120px;">POSISI MAGANG</th>
                                    <th style="min-width: 120px;">TANGGAL MAGANG</th>
                                    <th>NAMA PERUSAHAAN</th>
                                    <th>JABATAN YANG DITUJU</th>
                                    <th>KONTAK PERUSAHAAN</th>
                                    <th>ALAMAT PERUSAHAAN</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @include('mandiri.approve_mandiri.modal')
    </div>
@endsection

@section('page_script')
    <script src="../../app-assets/vendor/libs/jquery-repeater/jquery-repeater.js"></script>
    <script src="../../app-assets/js/forms-extras.js"></script>
    <script src="../../app-assets/vendor/libs/sweetalert2/sweetalert2.js"></script>
    <script src="../../app-assets/js/extended-ui-sweetalert2.js"></script>
    <script>
        var table = $('#table-approve1').DataTable({
            ajax: "{{ url('mandiri/approve-mandiri/show/0') }}",
            serverSide: false,
            processing: true,
            deferRender: true,
            type: 'GET',
            destroy: true,
            columns: [{
                    data: 'DT_RowIndex'
                },
                {
                    data: null,
                    name: 'combined_column',
                    render: function(data, type, row) {
                        return data.mahasiswa.namamhs + '<br>' + data.mahasiswa.nim;
                    }
                },
                {
                    data: null,
                    name: 'combined_column1',
                    render: function(data, type, row) {
                        return data.mahasiswa.prodi.namaprodi;
                    }
                },
                {
                    data: 'posisi_magang',
                    name: 'posisi_magang'
                },
                {
                    data: null,
                    name: 'tanggal_magang',
                    render: function(data, type, row) { 
                        var startDate = new Date(data.startdate);
                        var endDate = new Date(data.enddate);
                        var formattedStartDate = startDate.toISOString().split('T')[0];
                        var formattedEndDate = endDate.toISOString().split('T')[0];
                        return '<strong>Tanggal Mulai:</strong>' + '<br>' + formattedStartDate + '<br>' +
                            '<strong>Tanggal Akhir:</strong>' + '<br>' + formattedEndDate;
                    }
                },
                {
                    data: 'nama_industri',
                    name: 'nama_industri'
                },
                {
                    data: 'jabatan',
                    name: 'jabatan'
                },
                {
                    data: null,
                    name: 'kontak_perusahaan',
                    render: function(data, type, row) {
                        return data.email + '<br>' + data.nohp;
                    }
                },
                {
                    data: 'alamat_industri',
                    name: 'alamat_industri'
                },
                {
                    data: 'aksi',
                    name: 'aksi'
                }

            ]
        });
    </script>

    <script>
        var table = $('#table-approve2').DataTable({
            ajax: "{{ url('mandiri/approve-mandiri/show/1') }}",
            serverSide: false,
            processing: true,
            deferRender: true,
            type: 'GET',
            destroy: true,
            columns: [{
                    data: 'DT_RowIndex'
                },
                {
                    data: null,
                    name: 'combined_column',
                    render: function(data, type, row) {
                        return data.mahasiswa.namamhs + '<br>' + data.mahasiswa.nim;
                    }
                },
                {
                    data: null,
                    name: 'combined_column1',
                    render: function(data, type, row) {
                        return data.mahasiswa.prodi.namaprodi;
                    }
                },
                {
                    data: 'posisi_magang',
                    name: 'posisi_magang'
                },
                {
                    data: null,
                    name: 'tanggal_magang',
                    render: function(data, type, row) { 
                        var startDate = new Date(data.startdate);
                        var endDate = new Date(data.enddate);
                        var formattedStartDate = startDate.toISOString().split('T')[0];
                        var formattedEndDate = endDate.toISOString().split('T')[0];
                        return '<strong>Tanggal Mulai:</strong>' + '<br>' + formattedStartDate + '<br>' +
                            '<strong>Tanggal Akhir:</strong>' + '<br>' + formattedEndDate;
                    }
                },
                {
                    data: 'nama_industri',
                    name: 'nama_industri'
                },
                {
                    data: 'jabatan',
                    name: 'jabatan'
                },
                {
                    data: null,
                    name: 'kontak_perusahaan',
                    render: function(data, type, row) {
                        return data.email + '<br>' + data.nohp;
                    }
                },
                {
                    data: 'alamat_industri',
                    name: 'alamat_industri'
                }
            ]
        });
    </script>

    <script>
        var table = $('#table-approve3').DataTable({
            ajax: "{{ url('mandiri/approve-mandiri/show/2') }}",
            serverSide: false,
            processing: true,
            deferRender: true,
            type: 'GET',
            destroy: true,
            columns: [{
                    data: 'DT_RowIndex'
                },
                {
                    data: null,
                    name: 'combined_column',
                    render: function(data, type, row) {
                        return data.mahasiswa.namamhs + '<br>' + data.mahasiswa.nim;
                    }
                },
                {
                    data: null,
                    name: 'combined_column1',
                    render: function(data, type, row) {
                        return data.mahasiswa.prodi.namaprodi;
                    }
                },
                {
                    data: 'posisi_magang',
                    name: 'posisi_magang'
                },
                {
                    data: null,
                    name: 'tanggal_magang',
                    render: function(data, type, row) { 
                        var startDate = new Date(data.startdate);
                        var endDate = new Date(data.enddate);
                        var formattedStartDate = startDate.toISOString().split('T')[0];
                        var formattedEndDate = endDate.toISOString().split('T')[0];
                        return '<strong>Tanggal Mulai:</strong>' + '<br>' + formattedStartDate + '<br>' +
                            '<strong>Tanggal Akhir:</strong>' + '<br>' + formattedEndDate;
                    }
                },
                {
                    data: 'nama_industri',
                    name: 'nama_industri'
                },
                {
                    data: 'jabatan',
                    name: 'jabatan'
                },
                {
                    data: null,
                    name: 'kontak_perusahaan',
                    render: function(data, type, row) {
                        return data.email + '<br>' + data.nohp;
                    }
                },
                {
                    data: 'alamat_industri',
                    name: 'alamat_industri'
                }
            ]
        });



        function approved(e) {

            $('#modalapprove').modal('show');
            var approveUrl = '{{ url("mandiri/approve-mandiri/approved") }}/' + e.attr('data-id');
            $('#modalapprove form').attr('action', approveUrl);

            $('#approve-confirm-button').on('click', function() {

                $.ajax({
                    url: approveUrl,
                    type: "POST",
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    success: function(response) {
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
            var rejectedUrl = '{{ url("mandiri/approve-mandiri/rejected") }}/' + e.attr('data-id');

            $('#rejected-confirm-button').on('click', function() {
                var alasan = $('#alasan').val();

                $.ajax({
                    url: rejectedUrl,
                    type: "POST",
                    data: {
                        alasan: alasan,
                        _token: '{{ csrf_token() }}'
                    },
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        if (!response.error) {
                            alert('berhasil');
                        } else {
                            alert('tidak berhasil');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });

                $('#modalreject').modal('hide');
            });
        }
    </script>
@endsection
