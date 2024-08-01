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
        if (e.attr('data-status') == 'rejected') text = 'Ingin menolak lowongan ini?';

        sweetAlertConfirm({
            title: 'Apakah anda yakin?',
            text: text,
            icon: 'warning',
            confirmButtonText: 'Ya, saya yakin!',
            cancelButtonText: 'Batal'
        }, function () {
            $.ajax({
                url: "{{ route('lamaran_saya.approval_penawaran', ['id' => ':id']) }}".replace(':id', e.attr('data-id')),
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
</script>
@endsection