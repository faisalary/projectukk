@extends('partials.vertical_menu')

@section('page_style')
<style>
    .tooltip-inner {
        width: 450px !important;
        max-width: 450px !important;
    }
</style>
@endsection

@section('content')
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
                <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-justified-tertunda" aria-controls="navs-pills-justified-tertunda" aria-selected="true">
                    <i class="tf-icons ti ti-clock ti-xs me-1"></i> Tertunda
                </button>
            </li>
            <li class="nav-item">
                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-justified-disetujui" aria-controls="navs-pills-justified-disetujui" aria-selected="false">
                    <i class="tf-icons ti ti-clipboard-check ti-xs me-1"></i> Disetujui
                </button>
            </li>
            <li class="nav-item">
                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-justified-ditolak" aria-controls="navs-pills-justified-ditolak" aria-selected="false">
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
            @foreach (['tertunda', 'disetujui', 'ditolak'] as $key => $item)
            <div class="tab-pane fade {{ $key == 0 ? 'active show' : '' }}" id="navs-pills-justified-{{ $item }}" role="tabpanel">
                <div class="card-datatable table-responsive">
                    <table class="table" id="{{ $item }}">
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
            @endforeach
        </div>
    </div>
    @include('mandiri.approve_mandiri.modal')
</div>

<!-- filter -->

@endsection

@section('page_script')
<script>
    $('.table').each(function () {
        $(this).DataTable({
            ajax: "{{ route('pengajuan_magang.show') }}?status=" + $(this).attr('id'),
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