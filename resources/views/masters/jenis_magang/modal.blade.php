@extends('partials.vertical_menu')

@section('page_style')
@endsection

@section('content')
@isset ($urlBack)
<a href="{{ $urlBack }}" class="btn btn-outline-primary mb-3 mt-2">
    <i class="ti ti-arrow-left me-2"></i>
    <span>Kembali</span>
</a>
@endisset
<div class="row ">
    <div class="mb-2">
        <h4 class="fw-bold text-sm modal-title"><span class="text-muted fw-light text-xs">Master Data/ </span>
            {{ isset($jenismagang) ? 'Edit' : 'Tambah' }} Jenis Magang
        </h4>
    </div>
</div>

<div class="modal-body" id="modal-jenismagang">
    <div class="col-12 mb-4">
        <div class="bs-stepper wizard-numbered mt-2">
            <div class="bs-stepper-header" style="justify-content: center">
                @include('masters.jenis_magang.step.number_step')
            </div>
            <div class="bs-stepper-content">
                <form class="default-form" action="{{ isset($jenismagang) ? route('jenismagang.update', ['id' => $jenismagang->id_jenismagang]) : route('jenismagang.store') }}" function-callback="afterAction">
                    @csrf
                    <div id="jenis_magang">
                        @include('masters.jenis_magang.step.jenis_magang')
                    </div>
                    <div id="detail_berkas_magang"></div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('page_script')
<script>
    $(document).ready(function () {
        @if (isset($jenismagang)) 
        loadDataEdit();
        @endif
    });

    function afterAction(response) {
        let data = response.data;
        if (data != null && data.content && data.data_step) {
            let currentStepNumber = $('.bs-stepper-header').find(`[data-step="${data.data_step}"]`);
            $(currentStepNumber.attr('data-target')).html(data.content);

            switchActive(currentStepNumber);
            initFormRepeater();
        } else {
            setTimeout(() => {
                window.location.href = "{{ route('jenismagang') }}";
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

        currentContent.html(null);
        $(prevStep.attr('data-target')).find('.content').addClass('active');
    });

    function afterShown(e) {
        $(e).find('.container-label').find('a').remove();
        $(e).find('input.id_berkas').remove();
    }

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