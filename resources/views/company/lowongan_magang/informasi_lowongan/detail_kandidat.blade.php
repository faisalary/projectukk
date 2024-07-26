@extends('partials.vertical_menu')

@section('page_style')
<style>
    .tooltip-inner {
        min-width: 100%;
        max-width: 100%;
    }

    .position-relative {
        padding-right: 15px;
        padding-left: 15px;
    }

    h6,
    .h6 {
        font-size: 0.9375rem;
        margin-bottom: 0px;
    }

    #more {
        display: none;
    }
</style>
@endsection

@section('content')
<div class="d-flex justify-content-between">
    <h4 class="fw-bold"><span class="text-muted fw-light">Informasi Lowongan / </span>{{ $lowongan->intern_position }}</h4>
    <div class="d-flex justify-content-end">
        <select class="select2 form-select" data-placeholder="Pilih Tahun Ajaran">
            <option value="1">2023/2024 Genap</option>
            <option value="2">2023/2024 Ganjil</option>
            <option value="3">2022/2023 Genap</option>
            <option value="4">2022/2023 Ganjil</option>
            <option value="5">2021/2022 Genap</option>
            <option value="6">2021/2022 Ganjil</option>
        </select>
        <button class="btn btn-success waves-effect waves-light" data-bs-toggle="offcanvas" data-bs-target="#modalSlide"><i class="tf-icons ti ti-filter"></i></button>
    </div>
</div>

<div class="col-xl-12">
    <div class="nav-align-top">
        <ul class="nav nav-pills mb-3 " role="tablist">
            @foreach ($tab as $key => $item)
            <li class="nav-item" style="font-size: small;">
                <button type="button" class="{{ $loop->first ? 'active' : '' }} nav-link" target="2" role="tab" data-bs-toggle="tab" data-bs-target="#{{ $key }}" aria-controls="{{ $key }}" aria-selected="false" style="padding: 8px 9px;">
                    <i class="tf-icons {{ $item['icon'] }} ti-xs me-1"></i>
                    {{ $item['label'] }}
                    <span class="badge rounded-pill bg-label-primary badge-center h-px-20 w-px-20 ms-1" id="total_{{ $item['table'] }}">
                        0
                    </span>
                </button>
            </li>
            @endforeach
        </ul>
    </div>

    <div class="row cnt">
        <div class="col-8 text-secondary mb-3">Filter Berdasarkan : <i class='tf-icons ti ti-alert-circle text-primary pb-1' data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Program Studi : D3 Rekayasa Perangkat Lunak Aplikasi, Fakultas : Ilmu Terapan, Universitas : Tel-U Jakarta, Status :  Diterima" id="tooltip-filter"></i></div>
        <div id="div2" class="col-1 targetDiv" style="display: none;">
            <div class="col-md-4 col-12 mb-3 d-flex align-items-center justify-content-between">
                <select class="select2 form-select" data-placeholder="Ubah Status Kandidat">
                </select>
                <button class="btn btn-success waves-effect waves-light" data-bs-toggle="offcanvas" data-bs-target="#modalSlide" style="min-width: 142px;"><i class="tf-icons ti ti-checks">
                        Terapkan</i>
                </button>
            </div>
        </div>
    </div>

    <div class="tab-content p-0">
        @foreach ($tab as $key => $item)
        <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="{{ $key }}" role="tabpanel">
            <div class="card">
                <div class="d-flex align-items-center justify-content-between p-3">
                    <div class="card shadow-none border border-secondary">
                        <div class="card-body p-2">
                            <div class="d-flex justify-content-center align-items-center">
                                <span class="badge p-2 bg-label-success me-2">
                                    <i class="ti ti-briefcase" style="font-size: 12pt;"></i>
                                </span>
                                <span class="mb-0 me-2">Total Pelamar:</span>
                                <h5 class="mb-0 me-2 text-primary" id="total-{{ $item['table'] }}">0</h5>
                                <span class="mb-0 me-2">Lowongan </span>
                            </div>
                        </div>
                    </div>
                    <div>
                        <span class="fw-semibold">Batas Konfirmasi Penerimaan&nbsp;:&nbsp;<span class="text-primary">20 Juli 2023</span></span>
                    </div>
                </div>
                <div class="card-datatable table-responsive">
                    <table class="table" id="{{ $item['table'] }}" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NAMA</th>
                                <th>NO TELEPON </th>
                                <th>EMAIL</th>
                                <th class="text-center">Tanggal Daftar</th>
                                <th>PROGRAM STUDI</th>
                                <th>FAKULTAS</th>
                                <th>UNIVERSITAS</th>
                                <th class="text-center">STATUS</th>
                                <th class="text-center">AKSI</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    @include('company/lowongan_magang/components/modal_detail_pelamar')

