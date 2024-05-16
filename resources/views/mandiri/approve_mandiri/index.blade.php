@extends('partials_admin.template')

@section('meta_header')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('page_style')
<link rel="stylesheet" href="../../app-assets/vendor/libs/sweetalert2/sweetalert2.css" />
<style>
    .tooltip-inner {
        width: 450px !important;
        max-width: 450px !important;
    }
</style>
@endsection

@section('main')
<div class="row">
    <div class="d-flex align-items-center justify-content-between mb-3">
        <div>
            <h4 class="fw-bold text-sm">Pengajuan Magang Tahun Ajaran 2023/2024</h4>
        </div>
        <div class="d-none d-sm-flex">
            <select class="select2 form-select" data-placeholder="Filter Status">
                <option value="0" selected>2023/2024 Ganjil</option>
                <option value="1">2023/2024 Genap</option>
                <option value="2">2024/2025 Ganjil</option>
                <option value="3">2024/2025 Genap</option>
            </select>
        </div>
    </div>
</div>
<div class="col-xl-12">
    <div class="nav-align-top">
        <ul class="nav nav-pills mb-3" role="tablist">
            <li class="nav-item">
                <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-justified-pending" aria-controls="navs-pills-justified-pending" aria-selected="true">
                    <i class="tf-icons ti ti-clock ti-xs me-1"></i> Tertunda
                </button>
            </li>
            <li class="nav-item">
                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-justified-verified" aria-controls="navs-pills-justified-verified" aria-selected="false">
                    <i class="tf-icons ti ti-clipboard-check ti-xs me-1"></i> Disetujui
                </button>
            </li>
            <li class="nav-item">
                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-justified-rejected" aria-controls="navs-pills-justified-rejected" aria-selected="false">
                    <i class="tf-icons ti ti-clipboard-x ti-xs me-1"></i> Ditolak
                </button>
            </li>
        </ul>
        <div class="row mb-3">
            <div class="d-flex align-items-center justify-content-between">
                <div class="text-secondary">Filter Berdasarkan : <i class='tf-icons ti ti-alert-circle text-primary pb-1' data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Program Studi: D3 Sistem Informasi, Jenis Magang: MSIB" id="tooltip-filter"></i></div>
                <button class="btn btn-success waves-effect waves-light" data-bs-toggle="offcanvas" data-bs-target="#modalSlide"><i class="tf-icons ti ti-filter"></i>
                </button>
            </div>
        </div>
        <div class="tab-content p-0">
            <div class="tab-pane fade show active" id="navs-pills-justified-pending" role="tabpanel">
                <div class="card-datatable table-responsive">
                    <table class="table" id="table-approve1">
                        <thead>
                            <tr>
                                <th>NOMOR</th>
                                <th style="min-width: 140px;">DATA MAHASISWA</th>
                                <th style="min-width: 140px;">PROGRAM STUDI</th>
                                <th style="min-width: 140px;">JENIS MAGANG</th>
                                <th style="min-width: 170px;">PERUSAHAAN + POSISI</th>
                                <th>TANGGAL MAGANG</th>
                                <th style="min-width: 120px;">JABATAN YANG DITUJU</th>
                                <th>KONTAK PERUSAHAAN</th>
                                <th>ALAMAT PERUSAHAAN</th>
                                <th>DOKUMEN PENGAJUAN</th>
                                <th>AKSI</th>
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
                                <th style="min-width: 140px;">DATA MAHASISWA</th>
                                <th style="min-width: 140px;">PROGRAM STUDI</th>
                                <th style="min-width: 140px;">JENIS MAGANG</th>
                                <th style="min-width: 170px;">PERUSAHAAN + POSISI</th>
                                <th>TANGGAL MAGANG</th>
                                <th style="min-width: 120px;">JABATAN YANG DITUJU</th>
                                <th>KONTAK PERUSAHAAN</th>
                                <th>ALAMAT PERUSAHAAN</th>
                                <th>DOKUMEN PENGAJUAN</th>
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
                                <th style="min-width: 140px;">DATA MAHASISWA</th>
                                <th style="min-width: 140px;">PROGRAM STUDI</th>
                                <th style="min-width: 140px;">JENIS MAGANG</th>
                                <th style="min-width: 170px;">PERUSAHAAN + POSISI</th>
                                <th>TANGGAL MAGANG</th>
                                <th style="min-width: 120px;">JABATAN YANG DITUJU</th>
                                <th>KONTAK PERUSAHAAN</th>
                                <th>ALAMAT PERUSAHAAN</th>
                                <th>DOKUMEN PENGAJUAN</th>
                                <th>ALASAN PENOLAKAN</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @include('mandiri.approve_mandiri.modal')
