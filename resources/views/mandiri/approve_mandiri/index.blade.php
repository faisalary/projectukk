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
                    <i class="tf-icons ti ti-clock ti-xs me-1"></i> Belum Approval
                </button>
            </li>
            <li class="nav-item">
                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-justified-done" aria-controls="navs-pills-justified-disetujui" aria-selected="false">
                    <i class="tf-icons ti ti-list-check ti-xs me-1"></i> Sudah Approval
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
            @foreach (['tertunda', 'done'] as $key => $item)
            <div class="tab-pane fade {{ $key == 0 ? 'active show' : '' }}" id="navs-pills-justified-{{ $item }}" role="tabpanel">
                <div class="card-datatable table-responsive">
                    <table class="table" id="{{ $item }}">
                        <thead>
                            <tr>
                                <th>NOMOR</th>
                                <th>DATA MAHASISWA</th>
                                <th>PROGRAM STUDI</th>
                                <th>JENIS MAGANG</th>
                                <th>PERUSAHAAN + POSISI</th>
                                <th>TANGGAL MAGANG</th>
                                <th>KONTAK PERUSAHAAN</th>
                                <th>ALAMAT PERUSAHAAN</th>
                                <th>DOKUMEN PENGAJUAN</th>
                                <th class="text-center">STATUS</th>
                                @if ($item == 'tertunda')
                                <th class="text-center">AKSI</th>
                                @endif
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
    $('button[data-bs-toggle="tab"]').on('shown.bs.tab', function(e) {
        $($.fn.dataTable.tables(true)).DataTable().columns.adjust().responsive.recalc();
    });    

    $('.table').each(function () {
        let column = [
            { data: 'DT_RowIndex' },
            { data: 'namamhs' },
            { data: 'namaprodi' },
            { data: 'namajenis' },
            { data: 'intern_position' },
            { data: 'tgl_magang' },
            { data: 'contact_perusahaan' },
            { data: 'alamatindustri' },
            { data: 'dokumen_spm' },
            { data: 'current_step' }
        ];

        if ($(this).attr('id') == 'tertunda') {
            column.push({ data: 'action' });
        }

        $(this).DataTable({
            ajax: "{{ route('pengajuan_magang.show') }}?status=" + $(this).attr('id'),
            serverSide: false,
            processing: true,
            deferRender: true,
            type: 'GET',
            destroy: true,
            scrollX: true,
            columns: column
        });
    });

    function approved(e) {
        $('#modalpersetujuanspm').modal('show');
        let url = `{{ route('pengajuan_magang.approved', ['id' => ':id']) }}`.replace(':id', e.attr('data-id'));
        $('#modalpersetujuanspm form').attr('action', url);
    }

    function afterApprove(response) {
        let modal = $('#modalpersetujuanspm');
        modal.find('form').attr('action', '');
        modal.modal('hide');

        $('.table').each(function () {
            $(this).DataTable().ajax.reload();
        });
    }

    function rejected(e) {
        $('#modalreject').modal('show');
        let url = `{{ route('pengajuan_magang.rejected', ['id' => ':id']) }}`.replace(':id', e.attr('data-id'));
        $('#modalreject form').attr('action', url);
    }

    function afterReject(response) {
        let modal = $('#modalreject');
        modal.find('form').attr('action', '');
        modal.modal('hide');

        $('.table').each(function () {
            $(this).DataTable().ajax.reload();
        });
    }
</script>
@endsection