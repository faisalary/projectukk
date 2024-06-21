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
            Tambah Jenis Magang
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
                <form class="default-form" action="{{ route('jenismagang.store') }}" function-callback="afterAction">
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
    function afterAction(response) {
        let data = response.data;
        if (data.content) {
            $(data.target_parent).html(data.content);
            switchActive(data.target_parent);
            initFormRepeater(data.target_parent);
        }
    }

    function switchActive(e) {
        let currentStepNumber = $(`[data-target="${e}"]`);
        currentStepNumber.addClass('active');

        let prevStepNumber = $(`[data-target="${e}"]`).attr('data-step') - 1;
        prevStepNumber = $(`[data-step="${prevStepNumber}"]`);
        prevStepNumber.addClass('crossed').removeClass('active');

        let prevStepContent = $(prevStepNumber.attr('data-target')).find('.content');
        let currentStepContent = $(e).find('.content');

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
</script>
@endsection