</div>
@endsection

@section('page_script')
<script>
    $('.table').each(function () {
        $(this).DataTable({
            ajax: {
                url: "{{ $urlGetData }}",
                type: 'GET',
                data: {type: $(this).attr('id')}
            },
            scrollX: true,
            serverSide: false,
            processing: true,
            deferRender: true,
            destroy: true,
            drawCallback: function( settings, json ) {
                let total = this.api().data().count();
                $('#total_' + $(this).attr('id')).text(total);
                $('#total-' + $(this).attr('id')).text(total);
            },
            columns: [
                { data: "DT_RowIndex" },
                { data: "namamhs" },
                { data: "nohpmhs" },
                { data: "emailmhs" },
                { data: "tanggaldaftar" },
                { data: "namaprodi" },
                { data: "namafakultas" },
                { data: "namauniv" },
                { data: "current_step" },
                { data: "action" },
            ]
        });
    });

    $('button[data-bs-toggle="tab"]').on('shown.bs.tab', function(e) {
        $($.fn.dataTable.tables(true)).DataTable().columns.adjust().responsive.recalc();
    });

    function detailInfo(e) {
        let offcanvas = $('#detail_pelamar_offcanvas');
        offcanvas.offcanvas('show');
        btnBlock(offcanvas);

        $.ajax({
            url: "{{ $urlDetailPelamar }}?data_id=" + e.attr('data-id'),
            type: "GET",
            success: function (response) {
                btnBlock(offcanvas, false);
                response = response.data;
                $('#container_detail_pelamar').html(response.view);
                $('#change_status').attr('data-id', response.id_pendaftar);
                $('#change_status').attr('data-default', response.current_step);
                $('#change_status').val(response.current_step).change();
            }
        });
    }

    $('#detail_pelamar_offcanvas').on('hidden.bs.offcanvas', function () {
        $('#container_detail_pelamar').html(null);
        $('#change_status').removeAttr('data-id');
    });

    function changeStatus(e) {
        if (e.val() == e.attr('data-default') || e.val() == null) return;

        if (e.val() == "{{ $last_seleksi }}" || e.val() == "rejected") {
            let modal = $('#modal-upload-file');
            let form = modal.find('form');
    
            if (e.val() == "{{ $last_seleksi }}") modal.find('.modal-title').text('Berkas Penerimaan');
            else if (e.val() == "rejected") modal.find('.modal-title').text('Berkas Penolakan');

            form.attr('action', "{{ route('informasi_lowongan.update_status', ['id' => ':id']) }}".replace(':id', e.attr('data-id')));
            form.prepend('<input type="hidden" name="status" value="' + e.val() + '">');
            modal.modal('show');
        } else {
            $.ajax({
                url: "{{ route('informasi_lowongan.update_status', ['id' => ':id']) }}".replace(':id', e.attr('data-id')),
                type: "POST",
                data: {_token: "{{ csrf_token() }}", status: e.val()},
                success: function (response) {
                    response = response.data;
                    $('#change_status').attr('data-id', response.id_pendaftar);
                    $('#change_status').attr('data-default', response.current_step);

                    $('.table').each(function () {
                        $(this).DataTable().ajax.reload();
                    });
                }
            });
        }
    }

    function afterUploadBerkas(response) {
        $('.table').each(function () {
            $(this).DataTable().ajax.reload();
        });

        $('#modal-upload-file').modal('hide');
        $('#detail_pelamar_offcanvas').offcanvas('hide');
    }

    $('#modal-upload-file').on("hide.bs.modal", function() {
        $(this).find('form').attr('action', '');
        $(this).find('form').find('input[name="status"]').remove();
        $('#change_status').val($('#change_status').attr('data-default')).change();
    });


</script>
@endsection