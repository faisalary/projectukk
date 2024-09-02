@extends('partials.vertical_menu')

@section('page_style')
<link rel="stylesheet" href="{{ asset('app-assets/css/pdfviewer.jquery.css') }}">
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.6.347/pdf.min.js"></script>
@endsection

@section('content')
<div class="d-flex align-items-center justify-content-start mb-3">
    <a href="{{ route('berkas_akhir_magang.fakultas') }}" class="btn btn-outline-primary">
        <i class="ti ti-arrow-left"></i>
        Kembali
    </a>
</div>
<div class="row">
    <div class="col-9">
        <div id="pdfviewer" class="mb-5"></div>
    </div>
    <div class="col-3" id="container-right-card">
        @include('berkas_akhir_magang/magang_fakultas/components/right_card_detail')
    </div>
</div>
@include('berkas_akhir_magang/magang_fakultas/components/modal_detail_file')
@endsection

@section('page_script')
@include('berkas_akhir_magang/magang_fakultas/script_js_detail_file')
<script>
    function reject() {
        let modal = $('#modal-detail-file');
        modal.find('form').find('input[name="status"]').val('reject');
        modal.modal('show');
    }

    function afterReject(res) {
        $('#container-right-card').html(res.data.view);
        $('#modal-detail-file').modal('hide');
    }

    function approve() {
        sweetAlertConfirm({
            title: 'Apakah anda yakin ingin menyetujui berkas?',
            text: 'Harap pastikan data sudah benar!',
            icon: 'warning',
            confirmButtonText: 'Ya, Yakin',
            cancelButtonText: 'Batal',
        }, function () {
            $.ajax({
                url: `{{ $url }}`,
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    status: 'approve'
                },
                success: function (res) {
                    let modal = $('#modal-detail-file');
                    showSweetAlert({
                        title: 'Berhasil!',
                        text: res.message,
                        icon: 'success'
                    });
                    $('#container-right-card').html(res.data.view);
                    modal.modal('hide');
                }
                ,error: function (res) {
                    showSweetAlert({
                        title: 'Gagal!',
                        text: res.responseJSON.message,
                        icon: 'error'
                    });
                }
            });
        });
    }
</script>
@endsection