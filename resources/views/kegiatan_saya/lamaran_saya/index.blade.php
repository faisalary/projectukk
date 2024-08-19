@extends('partials.horizontal_menu')

@section('page_style')
@endsection

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="col-md-12 col-12 mt-3">
        <h4 class="fw-bold"><span class="text-muted fw-light">Kegiatan Saya /</span> Status Lamaran Magang</h4>
    </div>

    <div class="row ps-3">
        <ul class="nav nav-pills mb-3 " role="tablist">
            <li class="nav-item">
                <button type="button" id="fakultas" target="1" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-justified-magang-fakultas" aria-controls="navs-pills-justified-magang-fakultas" aria-selected="false">
                    Magang Fakultas
                </button>
            </li>
            <li class="nav-item">
                <button type="button" target="2" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-justified-magang-mandiri" aria-controls="navs-pills-justified-magang-mandiri" aria-selected="false">
                    Magang Mandiri
                </button>
            </li>
            <li class="nav-item">
                <button type="button" target="2" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-justified-magang-mbkm" aria-controls="navs-pills-justified-magang-mbkm" aria-selected="false">
                    Magang MBKM
                </button>
            </li>
            <li class="nav-item">
                <button type="button" target="2" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-justified-magang-kerja" aria-controls="navs-pills-justified-magang-kerja" aria-selected="false">
                    Magang Kerja
                </button>
            </li>
            <li class="nav-item">
                <button type="button" target="2" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-justified-magang-startup" aria-controls="navs-pills-justified-magang-startup" aria-selected="false">
                    Magang StartUp
                </button>
            </li>
        </ul>
        <div class="tab-content bg-transparent p-0">
            <div class="tab-pane fade show active" id="navs-pills-justified-magang-fakultas" role="tabpanel">
                @include('kegiatan_saya.lamaran_saya.components.magang_fakultas')
            </div>
            <div class="tab-pane fade" id="navs-pills-justified-magang-mandiri" role="tabpanel">
                @include('kegiatan_saya.lamaran_saya.components.magang_mandiri')
            </div>
            <div class="tab-pane fade" id="navs-pills-justified-magang-mbkm" role="tabpanel"></div>
            <div class="tab-pane fade" id="navs-pills-justified-magang-kerja" role="tabpanel"></div>
            <div class="tab-pane fade" id="navs-pills-justified-magang-startup" role="tabpanel"></div>
        </div>
    </div>
</div>
@include('kegiatan_saya.lamaran_saya.modal')
@endsection

@section('page_script')
<script>
    $(document).on('change', '#filter_lowongan', function () {
        loadData({
            component: 'proses-seleksi',
            filter: $(this).val()
        });
    });

    function approvalTawaran(event, e) {
        event.stopPropagation();

        let text = 'Ingin menerima lowongan ini?';
        let url = "{{ route('lamaran_saya.approval_penawaran', ['id' => ':id']) }}".replace(':id', e.attr('data-id'))

        if (e.attr('data-status') == 'approved') {
            let modal = $('#modalDiterima');

            $.ajax({
                url: `{{ route('lamaran_saya') }}?section=get_data_tgl_default`,
                type: 'GET',
                data: {
                    section: 'get_data_tgl_default',
                    data_id: e.attr('data-id')
                },
                success: function (response) {
                    let startDate = modal.find('form').find('input[name="startdate"]');
                    let endDate = modal.find('form').find('input[name="enddate"]');
                    startDate.val(response.mulai_magang);
                    endDate.val(response.selesai_magang);

                    startDate.flatpickr({
                        altInput: true,
                        altFormat: 'j F Y',
                        dateFormat: 'Y-m-d',
                        defaultDate: response.mulai_magang
                    });

                    endDate.flatpickr({
                        altInput: true,
                        altFormat: 'j F Y',
                        dateFormat: 'Y-m-d',
                        defaultDate: response.selesai_magang
                    });
                }
            });

            modal.find('form').attr('action', url);
            modal.find('form').prepend(`<input type="hidden" name="status" value="approved">`);
            modal.modal('show');
            return;
        } else {
            text = 'Ingin menolak lowongan ini?'
        }

        sweetAlertConfirm({
            title: 'Apakah anda yakin?',
            text: text,
            icon: 'warning',
            confirmButtonText: 'Ya, saya yakin!',
            cancelButtonText: 'Batal'
        }, function () {
            $.ajax({
                url: url,
                type: "POST",
                data: { status: e.attr('data-status') },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    if (!response.error) {
                        loadData({component: 'penawaran'});
                        loadData({component: 'diterima'});
                        loadData({component: 'ditolak'});

                        showSweetAlert({
                            title: 'Berhasil!',
                            text: 'Penawaran berhasil ' + (e.attr('data-status') == 'rejected' ? 'ditolak' : 'diterima') + '!',
                            icon: 'success'
                        });
                    } else {
                        showSweetAlert({
                            title: 'Gagal!',
                            text: response.message,
                            icon: 'error'
                        });
                    }
                },
                error: function (xhr, status, error) {
                    let res = xhr.responseJSON;
                    showSweetAlert({
                        title: 'Gagal!',
                        text: res.message,
                        icon: 'error'
                    });
                }
            });
        });
    }

    function afterAction(response) {
        let modal = $('#modalDiterima');

        loadData({component: 'penawaran'});
        loadData({component: 'diterima'});
        loadData({component: 'ditolak'});

        modal.modal('hide');
    }

    function loadData(data) {
        $.ajax({
            url: `{{ route('lamaran_saya') }}`,
            type: 'GET',
            data: {
                component: data.component,
                filter: data.filter
            },
            success: function (response) {
                response = response.data;
                $('#container-' + data.component).html(response.view);
            }
        });
    }

    $('#modalDiterima').on('hide.bs.modal', function () {
        $(this).find('form').find('input[name="status"]').remove();
        $(this).find('form').attr('action', '');
    });
</script>
@endsection