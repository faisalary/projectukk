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
   .bootstrap-select {
    border: #4EA971 2px solid;
    border-radius: 0.25rem;
   }
</style>
@endsection

@section('content')

{{-- tombol kembali --}}
<a href="{{ url('lowongan-magang/informasi-lowongan') }}" class="btn btn-outline-primary mt-4 mb-3">
    <i class="ti ti-arrow-left me-2 text-primary"></i>
    Kembali
</a>
{{-- multipurpose input :) --}}
<input type="hidden" id="change_status">

<div class="d-flex justify-content-between">
    <h4 class="fw-bold"><span class="text-muted fw-light">Informasi Lowongan / </span>{{ $lowongan->intern_position }}</h4>
</div>

<div class="col-xl-12 mt-3">
    <div class="nav-align-top">
        <div class="d-flex justify-content-between mb-3">
            <div class="card shadow-none border border-secondary">
                <div class="card-body py-2 px-2">
                    <div class="d-flex justify-content-center align-items-center">
                        <span class="badge bg-label-primary p-2 me-2">
                            <i class="ti ti-users" style="font-size: 12pt;"></i>
                        </span>
                        <span class="mb-0 me-2">Total Pelamar :</span>
                        <h5 class="mb-0 me-2 text-primary" id="set_total_pelamar">0</h5>
                        <span class="mb-0 me-2">Orang</span>
                    </div>
                </div>
            </div>
            <div class="card shadow-none border border-secondary">
                <div class="card-body py-2 px-3 d-flex align-items-center">
                    <span class="fw-semibold px-2 my-auto me-2">Batas Konfirmasi Penerimaan&nbsp;:&nbsp;{!! $date_confirm_closing !!}</span>
                </div>
            </div>
        </div>
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

    <div class="tab-content p-0">
        @foreach ($tab as $key => $item)
        <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="{{ $key }}" role="tabpanel">
            <div class="card">
                <div class="card-datatable table-responsive">
                    @if($key == 'tahap')
                    <div class="m-4 d-flex justify-content-between">
                        <div class="col-2" id="container-filter-seleksi">
                            <select class="form-select select2" onchange="changeSeleksiTable($(this).val())">
                                <option value="all_seleksi">Semua Tahap</option>
                                @foreach($item['tahap_valid'] as $d)
                                <option value="{{ $d['table'] }}">{{ $d['label'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button class="btn btn-primary text-start" data-bs-target="#modal-send-email" data-bs-toggle="modal">
                            <i class="ti ti-mail me-2"></i>
                            Kirim Email
                        </button>
                    </div>
                    @endif
                    <table class="table @if($key == 'tahap') tahap-table @endif" id="{{ $item['table'] }}" style="width: 100%;">
                        <thead>
                            <tr>
                                <th class="text-center">AKSI</th>
                                <th class="text-center">STATUS</th>
                                <th>No</th>
                                <th>NAMA</th>
                                <th>KONTAK</th>
                                <th>UNIVERSITAS</th>
                                <th>PROGRAM STUDI</th>
                                <th class="text-center">Tanggal Daftar</th>
                                <th class="text-center">Tanggal Seleksi</th>
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
    $(document).ready(function () {
        $('#container-filter-seleksi .select2-container--default .select2-selection').css({
            'border': '3px solid var(--bs-primary)',
            'border-radius': '0.375rem',
            'background-color': '#fff'
        });
        $(`#container-filter-seleksi .select2-container--default.select2-container--focus 
        .select2-selection, 
        .select2-container--default.select2-container--open 
        .select2-selection`).css({'border-color': 'var(--bs-primary)'});
    });

    $(".flatpickr-date-custom").flatpickr({
        enableTime: true,
        altInput: true,
        altFormat: 'j F Y, H:i',
        dateFormat: 'Y-m-d H:i'
    });

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
            },
            columns: [
                { data: "action" },
                { data: "current_step" },
                { data: "DT_RowIndex" },
                { data: "namamhs" },
                { data: "nohpmhs" },
                { data: "namauniv" },
                { data: "namaprodi" },
                { data: "tanggaldaftar" },
                { data: "tanggalseleksi" },
            ]
        });
    });

    function changeSeleksiTable(table) {
        
        $('.tahap-table').prop('id', table);
        
        $('.tahap-table').DataTable().destroy();
        
        $('.tahap-table').DataTable({
            ajax: {
                url: "{{ $urlGetData }}",
                type: 'GET',
                data: {type: table}
            },
            scrollX: true,
            serverSide: false,
            processing: true,
            deferRender: true,
            destroy: true,
            drawCallback: function( settings, json ) {
                total = this.api().data().count();
                $('#total_all_seleksi').text(total);
            },
            columns: [
                { data: "action" },
                { data: "current_step" },
                { data: "DT_RowIndex" },
                { data: "namamhs" },
                { data: "nohpmhs" },
                { data: "namauniv" },
                { data: "namaprodi" },
                { data: "tanggaldaftar" },
                { data: "tanggalseleksi" },
            ]
        });
    }

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
                $('#change_status').val(response.current_step).change();
            }
        });
    }

    $('#detail_pelamar_offcanvas').on('hidden.bs.offcanvas', function () {
        $('#container_detail_pelamar').html(null);
        $('#change_status').removeAttr('data-id');
        Swal.close();
        resetChangeStatus();
    });

    function changeStatus(e) {
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
                    $('#detail_pelamar_offcanvas').offcanvas('hide');

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
        resetChangeStatus();
    });

    $('modal-send-email').on('hidden.bs.modal', function () {
        $(this).find('form').trigger('reset');
        getKandidat(null);
    });

    function swalConfirmStatus(response, next){
        title = response ? 'Yakin untuk meloloskan kandidat?' : 'Yakin untuk menggagalkan kandidat ke tahap selanjutnya?';
        confirmButtonText = response ? 'Lolos' : 'Gagal';
        customClassConfirm = response ? 'btn btn-success me-2' : 'btn btn-danger me-2';
        customClassCancel = response ? 'btn btn-danger' : 'btn btn-success';
        sweetAlertConfirm({
            title: title,
            text: 'Pastikan periksa kembali profile kandidat ',
            icon: 'warning',
            confirmButtonText: confirmButtonText,
            cancelButtonText: 'Batal',
            customClassConfirm : customClassConfirm,
            customClassCancel : customClassCancel,
        }, function () {
            $('#change_status').val(next);
            changeStatus($('#change_status'));
        });
    }

    function screeningLulus(response) {
        next = response ? '{{$afterScreening}}' : 'rejected';
        swalConfirmStatus(response, next);
    }

    function seleksiLulus(e) {
        resetChangeStatus();
        $('#change_status').attr('data-id', e.attr('data-id'));
        if(e.attr('data-status') == 'rejected') {
            swalConfirmStatus(false, 'rejected');
        } else {
            let listStatus = @json($listStatus);
            let current = e.attr('data-status');
            let index = listStatus.findIndex(x => x.value == current);
            let next = listStatus[index + 1].value;
            swalConfirmStatus(true, next);
        }
    }

    function resetChangeStatus() {
        console.log('reset');
        $('#change_status').val('');
        $('#change_status').removeAttr('data-id');
    }

    function emailSent(data){
        $('#modal-sent-email').modal('show');
    }

    function getKandidat(e = null){
        if(e.val() == null){
            $('#kandidat').html('<option disabled selected class="text-danger mt-1">Pilih Kandidat</option>');
            $('#kandidat').prop('disabled', true);
            $('#mulai_date').val('');
            $('#selesai_date').val('');
            $('#pilih-semua').prop('checked', false);
            $('#pilih-semua').parent('.form-check').hide();
            $('#pilih-semua-label').html('');
            $('#mulai_date').flatpickr({
                enableTime: true,
                altInput: true,
                altFormat: 'j F Y, H:i',
                dateFormat: 'Y-m-d H:i',
            });
            $('#selesai_date').flatpickr({
                enableTime: true,
                altInput: true,
                altFormat: 'j F Y, H:i',
                dateFormat: 'Y-m-d H:i',
            });
            return;
        }
        let tahap = e.find(':selected').attr('data-status');
        $.ajax({
            url: "{{ route('informasi_lowongan.get_kandidat', ['tahap' => ':tahap']) }}".replace(':tahap', tahap),
            type: "GET",
            data: {
                id_lowongan: "{{ $lowongan->id_lowongan }}",
                tahapan_seleksi: e.val()
            },
            success: function (response) {
                response = response.data;
                $('#kandidat').empty();
                $('#kandidat').prop('disabled', false);
                $('#kandidat').append('<option value="">Pilih Kandidat</option>');
                $.each(response, function (index, value) {
                    $('#kandidat').append('<option value="' + index + '">' + value + '</option>');
                });
                total = $('#kandidat').find('option').length - 1;
                $('#pilih-semua-label').html(e.find(':selected').text()+" <span class='text-primary'>("+total+" Kandidat)</span>");
                $('#pilih-semua').parent('.form-check').show();

            }
        });
    }

    $('#pilih-semua').on('click', function(){
        console.log('jancuk')
        if($(this).is(':checked')){
            $('#kandidat').find('option').prop('selected', true).change();
            $('#kandidat').find('option').eq(0).prop('selected', false).change();
        } else {
            $('#kandidat').find('option').prop('selected', false).change();
        }
        
    });

    function afterSetJadwal(response) {
        $('#modal-send-email').modal('hide');
        $('.table').each(function () {
            $(this).DataTable().ajax.reload();
        });
    }

    $('#mulai_date').on('change', function(){
         $('#selesai_date').flatpickr({
                enableTime: true,
                altInput: true,
                altFormat: 'j F Y, H:i',
                dateFormat: 'Y-m-d H:i',
                minDate: $('#mulai_date').val(),
          });
    });

    $('#selesai_date').on('change', function(){
        $('#mulai_date').flatpickr({
            enableTime: true,
            altInput: true,
            altFormat: 'j F Y, H:i',
            dateFormat: 'Y-m-d H:i',
            maxDate: $('#selesai_date').val(),
        });
    });
</script>
@endsection