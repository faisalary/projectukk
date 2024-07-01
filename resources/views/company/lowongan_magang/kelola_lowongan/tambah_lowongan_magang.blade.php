@extends('partials.vertical_menu')

@section('page_style')
@endsection

@section('content')
<a href="{{ route('kelola_lowongan') }}" type="button" class="btn btn-outline-primary mb-3">
    <span class="ti ti-arrow-left me-2"></span>Kembali
</a>
<div class="row ">
    <div class="mb-2">
        <h4 class="fw-bold text-sm"><span class="text-muted fw-light text-xs">Lowongan Magang / </span>
            {{ isset($lowongan) ? 'Edit' : 'Tambah' }} Lowongan Magang
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
                <form class="default-form" action="{{ isset($lowongan) ? route('kelola_lowongan.update', ['id' => $lowongan->id_lowongan]) : route('kelola_lowongan.store') }}" function-callback="afterAction">
                    @csrf
                    <div id="container-detail-lowongan">
                        @include('company/lowongan_magang/kelola_lowongan/step/detail_lowongan')
                    </div>
                    <div id="container-kualifikasi-lowongan">
                        @include('company/lowongan_magang/kelola_lowongan/step/kualifikasi_lowongan')
                    </div>
                    <div id="container-proses-seleksi">
                        @if (isset($lowongan))
                        @include('company/lowongan_magang/kelola_lowongan/step/proses_seleksi')
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Validation Wizard -->
@endsection

@section('page_script')
@include('company/lowongan_magang/kelola_lowongan/js/script')
<script>
    $(document).ready(function () {
        @if (isset($lowongan))
        loadDataEdit();
        @endif
    });

    function afterAction(response) {
        let data = response.data;
        if (data != null && data.data_step) {
            let currentStepNumber = $('.bs-stepper-header').find(`[data-step="${data.data_step}"]`);
            if (data.view) {
                $('#container-proses-seleksi').html(data.view);
                // reinit
                $(".flatpickr-date").flatpickr({
                    altInput: true,
                    altFormat: 'j F Y',
                    dateFormat: 'Y-m-d'
                });
                @if (isset($lowongan)) 
                let dataLowongan = @json($lowongan);
                $.each(dataLowongan, function ( key, value ) {
                    if ($(`input[name="${key}"]:not([type="radio"])`).length > 0 || $(`textarea[name="${key}"]`).length > 0) {
                        $(`[name="${key}"]`).val(value);
                        if ($(`[name="${key}"]`).is('.flatpickr-date')) {
                            $(`[name="${key}"]`).flatpickr({
                                altInput: true,
                                altFormat: 'j F Y',
                                dateFormat: 'Y-m-d',
                                defaultDate: value
                            });
                        }
                    }
                });
                @endif
                initSelect2();
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
            $(`input[name="nominal_salary"]`).parent().show();
        } else {
            $(`input[name="nominal_salary"]`).parent().hide();
        }
    });

    @if (isset($lowongan)) 
    function loadDataEdit() {
        let data = @json($lowongan);
        $.each(data, function ( key, value ) {
            if (key == 'nominal_salary') {
                if (value == null) $(`[name="gaji"][value="0"]`).click();
                if (value != null) $(`[name="gaji"][value="1"]`).click();
            }

            if (value == null) return;

            if ($(`input[name="${key}"]:not([type="radio"])`).length > 0 || $(`textarea[name="${key}"]`).length > 0) {
                $(`[name="${key}"]`).val(value);
                if ($(`[name="${key}"]`).is('.flatpickr-date')) {
                    $(`[name="${key}"]`).flatpickr({
                        altInput: true,
                        altFormat: 'j F Y',
                        dateFormat: 'Y-m-d',
                        defaultDate: value
                    });
                }
            } else if ($(`input[name="${key}"]:is([type="radio"])`).length > 0) {
                $(`[name="${key}"][value="${value}"]`).prop("checked", true);

            } else if ($(`select[name^="${key}"]`).length > 0) {
                if ($(`select[name^="${key}"]`).prop('multiple')) {
                    let option = $(`select[name^="${key}"] option`);
                    value = JSON.parse(value);

                    if (!Array.isArray(value)) {
                        value = Object.keys(value);
                    }

                    let newOption = value.filter(function ( item ) {
                        return !option.is(`[value="${item}"]`);
                    });

                    newOption.map(function ( item ) {
                        $(`select[name^="${key}"]`).append(`<option value="${item}" selected>${item}</option>`);
                    });
                    
                    $(`select[name^="${key}"] option`).each(function () {
                        if (value.includes($(this).val())) {
                            $(this).prop('selected', true);
                        }
                    });
                } else {
                    $(`[name="${key}"]`).val(value).trigger('change');
                }
            }
        });
        initSelect2();
    }
    @endif
</script>
@endsection