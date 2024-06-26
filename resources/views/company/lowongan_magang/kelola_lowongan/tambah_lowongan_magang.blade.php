@extends('partials.vertical_menu')

@section('page_style')
{{-- <link rel="stylesheet" href="{{ url('app-assets/vendor/libs/flatpickr/flatpickr.css') }}" />
<link rel="stylesheet" href="{{ url('app-assets/vendor/libs/bootstrap-datepicker/bootstrap-datepicker.css') }}" />
<link rel="stylesheet" href="{{ url('app-assets/vendor/libs/bootstrap-daterangepicker/bootstrap-daterangepicker.css ') }}" />
<link rel="stylesheet" href="{{ url('app-assets/vendor/libs/pickr/pickr-themes.css') }}" /> --}}
<style>
</style>
@endsection

@section('content')
<a href="{{ route('kelola_lowongan') }}" type="button" class="btn btn-outline-primary mb-3">
    <span class="ti ti-arrow-left me-2"></span>Kembali
</a>
<div class="row ">
    <div class="mb-2">
        <h4 class="fw-bold text-sm"><span class="text-muted fw-light text-xs">Lowongan Magang / </span>
            Tambah Lowongan Magang
        </h4>
    </div>
</div>

<!-- Validation Wizard -->
<div class="modal-body">
    <div class="col-12 mb-4">
        <div class="bs-stepper wizard-numbered mt-2">
            <div class="bs-stepper-header" style="justify-content: center">
                @include('company/lowongan_magang/kelola_lowongan/number_step')
            </div>
            <div class="bs-stepper-content">
                <form class="default-form" action="{{ route('kelola_lowongan.store') }}" function-callback="afterAction">
                    @csrf
                    <div id="container-detail-lowongan">
                        @include('company/lowongan_magang/kelola_lowongan/step/detail_lowongan')
                    </div>
                    <div id="container-kualifikasi-lowongan">
                        @include('company/lowongan_magang/kelola_lowongan/step/kualifikasi_lowongan')
                    </div>
                    <div id="container-proses-seleksi">
                        {{-- @include('company/lowongan_magang/kelola_lowongan/step/proses_seleksi') --}}
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Validation Wizard -->
@endsection

@section('page_script')
{{-- <script src="{{ url('app-assets/vendor/libs/flatpickr/flatpickr.js') }}"></script>
<script src="{{ url('app-assets/vendor/libs/bootstrap-datepicker/bootstrap-datepicker.js') }}"></script>
<script src="{{ url('app-assets/vendor/libs/bootstrap-daterangepicker/bootstrap-daterangepicker.js') }}"></script>
<script src="{{ url('app-assets/vendor/libs/pickr/pickr.js') }}"></script> --}}
@include('company/lowongan_magang/kelola_lowongan/js/script')
<script>
    // $(".flatpickr-date").flatpickr({
    //     altInput: true,
    //     altFormat: 'j F Y',
    //     dateFormat: 'Y-m-d'
    // });

    $(document).ready(function () {
        @if (isset($jenismagang))
        loadDataEdit();
        @endif
    });

    function afterAction(response) {
        let data = response.data;
        if (data != null && data.data_step) {
            let currentStepNumber = $('.bs-stepper-header').find(`[data-step="${data.data_step}"]`);
            if (data.data_step == 3) {
                $('#container-proses-seleksi').html(data.view);
                // reinit
                initSelect2();
                $(".flatpickr-date").flatpickr({
                    altInput: true,
                    altFormat: 'j F Y',
                    dateFormat: 'Y-m-d'
                });
                // end reinit
            }
            switchActive(currentStepNumber);
        } else {
            setTimeout(() => {
                window.location.href = "{{ route('kelola_lowongan') }}";
            }, 1000);
        }
    }
 
    $(document).on('click', '.button-next', function () {
        let step = $(this).attr('data-step');

        if ($('.default-form').find('input[name="data_step"]').length > 0) {
            $('.default-form').find('input[name="data_step"]').remove();
        }

        $('.default-form').prepend(`<input type="hidden" name="data_step" value="${step}">`);
        $(this).attr('type', 'submit');
        $('.default-form').submit();
        $(this).attr('type', 'button');
    });

    function switchActive(currentStepNumber) {
        currentStepNumber.addClass('active');

        let prevStepNumber = currentStepNumber.attr('data-step') - 1;
        prevStepNumber = $(`[data-step="${prevStepNumber}"]`);
        prevStepNumber.addClass('crossed').removeClass('active');

        let prevStepContent = $(prevStepNumber.attr('data-target')).find('.content');
        let currentStepContent = $(currentStepNumber.attr('data-target')).find('.content');

        prevStepContent.removeClass('active');
        currentStepContent.addClass('active');
    }

    $(document).on('click', '.btn-prev', function() {
        let currentContent = $(this).parents('.content').parent();
        let currentStep = $(`[data-target="#${currentContent.attr('id')}"]`);
        currentStep.removeClass('active');

        let prevStep = $(`[data-step="${currentStep.attr('data-step') - 1}"]`);
        prevStep.addClass('active');
        prevStep.removeClass('crossed');

        currentContent.find('.content').removeClass('active');
        $(prevStep.attr('data-target')).find('.content').addClass('active');
    });

    $(document).on('change', `input[name="gaji"]`, function () {
        if ($(this).val() == 1) {
            $(`input[name="nominal"]`).parent().show();
        } else {
            $(`input[name="nominal"]`).parent().hide();
        }
    });

    @if (isset($jenismagang))
    function loadDataEdit() {
        let data = @json($jenismagang);
        $.each(data, function ( key, value ) {
            $(`[name="${key}"]`).val(value).trigger('change');
        });
    }
    @endif
</script>
@endsection