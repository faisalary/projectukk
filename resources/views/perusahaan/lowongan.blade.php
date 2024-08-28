@extends('partials.horizontal_menu')

@section('page_style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
    .hidden {
        display: none;
    }

    .input-group> :not(:first-child):not(.dropdown-menu):not(.valid-tooltip):not(.valid-feedback):not(.invalid-tooltip):not(.invalid-feedback) {
        /* width: 100% !important; */
        height: 48px !important;
        border: none;
        border-radius: 5px;
    }

    .input-group:not(.has-validation)> :not(:last-child):not(.dropdown-toggle):not(.dropdown-menu):not(.form-floating),
    .input-group:not(.has-validation)>.dropdown-toggle:nth-last-child(n+3),
    .input-group:not(.has-validation)>.form-floating:not(:last-child)>.form-control,
    .input-group:not(.has-validation)>.form-floating:not(:last-child)>.form-select {
        border: 0;
        border-top-right-radius: 0;
        border-bottom-right-radius: 0;
    }

    .dropdown.bootstrap-select {
        max-width: 170px;
        max-height: 45px;
    }

    .bootstrap-select .dropdown-toggle:after {
        right: 5px !important;
        top: 50% !important;
    }

    .light-style .bootstrap-select .dropdown-toggle {
        padding-left: 0%;
    }

    .light-style .select2-container--default .select2-selection--single {
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        background-color: #fff;
        border: none;
        border-radius: 0.375rem;
    }

    .select2-container{
        padding: 0.35rem 0rem;
        margin: 0;
        width: 100% !important;
        display: inline-block;
        position: relative;
        vertical-align: middle;
        box-sizing: border-box;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow b {
        position: absolute;
        height: 18px;
        width: 20px;
        top: 40%;
        right: 0%;
        background-repeat: no-repeat;
        background-size: 20px 18px;
    }

    .position-relative {
        position: relative !important;
        width: 90% !important;
    }

    .bootstrap-select.dropup .dropdown-toggle:after {
        transform: rotate(-45deg) translateY(-50%);
        height: 0.5em;
        width: 0.5em;
        right: 0px !important;
        top: 60% !important;
    }

    .input-group:focus-within {
        box-shadow: none;
    }
</style>
@endsection

@section('content')

@include('perusahaan/components/filter_lowongan')

{{-- Lowongn tidak ditemukan --}}
<!-- <div class="col-3 mt-5">
    <img class="image" style="border-radius: 0%; margin-left:465px;" src="{{ asset('front/assets/img/nodata.png')}}" alt="admin.upload">
</div>
<div class="sec-title mt-5 mb-4 text-center">
    <h4> Maaf, lowongan tidak di temukan</h4>
    <p> Silakan coba sesuaikan filter atau periksa kembali penulisan Anda</p>
</div> -->

<div class="container-xxl flex-grow-1 container-p-y bg-white">
      <div class="row mt-2 ps-4">
        <div class="col-4">
            <div id="container-lowongan" class="row">
                @include('perusahaan/components/card_lowongan_fp')
            </div>
            <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center mb-5 mt-4" id="container-pagination">
                    @include('perusahaan/components/pagination')
                </ul>
            </nav>
        </div>
        <div class="col-8" id="container-detail-lowongan"> 
            @include('perusahaan/components/detail_lowongan_fp')
        </div>
    </div>
</div>


@endsection

@section('page_script')
<script>


    let dataFilter = {};
    $(document).ready(function () {
        $('#picker_range').flatpickr({
            mode: "range",
            enableTime: false,
            onChange: function (selectedDates, dateStr, instance) {
                if (selectedDates.length <= 1) return;
                let start_date = dateStr.split(' to ')[0];
                let end_date = dateStr.split(' to ')[1];
                dataFilter.start_date = start_date;
                dataFilter.end_date = end_date;

                loadData();
            }
        });

        $('.dropdown-menu').on('click', function(event) {
            event.stopPropagation();
        });

        @if($filtered != [])
            $('#lowongan_magang').val("{{ $filtered['lowongan'] ?? '' }}").change();
            $('#location').val("{{ $filtered['location'] ?? '' }}").change();
            $('#jenis_magang').val("{{ $filtered['jenis_magang'] ?? '' }}").change();
        @endif

        //remove parent position relative and add w-75
        $('#location, #jenis_magang').parent().removeClass('position-relative').addClass('w-75');
    });

    function pagination(e) {
        url = e.attr('data-url');
        if (url == '') return;
        dataFilter.page = url.split('page=')[1];

        $('.page-item').removeClass('active');
        e.addClass('active');

        loadData();
    }

    function filter() {
        let lowongan = $('#lowongan_magang').val();
        let location = $('#location').val();

        dataFilter.lowongan = lowongan;
        dataFilter.location = location;

        loadData();
    }

    function loadData() {
        let url = `{{ route('apply_lowongan') }}`;

        $.ajax({
            url: url,
            type: "GET",
            data: dataFilter,
            success: function(response) {
                $('#container-lowongan').html(response.data.view);
                $('#container-pagination').html(response.data.pagination);
            }
        });
    }

    function detail(e) {
        let dataId = e.attr('data-id');
        let url = `{{ route('apply_lowongan.detail', ['id' => ':id']) }}`.replace(':id', dataId);
        let containerDetailLowongan = $('#container-detail-lowongan');
        sectionBlock(containerDetailLowongan);

        $.ajax({
            url: url,
            type: "GET",
            success: function(response) {
                containerDetailLowongan.html(response.data);
                sectionBlock(containerDetailLowongan, false);
            }
        });
    }

    $('.form-filter button[type="button"]').on('click', function() {
        let input = $(this).parents('.form-filter').find('input');
        let dataTemp = [];
        let nameElement = input[0].name;

        input.each(function() { 
            if ($(this).is(':checkbox') && $(this).is(':checked')) {
                dataTemp.push($(this).val());
            } else if ($(this).is(':radio') && $(this).is(':checked')) {
                dataTemp = $(this).val();
            } else if ($(this).is(':text')) {
                dataFilter[$(this).attr('name')] = $(this).val();
            }
        });

        $(this).parents('.form-filter').removeClass('show');
        if (dataTemp.length > 0) dataFilter[nameElement] = dataTemp;
        loadData();
    });

    $('.form-filter button[type="reset"]').on('click', function() {
        let input = $(this).parents('.form-filter').find('input');

        input.each(function() { 
            if (($(this).is(':checkbox') || $(this).is(':radio')) && $(this).is(':checked')) {
                $(this).prop('checked', false);
                delete dataFilter[$(this).attr('name')];
            } else if ($(this).is(':text')) {
                $(this).val(null);
                delete dataFilter[$(this).attr('name')];
            }
        });
    });

    $(document).on('change', 'input[name="paymentType"]:checked', function () {
        if ($(this).val() === "berbayar") {
            $('#container-nominal-minimal').show();
        } else {
            $('#container-nominal-minimal').hide();
        }
    });

    @if($isMahasiswa)
    function myFunction(event, e) {
        event.stopPropagation();
        let icon = e.find('i');

        if (icon.hasClass('fa-solid fa-bookmark')) {
            icon.removeClass().addClass('fa-regular fa-bookmark');
        } else {
            icon.removeClass().addClass('fa-solid fa-bookmark');
        }

        $.ajax({
            url: "{{ route('lowongan_tersimpan.save', ['id' => ':id']) }}".replace(':id', e.attr('data-id')),
            type: "POST",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            error: (xhr, status, error) => {
                let res = xhr.responseJSON;
                showSweetAlert({
                    title: 'Gagal!',
                    text: res.message,
                    icon: 'error'
                });
            },
        });
    }
    @endif
</script>
@endsection