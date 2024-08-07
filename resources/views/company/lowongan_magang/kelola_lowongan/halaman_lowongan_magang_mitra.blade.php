@extends('partials.vertical_menu')

@section('page_style')
<style>
    .select2-selection__clear{
        display:none;
    }
</style>
@endsection

@section('content')
    <div class="row">
        <div class="col-12 d-flex justify-content-between">
            <h4 class="fw-bold">Kelola Lowongan-Tahun Ajaran 21/10/2023 - 10/11/2023</h4>
            <div class="d-flex justify-content-end align-items-center">
                <div class="position-relative" style="width: 13rem;">
                    <select class="select2 form-select" data-placeholder="Pilih Tahun Ajaran">
                        <option value="1">2023/2024 Genap</option>
                        <option value="2">2023/2024 Ganjil</option>
                        <option value="3">2022/2023 Genap</option>
                        <option value="4">2022/2023 Ganjil</option>
                        <option value="5">2021/2022 Genap</option>
                        <option value="6">2021/2022 Ganjil</option>
                    </select>
                </div>
                <button class="btn btn-icon btn-primary ms-2" data-bs-toggle="offcanvas" data-bs-target="#modalSlide">
                    <i class="tf-icons ti ti-filter"></i>
                </button>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="nav-align-top">
            <ul class="nav nav-pills mb-3 " role="tablist">
                <li class="nav-item" style="font-size: small;">
                    <button type="button" class="nav-link active" target="1" role="tab"
                        data-bs-toggle="tab" data-bs-target="#navs-pills-justified-total"
                        aria-controls="navs-pills-justified-total" aria-selected="true" style="padding: 8px 9px;">
                        <i class="tf-icons ti ti-briefcase ti-xs me-1"></i> Total Lowongan
                    </button>
                </li>
                <li class="nav-item" style="font-size: small;">
                    <button type="button" class="nav-link" target="2" role="tab" data-bs-toggle="tab"
                        data-bs-target="#navs-pills-justified-tertunda" aria-controls="navs-pills-justified-tertunda"
                        aria-selected="false" style="padding: 8px 9px;">
                        <i class="tf-icons ti ti-clock ti-xs me-1"></i> Menunggu Persetujuan
                        </button>
                </li>
                <li class="nav-item" style="font-size: small;">
                    <button type="button" class="nav-link" target="3" role="tab" data-bs-toggle="tab"
                        data-bs-target="#navs-pills-justified-diterima" aria-controls="navs-pills-justified-diterima"
                        aria-selected="false" style="padding: 8px 9px;">
                        <i class="tf-icons ti ti-clipboard-check ti-xs me-1"></i> Lowongan Diterima
                        </button>
                </li>
                <li class="nav-item" style="font-size: small;">
                    <button type="button" class="nav-link" target="4" role="tab" data-bs-toggle="tab"
                        data-bs-target="#navs-pills-justified-ditolak" aria-controls="navs-pills-justified-ditolak"
                        aria-selected="false" style="padding: 8px 9px;">
                        <i class="tf-icons ti ti-clipboard-x ti-xs me-1"></i> Lowongan Ditolak
                        </button>
                </li>
            </ul>
        </div>
    </div>

    <div class="d-flex justify-content-between">
        <div class="col my-auto">
            <div class="text-secondary">
                Filter Berdasarkan : 
                <i class='tf-icons ti ti-alert-circle text-primary pb-1' data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Durasi Magang : -, Posisi Lowongan Magang : -, Status Lowongan Magang : -" id="tooltip-filter"></i>
            </div>
        </div>
        <div class="col text-end">
            <a href="{{ route('kelola_lowongan.create') }}" class="btn btn-primary">Tambah Lowongan Magang</a>
        </div>
    </div>

    <div class="tab-content p-0">
        @foreach (['total', 'tertunda', 'diterima', 'ditolak'] as $key => $item)
        <div class="tab-pane fade show {{ $key == 0 ? 'active' : '' }}" id="navs-pills-justified-{{ $item }}" role="tabpanel">
            <div class="card mt-4">
                <div class="row m-2 mt-3">
                    <div class="col-auto">
                        <div class="card shadow-none border border-secondary">
                            <div class="card-body p-2">
                                @switch($item)
                                    @case('total')
                                        <div class="d-flex justify-content-center align-items-center">
                                            <span class="badge p-2 bg-label-success me-2">
                                                <i class="ti ti-briefcase" style="font-size: 12pt;"></i>
                                            </span>
                                            <span class="mb-0 me-2">Total Lowongan:</span>
                                            <h5 class="mb-0 me-2 text-primary">50</h5>
                                            <span class="mb-0 me-2">Lowongan </span>
                                        </div>
                                        @break
                                    @case('tertunda')
                                        <div class="d-flex justify-content-center align-items-center">
                                            <span class="badge p-2 bg-label-success me-2">
                                                <i class="ti ti-briefcase" style="font-size: 12pt;"></i>
                                            </span>
                                            <span class="mb-0 me-2">Total Tertunda:</span>
                                            <h5 class="mb-0 me-2 text-primary">50</h5>
                                            <span class="mb-0 me-2">Tertunda </span>
                                        </div>
                                        @break
                                    @case('diterima')
                                        <div class="d-flex justify-content-center align-items-center">
                                            <span class="badge p-2 bg-label-success me-2">
                                                <i class="ti ti-briefcase" style="font-size: 12pt;"></i>
                                            </span>
                                            <span class="mb-0 me-2">Total Diterima:</span>
                                            <h5 class="mb-0 me-2 text-primary">50</h5>
                                            <span class="mb-0 me-2">Diterima </span>
                                        </div>
                                        @break
                                    @case('ditolak')
                                        <div class="d-flex justify-content-center align-items-center">
                                            <span class="badge p-2 bg-label-success me-2">
                                                <i class="ti ti-briefcase" style="font-size: 12pt;"></i>
                                            </span>
                                            <span class="mb-0 me-2">Total Ditolak:</span>
                                            <h5 class="mb-0 me-2 text-primary">50</h5>
                                            <span class="mb-0 me-2">Ditolak </span>
                                        </div>
                                        @break
                                    @default
                                        
                                @endswitch
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-datatable table-responsive">
                    <table class="table" id="{{ $item }}" style="width: 100%;">
                        <thead>
                            <tr>
                                <th style="max-width:70px;">NOMOR</th>
                                <th style="min-width:100px;">POSISI</th>
                                <th style="min-width:100px;">TANGGAL</th>
                                <th style="min-width:100px;">DURASI MAGANG</th>
                                <th style="text-align:center;min-width:50px;">STATUS</th>
                                <th style="text-align:center;min-width:100px;">AKSI</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    