</div>

<!-- filter -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="modalSlide" aria-labelledby="offcanvasAddUserLabel">
    <div class="offcanvas-header">
        <h5 id="offcanvasAddUserLabel" class="offcanvas-title">Filter Berdasarkan</h5>
    </div>
    <div class="offcanvas-body mx-0 flex-grow-0 pt-0 h-100">
        <form class="add-new-user pt-0" id="filter">
            <div class="col-12 mb-2">
                <div class="row">
                    <div class="mb-2">
                        <label for="prodi" class="form-label">Program Studi</label>
                        <select class="form-select select2" id="prodi" name="prodi" data-placeholder="Pilih Program Studi">
                            <option value="">Pilih Program Studi</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="mb-2">
                        <label for="prodi" class="form-label">Jenis Magang</label>
                        <select class="form-select select2" id="jenis" name="prodi" data-placeholder="Pilih Jenis Magang">
                            <option value="">Pilih Jenis Magang</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="mt-3 text-end">
                <button type="reset" class="btn btn-label-danger data-reset">Reset</button>
                <button type="submit" class="btn btn-success">Terapkan</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Penolakan -->
<!-- <div class="modal fade" id="modalpenolakan" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pt-0 pb-0">
            <h4 class="text-center">Alasan Penolakan Pengajuan Magang</h4>
                <div class="row">
                    <div class="col mb-3">
                        <label for="nameWithTitle" class="form-label">Alasan Penolakan Pengajuan</label>
                        <textarea type="text" class="form-control" placeholder="Masukkan alasan penolakan"></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                    Batal
                </button>
                <button type="button" class="btn btn-success">Kirim</button>
            </div>
        </div>
    </div>
</div> -->

<!-- Modal Persetujuan SPM -->
<!-- <div class="modal fade" id="modalpersetujuanspm" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pt-0 pb-0">
                <h4 class="text-center">Persetujuan pengajuan SPM dan Pengiriman SPM</h4>
                <div class="row">
                    <div class="col mb-3">
                        <label class="form-label" for="berkas">Unggah Surat Pengantar Magang</label>
                        <input class="form-control" type="file" id="formFile">
                        <p style="font-size: smaller; padding-top:10px;">Allowed PDF, JPG, PNG, JPEG. Max size of 1 Mb</p>
                    </div>
                    <p class="mb-0" style="font-size: smaller;">Note: Ketika mengirim SPM, secara otomatis pengajuan SPM akan disetujui dan berpindah ke tab disetujui!</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                    Batal
                </button>
                <button type="button" class="btn btn-success">Kirim</button>
            </div>
        </div>
    </div>
</div> -->

<!-- Modal Persetujuan Pengajuan Magang -->
<!-- <div class="modal fade" id="modalpersetujuanmagang" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pt-0 pb-0">
                <h4 class="text-center">Persetujuan Pengajuan Magang</h4>
                <p class="text-center mb-3" style="font-size: small;">Dokumen yang diupload wajib bertanda tangan pihak terkait</p>
                <div class="row">
                    <div class="col">
                        <label class="form-label" for="berkas">Unggah Surat Pertanggungjawaban Mutlak </label>
                        <input class="form-control" type="file" id="formFile">
                        <p style="font-size: smaller; padding-top:10px;">Allowed PDF, JPG, PNG, JPEG. Max size of 1 Mb</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label class="form-label" for="berkas">Unggah Surat Rekomendasi </label>
                        <input class="form-control" type="file" id="formFile">
                        <p style="font-size: smaller; padding-top:10px;">Allowed PDF, JPG, PNG, JPEG. Max size of 1 Mb</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                        Batal
                    </button>
                    <button type="button" class="btn btn-success">Kirim</button>
                </div>
            </div>
        </div>
    </div>
</div> -->


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
            scrollX: true,
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
                    data: null
                },
                {
                    data: null
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
                    data: null
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
            scrollX: true,
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
                    data: null
                },
                {
                    data: null
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
                    data: null
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
            scrollX: true,
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
                    data: null
                },
                {
                    data: null
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
                    data: null
                },
                {
                    data: null
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