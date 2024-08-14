@extends('partials.vertical_menu')

@section('page_style')
@endsection

@section('content')
<div class="d-flex justify-content-start">
    <a href="{{ route('kelola_magang_pemb_lapangan') }}" class="btn btn-outline-primary mb-3 waves-effect">
        <span class="ti ti-arrow-left me-2"></span>Kembali
    </a>
</div>
<div class="d-flex justify-content-start">
    <h4 class="fw-bold"><span class="text-muted fw-light">Kelola Mahasiswa /</span> Detail Logbook {{ $mahasiswa->namamhs }}</h4>
</div>
<div class="card">
    <div class="card-body">
        <div style="border: 1px solid #D3D6DB; border-radius: 6px; padding: 20px; height: fit-content !important; min-width: 320px !important;">
            <div class="row">
                <div class="col-10">
                    <div class="d-flex align-items-left">
                        <div class="text-center my-4" style="overflow: hidden; width: 80px; height: 80px;">
                            @if ($mahasiswa->profile_picture)
                                <img src="{{ asset('storage/' . $mahasiswa->profile_picture) }}" alt="user-avatar" class="d-block" width="80" id="image_industri">
                            @else
                                <img src="{{ asset('app-assets/img/avatars/user.png') }}" alt="user-avatar" class="d-block" width="100" id="image_industri" data-default-src="{{ asset('app-assets/img/avatars/user.png') }}">
                            @endif
                        </div>
                        <span class="pt-3">
                            <h4 class="mb-2 ms-3">{{ $mahasiswa->namamhs }}</h4>
                            <h6 class="ms-3">{{ $mahasiswa->intern_position }}</h6>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex mt-4">
            <div class="col-4">
                <div class="text-center" style="border: 1px solid #D3D6DB; border-radius: 6px; padding: 15px; margin-right: 10px; height: fit-content !important;">
                    <div class="d-flex justify-content-between">
                        <div class="col-7">
                            <p class="fw-bold mb-0 mt-2 me-2">Silahkan Pilih Bulan</p>
                        </div>
                        <div class="col-5"> <select class="select2 form-select text-outline-success" data-placeholder="Filter Status">
                                <option value="1">Januari</option>
                                <option value="2">Februari</option>
                                <option value="3">Maret</option>
                                <option value="4">April</option>
                                <option value="5">Mei</option>
                                <option value="6">Juni</option>
                                <option value="7">Juli</option>
                                <option value="8">Agustus</option>
                                <option value="9">September</option>
                                <option value="10">Oktober</option>
                                <option value="11">November</option>
                                <option value="12">Desember</option>
                            </select>
                        </div>
                    </div>
                    <div class="border-bottom mt-3 mb-3"></div>
                    <div id="container-left-card">
                        @include('kelola_mahasiswa/kelola_mahasiswa_lapangan/components/left_card_week')
                    </div>
                </div>
                <div id="container-rejected-reason"></div>
            </div>
            <div class="col" id="container-detail-logbook-weekly"></div>
        </div>
        @include('kelola_mahasiswa/kelola_mahasiswa_lapangan/components/modal')
    </div>
</div>
@endsection

@section('page_script')
<script>
    $(document).ready(function () {
        loadData();
    });

    function getLogbook(e) {
        let dataId = e.attr('data-id');
        $('input[name="selected_logbook"]').prop('checked', false);
        e.find('input[name="selected_logbook"]').prop('checked', true);

        loadData();
    }

    function loadData() {
        let getSelectedLogbook = $(`input[name="selected_logbook"]:checked`).val();
        let detailLogbookWeekly = $('#container-detail-logbook-weekly');

        if (!getSelectedLogbook) return;

        sectionBlock(detailLogbookWeekly);
        $.ajax({
            url: `{{ route('kelola_magang_pemb_lapangan.logbook', $mahasiswa->id_mhsmagang) }}`,
            data: {
                section: 'get_logbook_week',
                data_id: getSelectedLogbook
            },
            type: "GET",
            success: function (response) {
                detailLogbookWeekly.html(response.data.view_content);
                $('#container-rejected-reason').html(response.data.view_rejected_reason);

                sectionBlock(detailLogbookWeekly, false);
            }
        });
    }

    $(document).on('click', '#btn-approve', function () {
        let dataId = $(this).attr('data-id');

        sweetAlertConfirm({
            title: 'Apakah logbook mahasiswa sudah sesuai dengan yang dikerjakan?',
            text: 'Status logbook akan otomatis berubah!',
            icon: 'warning',
            confirmButtonText: 'Ya, Sudah',
            cancelButtonText: 'Batal',
        }, function () {
            $.ajax({
                url: `{{ route('kelola_magang_pemb_lapangan.approval', ['id' => ':id']) }}`.replace(':id', dataId),
                type: "POST",
                data: { _token: "{{ csrf_token() }}", status: 'approved' },
                success: function (response) {
                    $('#container-left-card').html(response.data.view_left_card);
                    $('#container-detail-logbook-weekly').html(response.data.view_logbook);

                    showSweetAlert({
                        title: 'Berhasil',
                        text: response.message,
                        icon: 'success',
                    });
                }
            });
        });
    });

    $(document).on('click', '#btn-reject', function () {
        let dataId = $(this).attr('data-id');
        let modal = $('#modalDitolak');
        let form = modal.find('form');

        form.attr('action', `{{ route('kelola_magang_pemb_lapangan.approval', ['id' => ':id']) }}`.replace(':id', dataId))
        form.find('input[name="status"]').val('rejected');
        modal.modal('show');
    });

    function afterApprovalLogbook(response) {
        $('#container-left-card').html(response.data.view_left_card);
        $('#container-rejected-reason').html(response.data.view_rejected_reason);
        $('#container-detail-logbook-weekly').html(response.data.view_logbook);
        $('#modalDitolak').modal('hide');
    }

    $(document).on('click', '.show_hide_new', function() {
        let siblingsFake = $(this).siblings('.sibling-fake');
        let siblingsReal = $(this).siblings('.sibling-real');
        
        let dataShortened = $(this).attr('data-shortened');

        if (dataShortened == 'true') {
            siblingsFake.addClass('d-none');
            siblingsReal.removeClass('d-none');

            $(this).text('Show Less');
            $(this).attr('data-shortened', 'false');
        } else {
            siblingsFake.removeClass('d-none');
            siblingsReal.addClass('d-none');

            $(this).text('Show More');
            $(this).attr('data-shortened', 'true');
        }
    });
</script>
@endsection