@include('company/lowongan_magang/components/modal_kelola_lowongan')
@endsection
@section('page_script')
    <script>
        $(document).ready(function () {
            loadData();
        });

        function loadData() {
            let statusTableId = ['total', 'tertunda', 'diterima', 'ditolak'];
            statusTableId.forEach(function(idElement) {

                $('#' + idElement).DataTable({
                    ajax: "{{ route('kelola_lowongan.show') }}?type=" + idElement,
                    processing: true,
                    destroy: true,
                    columns: [{
                            data: "DT_RowIndex"
                        },
                        {
                            data: "intern_position",
                            name: "intern_position"
                        },
                        {
                            data: "tanggal",
                            name: "tanggal"
                        },
                        {
                            data: "durasimagang",
                            name: "durasimagang"
                        },
                        
                        {
                            data: "status",
                            name: "status"
                        },
                        {
                            data: "action",
                            name: "action"
                        }
                    ],
                });

            });
        }

        function afterUpdateStatus(response) {
            $('.table').each(function () {
                $(this).DataTable().ajax.reload();
            });
        }

        $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
            $($.fn.dataTable.tables(true)).DataTable().columns.adjust().responsive.recalc();
        });

        $(document).on('submit', '#filter', function(e) {
            const offcanvasFilter = $('#modalSlide');
            e.preventDefault();
            $('#tooltip-filter').attr('data-bs-original-title', 'durasimagang: ' + $('#durasimagang :selected')
                .text() + ', posisilowongan: ' + $('#posisi :selected').text() + ', statuslowongan: ' + $(
                    '#status :selected').text());
            offcanvasFilter.offcanvas('hide');
            // $('#status').DataTable().ajax.reload();
        });

        $('.data-reset').on('click', function() {
            $('#durasimagang').val(null).trigger('change');
            $('#posisi').val(null).trigger('change');
            $('#status').val(null).trigger('change');
        });
    </script>
@endsection
